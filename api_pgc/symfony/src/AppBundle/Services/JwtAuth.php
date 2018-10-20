<?php

namespace AppBundle\Services;

use Firebase\JWT\JWT;

/**
 * Description of JWTAuth
 *
 * @author Nahum Martinez <nmartinez>
 */
class JwtAuth {

    // Propiedades de la Clase
    public $manager;
    public $key;

    /*
     * Creacion del Constructor
     */

    public function __construct($manager) {
        $this->manager = $manager;
        $this->key = "clave-secreta";
    }

    /*
     * Funion name: signup
     * Description: Login de la API
     */

    public function signup($email, $password, $getHash = NULL) {
        // Definicion de las variables que hacen el token
        $key = $this->key;

        $user = $this->manager->getRepository('BackendBundle:TblUsuarios')->findOneBy(
                array(
                    "email" => $email,
                    "password" => $password
                )
        );

        $signup = false;

        if (is_object($user)) {
            $signup = true;
        }

        if ($signup == true) {
            $token = array(
                "sub" => $user->getIdUsuario(),
                "email" => $user->getEmail(),
                "nombre" => $user->getNombre1(),
                "apellido" => $user->getApellido1(),
                "password" => $user->getPassword(),
                "iat" => time(),
                "exp" => time() + ( 7 * 24 * 60 * 60 ),
            );

            // Encriptado del Token
            $jwt = JWT::encode($token, $key, 'HS256');
            $decoded = JWT::decode($jwt, $key, array('HS256'));

            // Validacion del Hash
            if ($getHash != null) {
                //return $jwt;
                return array("status" => "success", "data" => $jwt);
            } else {
                //return $decoded;
                return array("status" => "success", "data" => $decoded);
            }
        } else {
            return array("status" => "error", "data" => "Usuario o Contraseña invalidas, revisa los datos otra ves!!");
        }
    }

    /*
     * Method: checkToken
     * Description: Valida que el token sea correcto
     */

    public function checkToken($jwt, $getIdentity = false) {
        // Propiedades de la Clase
        $key = $this->key;
        $auth = false;

        try {
            $decoded = JWT::decode($jwt, $key, array('HS256'));
        } catch (\UnexpectedValueException $ex) {
            $auth = false;
        } catch (\DomainException $ex) {
            $auth = false;
        }

        // Evaluamos la decodificacion
        if (isset($decoded->sub)) {
            $auth = true;
        } else {
            $auth = false;
        }

        // Evaluamos la Identificacion
        if ($getIdentity == true) {
            return $decoded;
        } else {
            return $auth;
        }
    }

}
