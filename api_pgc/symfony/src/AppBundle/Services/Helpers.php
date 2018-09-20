<?php

/**
 * Description of Helpers
 *
 * @author Sammy Guergachi <nmartinez>
 */
namespace AppBundle\Services;


class Helpers {
    // Propiedades de la Clase
    public $jwt_auth;
    
    
    /*
     * Constructor de la Clase
     */
    public function __construct( $jwt_auth ) {
        $this->jwt_auth = $jwt_auth;
    }
    
    
    /*
     * 
     */
    public function authCheck( $hash, $getIdentity = false ) {
        $jwt_auth = $this->jwt_auth;
        
        $auth = false;
        
        if ( $hash != null ) {
            if ( $getIdentity == false ) {
                $check_token = $jwt_auth->checkToken( $hash );
                if ( $check_token == true ) {
                    $auth = true;
                }
            } else {
                $check_token = $jwt_auth->checkToken( $hash, true );
                if (is_object($check_token) ) {
                    $auth = $check_token;
                }
            }
        }
        
        // Retorno de la Funcion
        return $auth;
    }
    
    
    /*
     * Metodo que permite trabajar con los datos de la API y convertirlos a JSON
     */    
    public function json($data) {
        $normalizer = array( new \Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer() );
        $encoders = array( "json" => new \Symfony\Component\Serializer\Encoder\JsonEncoder() );
        
        $serializer = new \Symfony\Component\Serializer\Serializer($normalizer, $encoders);
        
        $json = $serializer->serialize( $data, 'json' );
        
        $response = new \Symfony\Component\HttpFoundation\Response();
        $response->setContent( $json );
        $response->headers->set( "Content-Type", "application/json" );
        
        return $response;
    }
}
