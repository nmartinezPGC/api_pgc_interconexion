<?php

/**
 * Description of ProjectController
 *
 * @author Sammy Guergachi <sguergachi at gmail.com>
 */

namespace AppBundle\Controller\Projects;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse as JsonResponse;
// Recuros de la Clase
use Symfony\Component\Validator\Constraints as Assert;
use BackendBundle\Entity\TblProyectos;

class ProjectController extends Controller {

    /**
     * Method: Consulta Proyectos All de la API
     * Function: FND-00001
     * @Route("/project/find-all-projects", name="findAllProjects")
     * Description: Funcion de consulta de todos los Projectos de la API
     * que la información esta registrada en l BD de la PGC.
     * @param authorization Token de la API, generado por el EndPoint /login      
     */
    public function findAllProjectsAction(Request $request) {
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
             * Todos los proyectos registrados en la PGC, sin filtros y con
             * sus respectivas relaciones para los datos generales.
             */
            $proyectosPGCAll = $em->getRepository("BackendBundle:TblProyectos")->findAll();

            $countProjects = count($proyectosPGCAll);

            if ($countProjects > 0) {
                $data = array(
                    "status" => "success",
                    "code" => "200",
                    "msg" => "En hora buena, tus datos se han obtenido de forma satisfactoria !!",
                    "totalRecords" => $countProjects,
                    "data" => $proyectosPGCAll,
                );
            } else {
                $data = array(
                    "status" => "error",
                    "code" => 300,
                    "msg" => "No existen Proyectos registrados en la BD !!",
                    "totalRecords" => $countProjects,
                    "data" => $proyectoPGCCode,
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
     * Method: Consulta Proyectos por Identificar ID de la API
     * Function: FND-00002
     * @Route("/project/find-project-id", name="findProjectForId")
     * Description: Funcion de consulta del Projecto de la API, por su ID
     * unico registrado en la BD de la PGC.
     * @param authorization Token de la API, generado por el EndPoint /login      
     * @param json $idProjecto Identificardor númerico del Proyecto
     */
    public function findProjectForIdAction(Request $request) {
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
                 * Todos los proyectos registrados en la PGC, con filtros 
                 * (idProjecto) y con sus respectivas relaciones para los datos 
                 * generales.
                 */
                $proyectoPGCId = $em->getRepository("BackendBundle:TblProyectos")->findOneBy(
                        array(
                            "idProjecto" => $id_proyecto
                        )
                );

                // Conteo de los Registros
                $countProjects = count($proyectoPGCId);

                if ($countProjects > 0) {
                    $data = array(
                        "status" => "success",
                        "code" => 200,
                        "msg" => "En hora buena, tus datos se han obtenido de forma satisfactoria !!",
                        "totalRecords" => $countProjects,
                        "data" => $proyectoPGCId,
                    );
                } else {
                    $data = array(
                        "status" => "error",
                        "code" => 300,
                        "msg" => "No existe un Proyecto con el ID Solictado !!",
                        "totalRecords" => $countProjects,
                        "data" => $proyectoPGCCode,
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

        // FIN | FND-00002
    }

    /**
     * Method: Consulta Proyectos por Identificar codigoPGC de la API
     * Function: FND-00003
     * @Route("/project/find-project-code", name="findProjectForCode")
     * Description: Funcion de consulta del Projecto de la API, por su CodigoPGC
     * unico registrado en la BD de la PGC.
     * @param authorization Token de la API, generado por el EndPoint /login      
     * @param json $codigoPgc Identificardor varcChar del Proyecto
     */
    public function findProjectForCodeAction(Request $request) {
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

                $codigo_pgc = ( isset($params->codigoPgc) ) ? $params->codigoPgc : null;

                /*
                 * Todos los proyectos registrados en la PGC, con filtros 
                 * (idProjecto) y con sus respectivas relaciones para los datos 
                 * generales.
                 */
                $proyectoPGCCode = $em->getRepository("BackendBundle:TblProyectos")->findBy(
                        array(
                            "codigoPgc" => $codigo_pgc
                        )
                );

                // Conteo de los Registros
                $countProjects = count($proyectoPGCCode);

                if ($countProjects > 0) {
                    $data = array(
                        "status" => "success",
                        "code" => 200,
                        "msg" => "En hora buena, tus datos se han obtenido de forma satisfactoria !!",
                        "totalRecords" => $countProjects,
                        "data" => $proyectoPGCCode,
                    );
                } else {
                    $data = array(
                        "status" => "error",
                        "code" => 300,
                        "msg" => "No existe un Proyecto con el Codigo Solictado !!",
                        "totalRecords" => $countProjects,
                        "data" => $proyectoPGCCode,
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

    /**
     * Method: Consulta Proyectos por Identificar nombre del Proyecto PGC de la API
     * Function: FND-00004
     * @Route("/project/find-project-name", name="findProjectForName")
     * Description: Funcion de consulta del Projecto de la API, por su Nombre PGC
     * unico registrado en la BD de la PGC.
     * @param authorization Token de la API, generado por el EndPoint /login      
     * @param json $codigoPgc Identificardor varcChar del Proyecto
     */
    public function findProjectForNameAction(Request $request) {
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

                $name_pgc = ( isset($params->nombreProyecto) ) ? $params->nombreProyecto : null;

                /*
                 * Todos los proyectos registrados en la PGC, con filtros 
                 * (idProjecto) y con sus respectivas relaciones para los datos 
                 * generales.
                 */
                /*$proyectoPGCCode = $em->getRepository("BackendBundle:TblProyectos")->findBy(
                        array(
                            "codigoPgc" => $name_pgc
                        )
                );*/


                $proyectoPGCCode = $this->getDoctrine()
                        ->getRepository('BackendBundle:TblProyectos');
                $query = $proyectoPGCCode->createQueryBuilder('a')
                        ->where('a.nombreProyecto LIKE :title')
                        ->setParameter('title', '%' . $name_pgc . '%')
                        ->getQuery();
                
                $toto = $query->getResult();

                // Conteo de los Registros
                $countProjects = count($toto);

                if ($countProjects > 0) {
                    $data = array(
                        "status" => "success",
                        "code" => 200,
                        "msg" => "En hora buena, tus datos se han obtenido de forma satisfactoria !!",
                        "totalRecords" => $countProjects,
                        "data" => $toto,
                    );
                } else {
                    $data = array(
                        "status" => "error",
                        "code" => 300,
                        "msg" => "No existe un Proyecto con el Codigo Solictado !!",
                        "totalRecords" => $countProjects,
                        "data" => $toto,
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

        // FIN | FND-00004
    }

}
