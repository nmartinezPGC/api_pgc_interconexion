<?php

/**
 * Description of FundingController
 *
 * @author Nahum Martinez <nmartinez.salgado@yahoo.com>
 */

namespace AppBundle\Controller\Funding;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse as JsonResponse;
// Recuros de la Clase
use Symfony\Component\Validator\Constraints as Assert;
use BackendBundle\Entity\TblProyectosFondos;

class FundingController extends Controller {

    /**
     * Method: Consulta Funding All de la API
     * Function: FND-00001
     * @Route("/funding/find-all-fundings", name="findAllFundings")
     * Description: Funcion de consulta de todos las Fondos de la API
     * que la información esta registrada en l BD de la PGC.
     * @param authorization Token de la API, generado por el EndPoint /login      
     */
    public function findAllFundingsAction(Request $request) {
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
             * Todos los Fondos registrados en la PGC, 
             * sin filtros y con
             * sus respectivas relaciones para los datos generales.
             */
            $fondosPGCAll = $em->getRepository("BackendBundle:TblProyectoFondos")->findAll();

            $countFondos = count( $fondosPGCAll );

            if ($countFondos > 0) {
                $data = array(
                    "status" => "success",
                    "code" => 200,
                    "msg" => "En hora buena, tus datos se han obtenido de forma satisfactoria !!",
                    "totalRecords" => $countFondos,
                    "data" => $fondosPGCAll,
                );
            } else {
                $data = array(
                    "status" => "error",
                    "code" => 300,
                    "msg" => "No existen Fondos registrados en la BD !!",
                    "totalRecords" => $countFondos,
                    "data" => $fondosPGCAll,
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
     * @Route("/funding/find-funding-transaction-type", name="findFundingTransactionType")
     * Description: Funcion de consulta los Fondos espeficos del Proyecto de 
     * la API, por su ID unico registrado en la BD de la PGC.
     * @param authorization Token de la API, generado por el EndPoint /login      
     * @param json $codigoPgc Identificardor númerico del Proyecto
     */
    public function findFundingTransactionTypeAction(Request $request) {
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

                //$cod_pgc = ( isset($params->codigoPGC) ) ? $params->codigoPGC : null;
                $id_proyecto = ( isset($params->idProyecto) ) ? $params->idProyecto : null;
                $tipo_transaccion = ( isset($params->tipoTransaccion) ) ? $params->tipoTransaccion : null;

                /*
                 * Los Fondos consultados indicado registrados en la PGC, con filtros 
                 * (codigoPGC) y con sus respectivas relaciones para los datos 
                 * generales.
                 */
                $proyectosFondos = $em->getRepository("BackendBundle:TblProyectoFondos")->findBy(
                        array(
                            "idProyecto" => $id_proyecto,
                            "tipoTransaccion" => $tipo_transaccion,
                        )
                );

                // Conteo de los Registros
                $countProyFondos = count( $proyectosFondos );

                if ( $countProyFondos > 0) {
                    $data = array(
                        "status" => "success",
                        "code" => 200,
                        "msg" => "En hora buena, tus datos se han obtenido de forma satisfactoria !!",
                        "totalRecords" => $countProyFondos,
                        "data" => $proyectosFondos,
                    );
                } else {
                    $data = array(
                        "status" => "error",
                        "code" => 300,
                        "msg" => "No existen fondos registrados en la base de datos, con el Codigo de Proyecto PGC Solicitado !!",
                        "totalRecords" => $countProyFondos,
                        "data" => $proyectosFondos,
                    );
                }
            } else {
                $data = array(
                    "status" => "error",
                    "code" => 400,
                    "msg" => "Fondos no encontrados, no se ha enviado la información del Codigo del Proyecto correctamente !!",
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
     * @Route("/funding/find-project-funding", name="findProjectForIdFunding")
     * Description: Funcion de consulta de todos los Fondos del 
     * Proyecto de la API, por su ID unico registrado en la BD de la PGC.
     * @param authorization Token de la API, generado por el EndPoint /login      
     * @param json $idProjecto Identificardor númerico del Proyecto
     */
    public function findProjectForIdFundingAction(Request $request) {
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
                 * Todos los Fondos registrados en la PGC, con filtros 
                 * (idProyecto) y con sus respectivas relaciones para los datos 
                 * generales.
                 */
                $proyectoPGCIdFunding = $em->getRepository("BackendBundle:TblProyectoFondos")->findBy(
                        array(
                            "idProyecto" => $id_proyecto
                        )
                );

                // Conteo de los Registros
                $countProjects = count( $proyectoPGCIdFunding );

                if ($countProjects > 0) {
                    $data = array(
                        "status" => "success",
                        "code" => 200,
                        "msg" => "En hora buena, tus datos se han obtenido de forma satisfactoria !!",
                        "totalRecords" => $countProjects,
                        "data" => $proyectoPGCIdFunding,
                    );
                } else {
                    $data = array(
                        "status" => "error",
                        "code" => 300,
                        "msg" => "No existen Fondos para el Proyecto, con el ID Solicitado !!",
                        "totalRecords" => $countProjects,
                        "data" => $proyectoPGCIdFunding,
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
