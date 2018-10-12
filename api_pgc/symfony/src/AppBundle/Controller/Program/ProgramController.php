<?php

/**
 * Description of ProgramController
 *
 * @author Nahum Martinez <nmartinez.salgado@yahoo.com>
 */

namespace AppBundle\Controller\Program;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse as JsonResponse;
// Recuros de la Clase
use Symfony\Component\Validator\Constraints as Assert;

use BackendBundle\Entity\TblProgramas;
use BackendBundle\Entity\TblProyectosPrograma;

class ProgramController extends Controller {

    /**
     * Method: Consulta Programas All de la API
     * Function: FND-00001
     * @Route("/program/find-all-programs", name="findAllPrograms")
     * Description: Funcion de consulta de todos los Programas de la API
     * que la información esta registrada en l BD de la PGC.
     * @param authorization Token de la API, generado por el EndPoint /login      
     */
    public function findAllProgramsAction(Request $request) {
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
             * Todos los Programas registrados en la PGC, 
             * sin filtros y con
             * sus respectivas relaciones para los datos generales.
             */
            $programsPGCAll = $em->getRepository("BackendBundle:TblProgramas")->findAll();

            $countPrograms = count( $programsPGCAll );

            if ( $countPrograms > 0) {
                $data = array(
                    "status" => "success",
                    "code" => 200,
                    "msg" => "En hora buena, tus datos se han obtenido de forma satisfactoria !!",
                    "totalRecords" => $countPrograms,
                    "data" => $programsPGCAll,
                );
            } else {
                $data = array(
                    "status" => "error",
                    "code" => 300,
                    "msg" => "No existen Programas registrados en la BD !!",
                    "totalRecords" => $countPrograms,
                    "data" => $programsPGCAll,
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
     * Method: Consulta de Program por Identificar ID de la API
     * Function: FND-00002
     * @Route("/program/find-program", name="programUnique")
     * Description: Funcion de consulta del Programa espefico del Proyecto de 
     * la API, por su ID unico registrado en la BD de la PGC.
     * @param authorization Token de la API, generado por el EndPoint /login      
     * @param json $idSector Identificardor númerico del Proyecto
     */
    public function programUniqueAction(Request $request) {
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

                $id_program = ( isset($params->idProgram) ) ? $params->idProgram : null;

                /*
                 * El Programa indicado registrados en la PGC, con filtros 
                 * (idProgram) y con sus respectivas relaciones para los datos 
                 * generales.
                 */
                $sectorId = $em->getRepository("BackendBundle:TblProgramas")->findOneBy(
                        array(
                            "idPrograma" => $id_program
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
                        "msg" => "No existe un Programa en la base de datos, con el ID Solicitado !!",
                        "totalRecords" => $countSector,
                        "data" => $sectorId,
                    );
                }
            } else {
                $data = array(
                    "status" => "error",
                    "code" => 400,
                    "msg" => "Programa no encontrado, no se ha enviado la información del ID correctamente !!",
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
     * @Route("/program/find-project-program", name="findProjectForIdProgram")
     * Description: Funcion de consulta de la Agencia Beneficiaria del Proyecto de 
     * la API, por su ID unico registrado en la BD de la PGC.
     * @param authorization Token de la API, generado por el EndPoint /login      
     * @param json $idProjecto Identificardor númerico del Proyecto
     */
    public function findProjectForIdProgramAction(Request $request) {
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
                 * (idProyecto) y con sus respectivas relaciones para los datos 
                 * generales.
                 */
                $proyectoPGCIdSector = $em->getRepository("BackendBundle:TblProyectoPrograma")->findOneBy(
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
