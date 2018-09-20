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
        // Service Maneger
        $helpers = $this->get("app.helpers");
        $jwt_auth = $this->get("app.jwt_auth");

        // Recibir json por POST
        $json = $request->get("json", NULL);

        if ($json != null) {
            $params = json_decode($json);

            $email = ( isset($params->email) ) ? $params->email : null;
            $password = ( isset($params->password) ) ? $params->password : null;
            $getHash = ( isset($params->gethash) ) ? $params->gethash : null;

            // Cifrar el PassWord
            $pwd = hash('sha256', $password);

            $emailConstraint = new Assert\Email();
            $emailConstraint->message = "Email no válido !! ";
            $validate_email = $this->get("validator")->validate($email, $emailConstraint);

            if (count($validate_email) == 0 && $password != null) {
                // Validacion de del envio del Hash ?
                if ($getHash == NULL) {
                    $signup = $jwt_auth->signup($email, $pwd);
                } else {
                    $signup = $jwt_auth->signup($email, $pwd, true);
                }

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

    // FIN | Clase UserController
}
