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
     * Function: Nuevo Usuario
     */
    public function newUserAction(Request $request)
    {
        // Service Maneger
        $helpers = $this->get( "app.helpers" );
        
        // Validamos los datos del Json
        $json = $request->get( "json", null );
        $params = json_decode( $json );
        
        $data = array();
        
        if ( $json != null ) {
            // Parametros del Json, desglosados            
            $createdDate = new \DateTime("now");
            
            $cod_usuario = ( isset( $params->codUsuario ) ) ? $params->codUsuario : null;
            $nombre1  = ( isset( $params->nombre1 ) ) ? $params->nombre1 : null;
            $nombre2  = ( isset( $params->nombre2 ) ) ? $params->nombre2 : null;
            $apellido1  = ( isset( $params->apellido1 ) ) ? $params->apellido1 : null;
            $apellido2  = ( isset( $params->apellido2 ) ) ? $params->apellido2 : null;
            
            $id_institucion    = ( isset( $params->idInstitucion ) ) ? $params->idInstitucion : null;
            
            $email    = ( isset( $params->email ) ) ? $params->email : null;
            $password = ( isset( $params->password ) ) ? $params->password : null;
            
            // Validacion del Email
            $emailConstraint = new Assert\Email();
            $emailConstraint->message = "Email no válido !! ";            
            $validate_email = $this->get("validator")->validate( $email, $emailConstraint );
            
                if ( $email != null && count($validate_email) == 0 &&
                     $password != null && $nombre1 != null && $apellido1 != null && 
                     $id_institucion != 0 ) {
                    // Creamos el Objeto User
                    $em = $this->getDoctrine()->getManager();
                    
                    $user = new TblUsuarios();
                    $user->setCodUsuario( $cod_usuario );
                    $user->setFechaCreacion( $createdDate );
                    
                    $user->setNombre1( $nombre1 );
                    $user->setNombre2( $nombre2 );
                    $user->setApellido1( $apellido1 );
                    $user->setApellido2( $apellido2 );                   
                                     
                    // Buscamos la Institucuion relacionada: TblInstituciones
                    $institucion = $em->getRepository( "BackendBundle:TblInstituciones" )->findOneBy( 
                                array( 
                                    "idInstitucion" => $id_institucion
                                )
                            );                    
                    $user->setIdInstitucion( $institucion );
                    
                    $user->setEmail( $email );
                    
                    // Cifrar el PassWord
                    $pwd = hash( 'sha256', $password );
                    $user->setPassword( $pwd );
                    
                    // Verificamos que el Email, no se esta usando                   
                    $isset_user = $em->getRepository( "BackendBundle:TblUsuarios" )->findOneBy( 
                                array( 
                                    "email" => $email                                    
                                )
                            );
                    
                    
                    if ( count( $isset_user ) == 0 ) {
                        $em->persist( $user );
                        // var_dump("Paso NAM 1.2");
                        $em->flush();
                        
                        // Array de Datos de Envio
                        $data = array(
                            "status" => "success",
                            "code"   => 200,
                            "msg"    => "El nuevo Usuario, ha sido creado con exito !!",
                        ); 
                    } else {
                        // Array de Datos de Envio
                        $data = array(
                            "status" => "error",
                            "code"   => 400,
                            "msg"    => "Usuario no creado, ya existe en la Base de Datos !!",
                        );
                    }
                }
        } else {
            $data = array(
                    "status" => "error",
                    "code"   => 400,
                    "msg"    => "Usuario no creado, no se ha enviado la información correctamente !!",
                );
        }
        
        // Retorno de la Funcion
        return $helpers->json($data);
    }   
      
    
}
