<?php

/**
 * Description of LocationController
 *
 * @author Nahum Martinez <nmartinez.salgado@yahoo.com>
 */

namespace AppBundle\Controller\Location;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse as JsonResponse;
// Recuros de la Clase
use Symfony\Component\Validator\Constraints as Assert;
use BackendBundle\Entity\TblLocalidades;
use BackendBundle\Entity\TblProyectosLocalidad;

class LocationController extends Controller {

    /**
     * Method: Consulta Localidades All de la API
     * Function: FND-00001
     * @Route("/location/find-all-locations", name="findAllLocations")
     * Description: Funcion de consulta de todos las Localidades de la API
     * que la información esta registrada en l BD de la PGC.
     * @param authorization Token de la API, generado por el EndPoint /login      
     */
    public function findAllLocationsAction(Request $request) {
        // Propiedades del Metodo
        // Service Maneger
        $helpers = $this->get("app.helpers");

        // Array para user con el Response
        $data = array();

        // Valid Token
        $hash = $request->get("authorization", null);
        $authCheck = $helpers->authCheck($hash);

        // Validamos el hash
        if ($authCheck == true) {
            $em = $this->getDoctrine()->getManager();

            /*
             * Todos los Localidades registrados en la PGC, 
             * sin filtros y con
             * sus respectivas relaciones para los datos generales.
             */
            $localidadesPGCAll = $em->getRepository("BackendBundle:TblLocalidades")->findAll();

            $countLocalidades = count($localidadesPGCAll);

            if ($countLocalidades > 0) {
                $data = array(
                    "status" => "success",
                    "code" => 200,
                    "msg" => "En hora buena, tus datos se han obtenido de forma satisfactoria !!",
                    "totalRecords" => $countLocalidades,
                    "data" => $localidadesPGCAll,
                );
            } else {
                $data = array(
                    "status" => "error",
                    "code" => 300,
                    "msg" => "No existen Localidades registrados en la BD !!",
                    "totalRecords" => $countLocalidades,
                    "data" => $localidadesPGCAll,
                );
            }
        } else {
            $data = array(
                "status" => "error",
                "code" => "400",
                "msg" => "Error, Authorization not valid. Tu sessión a caducado, por favor cierra y vuelve a iniciar para continuar !!",
            );
        }

        // Retorno de la Funcion
        return $helpers->json($data);

        // FIN | FND-00001
    }

    /**
     * Method: Consulta de Localidad por Identificar ID de la API
     * Function: FND-00002
     * @Route("/location/find-location", name="findLocation")
     * Description: Funcion de consulta de la Localidad espefica del Proyecto de 
     * la API, por su ID unico registrado en la BD de la PGC.
     * @param authorization Token de la API, generado por el EndPoint /login      
     * @param json $idLocalidad Identificardor númerico del Proyecto
     */
    public function findLocationAction(Request $request) {
        // Propiedades del Metodo
        // Service Maneger
        $helpers = $this->get("app.helpers");

        // Validamos los datos del Json
        $json = $request->get("json", null);
        $params = json_decode($json);

        // Array para user con el Response
        $data = array();

        // Valid Token
        $hash = $request->get("authorization", null);
        $authCheck = $helpers->authCheck($hash);

        // Validamos el hash
        if ($authCheck == true) {
            // Evalua los datos del Json
            if ($json != null) {
                // Instancia del Doctrine para Generar las Entidades
                $em = $this->getDoctrine()->getManager();

                // Parametros del Json, desglosados            
                $createdDate = new \DateTime("now");

                $id_localidad = ( isset($params->idLocalidad) ) ? $params->idLocalidad : null;

                /*
                 * La Localidad indicado registrados en la PGC, con filtros 
                 * (idLocalidad) y con sus respectivas relaciones para los datos 
                 * generales.
                 */
                $localidadId = $em->getRepository("BackendBundle:TblLocalidades")->findOneBy(
                        array(
                            "idLocalidad" => $id_localidad
                        )
                );

                // Conteo de los Registros
                $countLocalidad = count( $localidadId );

                if ( $countLocalidad > 0) {
                    $data = array(
                        "status" => "success",
                        "code" => 200,
                        "msg" => "En hora buena, tus datos se han obtenido de forma satisfactoria !!",
                        "totalRecords" => $countLocalidad,
                        "data" => $localidadId,
                    );
                } else {
                    $data = array(
                        "status" => "error",
                        "code" => 300,
                        "msg" => "No existe una Localidad en la base de datos, con el ID Solicitado !!",
                        "totalRecords" => $countLocalidad,
                        "data" => $localidadId,
                    );
                }
            } else {
                $data = array(
                    "status" => "error",
                    "code" => 400,
                    "msg" => "Localidad no encontrada, no se ha enviado la información del ID correctamente !!",
                );
            } // FIN | Evalua Json
        } else {
            $data = array(
                "status" => "error",
                "code" => "400",
                "msg" => "Error, Authorization not valid. Tu sessión a caducado, por favor cierra y vuelve a iniciar para continuar !!",
            );
        }

        // Retorno de la Funcion
        return $helpers->json($data);

        // FIN | FND-00002
    }

