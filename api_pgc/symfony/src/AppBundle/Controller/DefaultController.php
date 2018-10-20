<?php

/**
 * Description of UserController
 *
 * @author Nahum Martinez <nmartinez.salgado@yahoo.com>
 */

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse as JsonResponse;
// Recuros de la Clase
use Symfony\Component\Validator\Constraints as Assert;
//Traslado de Comunicacion
use BackendBundle\Entity\TblUsuarios;
use BackendBundle\Entity\TblAccesos;

class DefaultController extends Controller {

    /**
     * @Route("/", name="homepage")
     * Descripción: Funcion Index de la API
     */
    public function indexAction(Request $request) {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
                    'base_dir' => realpath($this->getParameter('kernel.root_dir') . '/..'),
        ]);
    }

    /**
     * @Route("/pruebas", name="pruebas" )
     * Descripción: Funcion de prueba para la API, nesesita Token para la
     * Validacion de la Data
     */
    public function pruebasAction(Request $request) {
        // Service Maneger
        $helpers = $this->get("app.helpers");

        $data = array();

        // Valid Token
        $hash = $request->get("authorization", null);
        $authCheck = $helpers->authCheck($hash);

        // Validamos el hash
        if ($authCheck == true) {
            $em = $this->getDoctrine()->getManager();

            $estados = $em->getRepository("BackendBundle:TblCategorias")->findAll();

            $data = array(
                "status" => "success",
                "code" => "200",
                "msg" => "En hora buena, tus datos se han obtenido de forma satisfactoria !!",
                "data" => $estados,
            );
        } else {
            $data = array(
                "status" => "error",
                "code" => "400",
                "msg" => "Error, Authorization not valid. Tu sessión a caducado, por favor cierra y vuelve a iniciar para continuar !!",
            );
        }

        // Retorno de la Funcion
        return $helpers->json($data);
    }

    /**
     * Method: Login de la API
     * Funcion: FND-00001
     * @Route("/login", name="login")
     * Descripción: Funcion de Logeo del Usuario de la API
     * @param json $email Correo del usuario
     * @param json $password Password del usuario
     */
    public function loginAction(Request $request) {
        date_default_timezone_set('America/Tegucigalpa');
        // Service Maneger
        $helpers = $this->get("app.helpers");
        $jwt_auth = $this->get("app.jwt_auth");

        // Recibir json por POST
        $json = $request->get("json", NULL);

        if ($json != null) {
            $params = json_decode($json);

            // Parametros del Json, desglosados            
            $createdDate = new \DateTime("now");

            $hora_ingreso = new \DateTime('now');
            $hora_ingreso->format('H:i');

            $email = ( isset($params->email) ) ? $params->email : null;
            $password = ( isset($params->password) ) ? $params->password : null;
            $getHash = ( isset($params->gethash) ) ? $params->gethash : null;

            // Cifrar el PassWord
            $pwd = hash('sha256', $password);

            $emailConstraint = new Assert\Email();
            $emailConstraint->message = "Email no válido !! ";
            $validate_email = $this->get("validator")->validate($email, $emailConstraint);

            // Accion de Usuario
            $accion_usuario = "";
            $accion_msg = "";

            if (count($validate_email) == 0 && $password != null) {
                // Validacion de del envio del Hash ?
                if ($getHash == NULL) {
                    $signup = $jwt_auth->signup($email, $pwd);

                    //Status de la Accion
                    $estado = $signup['status'];
                    if ($estado != "error") {
                        $accion_usuario = "Logeo exitoso sin Hash encriptado";
                        $accion_msg = "Usuario y Contraseña validos, sin Hash";
                    } else {
                        $accion_usuario = "Error al momento de Logearse";
                        $accion_msg = $signup['data'];
                    }
                } else {
                    $signup = $jwt_auth->signup($email, $pwd, true);
                    //Status de la Accion
                    $estado = $signup['status'];
                    if ($estado != "error") {
                        $accion_usuario = "Logeo exitoso con Hash encriptado";
                        $accion_msg = "Usuario y Contraseña validos, con Hash";
                    } else {
                        $accion_usuario = "Error al momento de Logearse";
                        $accion_msg = $signup['data'];
                    }
                }

                // Inserta en Bitacora de Accesos
                //Instancia del Doctrine
                $em = $this->getDoctrine()->getManager();

                //Instanciamos la Entidad TblAccesos *********************
                $accesoNew = new TblAccesos();

                //Seteamos los valores de Identificacion *******************
                // Verificacion del Codigo y Email en la Tabla: TblUsuarios ********                
                $isset_user_mail = $em->getRepository("BackendBundle:TblUsuarios")
                        ->findOneBy(
                        array(
                            "email" => $email
                ));

                $ipCleinte = $this->getRealIP();

                $user_agent = $_SERVER['HTTP_USER_AGENT'];
                $navegadorCliente = $this->getBrowser($user_agent);

                $accesoNew->setIdUsuario($isset_user_mail);
                $accesoNew->setFechaAcceso($createdDate);
                $accesoNew->setHoraAcceso($hora_ingreso);
                $accesoNew->setIpAcceso($ipCleinte);
                $accesoNew->setNavegador($navegadorCliente);

                // Eventos del Usario
                $accesoNew->setEmailAcceso($email);
                $accesoNew->setAccionUsuario($accion_usuario . " ---- " . $accion_msg);

                //Realizar la Persistencia de los Datos y enviar a la BD
                $em->persist($accesoNew);

                //Realizar la actualizacion en el storage de la BD
                $em->flush();

                // Retorno de la Clave del Token
                return new JsonResponse($signup);
            } else {
                return $helpers->json(
                                array(
                                    "status" => "error",
                                    "data" => "Login inválido, porfavor verifica la información de tus credenciales para ingresar !! ",
                                )
                );
            }
        } else {
            return $helpers->json(
                            array(
                                "status" => "error",
                                "data" => "No has enviado los parametros para logearte, porfavor ingresa el Email y Password !! ",
                            )
            );
        }
        // Return de la Clase        
        // FIN | FND-00001
    }

    /**
     * Method: getRealIP del Cliente
     * Funcion: FND-00002
     * Descripción: Funcion de obtener la IP real Usuario de la API
     */
    function getRealIP() {
        if (!empty($_SERVER['HTTP_CLIENT_IP']))
            return $_SERVER['HTTP_CLIENT_IP'];

        if (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
            return $_SERVER['HTTP_X_FORWARDED_FOR'];

        return $_SERVER['REMOTE_ADDR'];
    }

    /**
     * Method: getBrowser del Cliente
     * Funcion: FND-00003
     * Descripción: Funcion de obtener Navegador del Usuario de la API
     */
    function getBrowser($user_agent) {
        if (strpos($user_agent, 'MSIE') !== FALSE) {
            return 'Internet explorer';
        } elseif (strpos($user_agent, 'Edge') !== FALSE) { //Microsoft Edge
            return 'Microsoft Edge';
        } elseif (strpos($user_agent, 'Trident') !== FALSE) { //IE 11
            return 'Internet explorer';
        } elseif (strpos($user_agent, 'Opera Mini') !== FALSE) {
            return "Opera Mini";
        } elseif (strpos($user_agent, 'Opera') || strpos($user_agent, 'OPR') !== FALSE) {
            return "Opera";
        } elseif (strpos($user_agent, 'Firefox') !== FALSE) {
            return 'Mozilla Firefox';
        } elseif (strpos($user_agent, 'Chrome') !== FALSE) {
            return 'Google Chrome';
        } elseif (strpos($user_agent, 'Safari') !== FALSE) {
            return "Safari";
        } else
            return 'No hemos podido detectar su navegador, estas Usando: ' . $user_agent;
    }

// FIN | Clase UserController
}
