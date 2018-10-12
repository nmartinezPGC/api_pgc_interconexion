<?php

/**
 * Description of SectorController
 *
 * @author Nahum Martinez <nmartinez.salgado@yahoo.com>
 */

namespace AppBundle\Controller\Sector;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse as JsonResponse;
// Recuros de la Clase
use Symfony\Component\Validator\Constraints as Assert;

use BackendBundle\Entity\TblSectores;
use BackendBundle\Entity\TblProyectosSector;

class SectorController extends Controller {

    /**
     * Method: Consulta Sectores All de la API
     * Function: FND-00001
     * @Route("/sector/find-all-sectors", name="findAllsectors")
     * Description: Funcion de consulta de todos los Sectores de la API
     * que la información esta registrada en l BD de la PGC.
     * @param authorization Token de la API, generado por el EndPoint /login      
     */
    public function findAllSectorsAction(Request $request) {
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
             * Todos los Sectores registrados en la PGC, 
             * sin filtros y con
             * sus respectivas relaciones para los datos generales.
             */
            $sectorsPGCAll = $em->getRepository("BackendBundle:TblSectores")->findAll();

            $countSectors = count( $sectorsPGCAll );

            if ( $countSectors > 0) {
                $data = array(
                    "status" => "success",
                    "code" => 200,
                    "msg" => "En hora buena, tus datos se han obtenido de forma satisfactoria !!",
                    "totalRecords" => $countSectors,
                    "data" => $sectorsPGCAll,
                );
            } else {
                $data = array(
                    "status" => "error",
                    "code" => 300,
                    "msg" => "No existen Sectores registrados en la BD !!",
                    "totalRecords" => $countSectors,
                    "data" => $sectorsPGCAll,
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
     * Method: Consulta de Sector por Identificar ID de la API
     * Function: FND-00002
     * @Route("/sector/find-sector", name="sectorUnique")
     * Description: Funcion de consulta del Sector espefico del Proyecto de 
     * la API, por su ID unico registrado en la BD de la PGC.
     * @param authorization Token de la API, generado por el EndPoint /login      
     * @param json $idSector Identificardor númerico del Proyecto
     */
    public function sectorUniqueAction(Request $request) {
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

                $id_sector = ( isset($params->idSector) ) ? $params->idSector : null;

                /*
                 * El Sector indicado registrados en la PGC, con filtros 
                 * (idSector) y con sus respectivas relaciones para los datos 
                 * generales.
                 */
                $sectorId = $em->getRepository("BackendBundle:TblSectores")->findOneBy(
                        array(
                            "idSector" => $id_sector
                        )
                );

                // Conteo de los Registros
                $countSector = count( $sectorId );

                if ( $countSector > 0 ) {
                    $data = array(
                        "status" => "success",
                        "code" => 200,
                        "msg" => "En hora buena, tus datos se han obtenido de forma satisfactoria !!",
                        "totalRecords" => $countSector,
                        "data" => $sectorId,
                    );
                } else {
                    $data = array(
                        "status" => "error",
                        "code" => 300,
                        "msg" => "No existe un Sector en la base de datos, con el ID Solicitado !!",
                        "totalRecords" => $countSector,
                        "data" => $sectorId,
                    );
                }
            } else {
                $data = array(
                    "status" => "error",
                    "code" => 400,
                    "msg" => "Admon. Finaciero no encontrado, no se ha enviado la información del ID correctamente !!",
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
     * @Route("/sector/find-project-sector", name="findProjectForIdSector")
     * Description: Funcion de consulta de la Agencia Beneficiaria del Proyecto de 
     * la API, por su ID unico registrado en la BD de la PGC.
     * @param authorization Token de la API, generado por el EndPoint /login      
     * @param json $idProjecto Identificardor númerico del Proyecto
     */
    public function findProjectForIdSectorAction(Request $request) {
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
                 * Todos los Sectores registrados en la PGC, con filtros 
                 * (idProjecto) y con sus respectivas relaciones para los datos 
                 * generales.
                 */
                $proyectoPGCIdSector = $em->getRepository("BackendBundle:TblProyectoSector")->findOneBy(
                        array(
                            "idProyecto" => $id_proyecto
                        )
                );

                // Conteo de los Registros
                $countProjects = count( $proyectoPGCIdSector );

                if ( $countProjects > 0) {
                    $data = array(
                        "status" => "success",
                        "code" => 200,
                        "msg" => "En hora buena, tus datos se han obtenido de forma satisfactoria !!",
                        "totalRecords" => $countProjects,
                        "data" => $proyectoPGCIdSector,
                    );
                } else {
                    $data = array(
                        "status" => "error",
                        "code" => 300,
                        "msg" => "No existe un Sector para el Proyecto, con el ID Solicitado !!",
                        "totalRecords" => $countProjects,
                        "data" => $proyectoPGCIdSector,
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