    /**
     * Method: Consulta del Proyecto por Identificar ID de la API
     * Function: FND-00003
     * @Route("/location/find-project-location", name="findProjectForIdLocation")
     * Description: Funcion de consulta de la Localidad Beneficiaria del 
     * Proyecto de la API, por su ID unico registrado en la BD de la PGC.
     * @param authorization Token de la API, generado por el EndPoint /login      
     * @param json $idProjecto Identificardor númerico del Proyecto
     */
    public function findProjectForIdLocationAction(Request $request) {
        // Propiedades del Metodo
        // Service Maneger
        $helpers = $this->get("app.helpers");

        // Validamos los datos del Json
        $json = $request->get("json", null);
        $params = json_decode($json);

        // Array para user con el Response
        $data = array();

        // Valid Token
        $hash = $request->get("authorization", null);
        $authCheck = $helpers->authCheck($hash);

        // Validamos el hash
        if ($authCheck == true) {
            // Evalua los datos del Json
            if ($json != null) {
                // Instancia del Doctrine para Generar las Entidades
                $em = $this->getDoctrine()->getManager();

                // Parametros del Json, desglosados            
                $createdDate = new \DateTime("now");

                $id_proyecto = ( isset($params->idProyecto) ) ? $params->idProyecto : null;

                /*
                 * Todos los Localidades registrados en la PGC, con filtros 
                 * (idProyecto) y con sus respectivas relaciones para los datos 
                 * generales.
                 */
                $proyectoPGCIdlocalidad = $em->getRepository("BackendBundle:TblProyectoLocalidad")->findOneBy(
                        array(
                            "idProyecto" => $id_proyecto
                        )
                );

                // Conteo de los Registros
                $countProjects = count( $proyectoPGCIdlocalidad );

                if ($countProjects > 0) {
                    $data = array(
                        "status" => "success",
                        "code" => 200,
                        "msg" => "En hora buena, tus datos se han obtenido de forma satisfactoria !!",
                        "totalRecords" => $countProjects,
                        "data" => $proyectoPGCIdlocalidad,
                    );
                } else {
                    $data = array(
                        "status" => "error",
                        "code" => 300,
                        "msg" => "No existe Localidades para el Proyecto, con el ID Solicitado !!",
                        "totalRecords" => $countProjects,
                        "data" => $proyectoPGCIdlocalidad,
                    );
                }
            } else {
                $data = array(
                    "status" => "error",
                    "code" => 400,
                    "msg" => "Proyecto no encontrado, no se ha enviado la información del ID correctamente !!",
                );
            } // FIN | Evalua Json
        } else {
            $data = array(
                "status" => "error",
                "code" => "400",
                "msg" => "Error, Authorization not valid. Tu sessión a caducado, por favor cierra y vuelve a iniciar para continuar !!",
            );
        }

        // Retorno de la Funcion
        return $helpers->json($data);

        // FIN | FND-00003
    }

}
