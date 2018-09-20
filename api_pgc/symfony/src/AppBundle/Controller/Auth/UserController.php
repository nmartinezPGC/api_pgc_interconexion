<?php

/**
 * Description of UserController
 *
 * @author Nahum Martinez <nmartinez.salgado@yahoo.com>
 */

namespace AppBundle\Controller\Auth;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse as JsonResponse;
// Recuros de la Clase
use Symfony\Component\Validator\Constraints as Assert;
use BackendBundle\Entity\TblUsuarios;
use BackendBundle\Entity\TblInstituciones;

class UserController extends Controller {
    // Propiedades de la Clase

    /**
     * Method: Nuevo Usuario de la API
     * Function: FND-00001
     * @Route("/user/new-user", name="newUser")
     * Description: Funcion de Registro del Usuario de la API
     * @param json $email Correo del usuario
     * @param json $password Password del usuario
     * @param json $cod_usuario Codigo del usuario
     * @param json $nombre1 Nombre1 del usuario
     * @param json $nombre2 Nombre1 del usuario
     * @param json $apellido1 Apellido1 del usuario
     * @param json $apellido2 Apellido2 del usuario
     * @param json $id_institucion Institucion del usuario
     * @param json $apellido2 Password del usuario     
     */
    public function newUserAction(Request $request) {
        // Service Maneger
        $helpers = $this->get("app.helpers");

        // Validamos los datos del Json
        $json = $request->get("json", null);
        $params = json_decode($json);

        $data = array();

        if ($json != null) {
            // Parametros del Json, desglosados            
            $createdDate = new \DateTime("now");

            $cod_usuario = ( isset($params->codUsuario) ) ? $params->codUsuario : null;
            $nombre1 = ( isset($params->nombre1) ) ? $params->nombre1 : null;
            $nombre2 = ( isset($params->nombre2) ) ? $params->nombre2 : null;
            $apellido1 = ( isset($params->apellido1) ) ? $params->apellido1 : null;
            $apellido2 = ( isset($params->apellido2) ) ? $params->apellido2 : null;

            $id_institucion = ( isset($params->idInstitucion) ) ? $params->idInstitucion : null;

            $email = ( isset($params->email) ) ? $params->email : null;
            $password = ( isset($params->password) ) ? $params->password : null;

            // Validacion del Email
            $emailConstraint = new Assert\Email();
            $emailConstraint->message = "Email no válido !! ";
            $validate_email = $this->get("validator")->validate($email, $emailConstraint);

            if ($email != null && count($validate_email) == 0 &&
                    $password != null && $nombre1 != null && $apellido1 != null &&
                    $id_institucion != 0) {
                // Creamos el Objeto User
                $em = $this->getDoctrine()->getManager();

                $user = new TblUsuarios();
                $user->setCodUsuario($cod_usuario);
                $user->setFechaCreacion($createdDate);

                $user->setNombre1($nombre1);
                $user->setNombre2($nombre2);
                $user->setApellido1($apellido1);
                $user->setApellido2($apellido2);

                // Buscamos la Institucuion relacionada: TblInstituciones
                $institucion = $em->getRepository("BackendBundle:TblInstituciones")->findOneBy(
                        array(
                            "idInstitucion" => $id_institucion
                        )
                );
                $user->setIdInstitucion($institucion);

                $user->setEmail($email);

                // Cifrar el PassWord
                $pwd = hash('sha256', $password);
                $user->setPassword($pwd);

                // Verificamos que el Email, no se esta usando                   
                $isset_user = $em->getRepository("BackendBundle:TblUsuarios")->findOneBy(
                        array(
                            "email" => $email
                        )
                );


                if (count($isset_user) == 0) {
                    $em->persist($user);
                    // var_dump("Paso NAM 1.2");
                    $em->flush();

                    // Array de Datos de Envio
                    $data = array(
                        "status" => "success",
                        "code" => 200,
                        "msg" => "El nuevo Usuario, ha sido creado con exito !!",
                    );
                } else {
                    // Array de Datos de Envio
                    $data = array(
                        "status" => "error",
                        "code" => 400,
                        "msg" => "Usuario no creado, ya existe en la Base de Datos !!",
                    );
                }
            }
        } else {
            $data = array(
                "status" => "error",
                "code" => 400,
                "msg" => "Usuario no creado, no se ha enviado la información correctamente !!",
            );
        }

        // Retorno de la Funcion
        return $helpers->json($data);
        // FIN | FND-00001
    }

    // FIN | Clase UserController
}
