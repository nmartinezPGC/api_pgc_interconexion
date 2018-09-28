<?php

/**
 * Description of AgencyController
 *
 * @author Nahum Martinez <nmartinez.salgado@yahoo.com>
 */

namespace AppBundle\Controller\Agency;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse as JsonResponse;
// Recuros de la Clase
use Symfony\Component\Validator\Constraints as Assert;
use BackendBundle\Entity\TblAdmonFinaciero;
use BackendBundle\Entity\TblAgenciaBeneficiaria;
use BackendBundle\Entity\TblAgenciaEjecutora;
use BackendBundle\Entity\TblSocioDesarrollo;

class AgencyController extends Controller {

    /**
     * Method: Consulta AdmonFinaciero All de la API
     * Function: FND-00001
     * @Route("/agency/find-all-admon-financ", name="findAllAdmonFinanc")
     * Description: Funcion de consulta de todos los Projectos de la API
     * que la información esta registrada en l BD de la PGC.
     * @param authorization Token de la API, generado por el EndPoint /login      
     */
    public function findAllAdmonFinancAction(Request $request) {
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
             * Todos las Administradores Financieros registrados en la PGC, 
             * sin filtros y con
             * sus respectivas relaciones para los datos generales.
             */
            $admonFinanPGCAll = $em->getRepository("BackendBundle:TblAdmonFinanciero")->findAll();

            $countProjects = count($admonFinanPGCAll);

            if ($countProjects > 0) {
                $data = array(
                    "status" => "success",
                    "code" => "200",
                    "msg" => "En hora buena, tus datos se han obtenido de forma satisfactoria !!",
                    "totalRecords" => $countProjects,
                    "data" => $admonFinanPGCAll,
                );
            } else {
                $data = array(
                    "status" => "error",
                    "code" => 300,
                    "msg" => "No existen Proyectos registrados en la BD !!",
                    "totalRecords" => $countProjects,
                    "data" => $admonFinanPGCAll,
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
     * Method: Consulta de Admon. Financiero del Proyecto por Identificar ID de la API
     * Function: FND-00002
     * @Route("/agency/find-project-admon-financ", name="findProjectForIdAdmonFinanc")
     * Description: Funcion de consulta del Admon. Financiero del Proyecto de 
     * la API, por su ID unico registrado en la BD de la PGC.
     * @param authorization Token de la API, generado por el EndPoint /login      
     * @param json $idProjecto Identificardor númerico del Proyecto
     */
    public function findProjectForIdAdmonFinancAction(Request $request) {
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
                 * Todos los Admon. Financieros registrados en la PGC, con filtros 
                 * (idProjecto) y con sus respectivas relaciones para los datos 
                 * generales.
                 */
                $proyectoPGCIdAdmon = $em->getRepository("BackendBundle:TblAdmonFinanciero")->findOneBy(
                        array(
                            "idProyecto" => $id_proyecto
                        )
                );

                // Conteo de los Registros
                $countProjects = count($proyectoPGCIdAdmon);

                if ($countProjects > 0) {
                    $data = array(
                        "status" => "success",
                        "code" => 200,
                        "msg" => "En hora buena, tus datos se han obtenido de forma satisfactoria !!",
                        "totalRecords" => $countProjects,
                        "data" => $proyectoPGCIdAdmon,
                    );
                } else {
                    $data = array(
                        "status" => "error",
                        "code" => 300,
                        "msg" => "No existe un Admon. Financiero para este Proyecto, con el ID Solicitado !!",
                        "totalRecords" => $countProjects,
                        "data" => $proyectoPGCIdAdmon,
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
     * Method: Consulta AgencyBeneficiary All de la API
     * Function: FND-00003
     * @Route("/agency/find-all-agency-beneficiary", name="findAllAgencyBeneficiary")
     * Description: Funcion de consulta de todos los Projectos de la API
     * que la información esta registrada en l BD de la PGC.
     * @param authorization Token de la API, generado por el EndPoint /login      
     */
    public function findAllAgencyBeneficiaryAction(Request $request) {
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
             * Todos las Administradores Financieros registrados en la PGC, 
             * sin filtros y con
             * sus respectivas relaciones para los datos generales.
             */
            $agencyBenPGCAll = $em->getRepository("BackendBundle:TblAgenciaBeneficiaria")->findAll();

            $countProjects = count($agencyBenPGCAll);

            if ($countProjects > 0) {
                $data = array(
                    "status" => "success",
                    "code" => "200",
                    "msg" => "En hora buena, tus datos se han obtenido de forma satisfactoria !!",
                    "totalRecords" => $countProjects,
                    "data" => $agencyBenPGCAll,
                );
            } else {
                $data = array(
                    "status" => "error",
                    "code" => 300,
                    "msg" => "No existen Proyectos registrados en la BD !!",
                    "totalRecords" => $countProjects,
                    "data" => $agencyBenPGCAll,
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

        // FIN | FND-00003
    }

    /**
     * Method: Consulta de Agencia Beneficiaria del Proyecto por Identificar ID de la API
     * Function: FND-00004
     * @Route("/agency/find-project-agency-beneficiary", name="findProjectForIdAgencyBeneficiary")
     * Description: Funcion de consulta de la Agencia Beneficiaria del Proyecto de 
     * la API, por su ID unico registrado en la BD de la PGC.
     * @param authorization Token de la API, generado por el EndPoint /login      
     * @param json $idProjecto Identificardor númerico del Proyecto
     */
    public function findProjectForIdAgencyBeneficiaryAction(Request $request) {
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
                 * Todos los Admon. Financieros registrados en la PGC, con filtros 
                 * (idProjecto) y con sus respectivas relaciones para los datos 
                 * generales.
                 */
                $proyectoPGCIdAgencyBen = $em->getRepository("BackendBundle:TblAgenciaBeneficiaria")->findOneBy(
                        array(
                            "idProyecto" => $id_proyecto
                        )
                );

                // Conteo de los Registros
                $countProjects = count($proyectoPGCIdAgencyBen);

                if ($countProjects > 0) {
                    $data = array(
                        "status" => "success",
                        "code" => 200,
                        "msg" => "En hora buena, tus datos se han obtenido de forma satisfactoria !!",
                        "totalRecords" => $countProjects,
                        "data" => $proyectoPGCIdAgencyBen,
                    );
                } else {
                    $data = array(
                        "status" => "error",
                        "code" => 300,
                        "msg" => "No existe una Agencia Beneficiaria para el Proyecto, con el ID Solicitado !!",
                        "totalRecords" => $countProjects,
                        "data" => $proyectoPGCIdAgencyBen,
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

    /**
     * Method: Consulta AgencyExecutings All de la API
     * Function: FND-00005
     * @Route("/agency/find-all-agency-executing", name="findAllAgencyExecutings")
     * Description: Funcion de consulta de todos los Projectos de la API
     * que la información esta registrada en l BD de la PGC.
     * @param authorization Token de la API, generado por el EndPoint /login      
     */
    public function findAllAgencyExecutingsAction(Request $request) {
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
             * Todos las Administradores Financieros registrados en la PGC, 
             * sin filtros y con
             * sus respectivas relaciones para los datos generales.
             */
            $agencyBenPGCAll = $em->getRepository("BackendBundle:TblAgenciaEjecutora")->findAll();

            $countProjects = count($agencyBenPGCAll);

            if ($countProjects > 0) {
                $data = array(
                    "status" => "success",
                    "code" => "200",
                    "msg" => "En hora buena, tus datos se han obtenido de forma satisfactoria !!",
                    "totalRecords" => $countProjects,
                    "data" => $agencyBenPGCAll,
                );
            } else {
                $data = array(
                    "status" => "error",
                    "code" => 300,
                    "msg" => "No existen Proyectos registrados en la BD !!",
                    "totalRecords" => $countProjects,
                    "data" => $agencyBenPGCAll,
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

        // FIN | FND-00005
    }

    /**
     * Method: Consulta de Agencia Ejecutora del Proyecto por Identificar ID de la API
     * Function: FND-00006
     * @Route("/agency/find-project-agency-executing", name="findProjectForIdAgencyExecuting")
     * Description: Funcion de consulta de la Agencia Ejecutora del Proyecto de 
     * la API, por su ID unico registrado en la BD de la PGC.
     * @param authorization Token de la API, generado por el EndPoint /login      
     * @param json $idProjecto Identificardor númerico del Proyecto
     */
    public function findProjectForIdAgencyExecutingAction(Request $request) {
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
                 * Todos los Agencia Ejecutora registrados en la PGC, con filtros 
                 * (idProjecto) y con sus respectivas relaciones para los datos 
                 * generales.
                 */
                $proyectoPGCIdAgencyBen = $em->getRepository("BackendBundle:TblAgenciaEjecutora")->findOneBy(
                        array(
                            "idProyecto" => $id_proyecto
                        )
                );

                // Conteo de los Registros
                $countProjects = count($proyectoPGCIdAgencyBen);

                if ($countProjects > 0) {
                    $data = array(
                        "status" => "success",
                        "code" => 200,
                        "msg" => "En hora buena, tus datos se han obtenido de forma satisfactoria !!",
                        "totalRecords" => $countProjects,
                        "data" => $proyectoPGCIdAgencyBen,
                    );
                } else {
                    $data = array(
                        "status" => "error",
                        "code" => 300,
                        "msg" => "No existe una Agencia Ejecutora para el Proyecto, con el ID Solicitado !!",
                        "totalRecords" => $countProjects,
                        "data" => $proyectoPGCIdAgencyBen,
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

        // FIN | FND-00006
    }

    /**
     * Method: Consulta Donors All de la API
     * Function: FND-00007
     * @Route("/agency/find-all-donors", name="findAllDonors")
     * Description: Funcion de consulta de todos los Projectos de la API
     * que la información esta registrada en l BD de la PGC.
     * @param authorization Token de la API, generado por el EndPoint /login      
     */
    public function findAllDonorsAction(Request $request) {
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
             * Todos los Socios al Desarrollo registrados en la PGC, 
             * sin filtros y con
             * sus respectivas relaciones para los datos generales.
             */
            $agencyBenPGCAll = $em->getRepository("BackendBundle:TblSocioDesarrollo")->findAll();

            $countProjects = count($agencyBenPGCAll);

            if ($countProjects > 0) {
                $data = array(
                    "status" => "success",
                    "code" => "200",
                    "msg" => "En hora buena, tus datos se han obtenido de forma satisfactoria !!",
                    "totalRecords" => $countProjects,
                    "data" => $agencyBenPGCAll,
                );
            } else {
                $data = array(
                    "status" => "error",
                    "code" => 300,
                    "msg" => "No existen Proyectos registrados en la BD !!",
                    "totalRecords" => $countProjects,
                    "data" => $agencyBenPGCAll,
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

        // FIN | FND-00007
    }

    /**
     * Method: Consulta de Socio al Desarrollo del Proyecto por Identificar ID de la API
     * Function: FND-00008
     * @Route("/agency/find-project-donors", name="findProjectForIdDonors")
     * Description: Funcion de consulta de Socio al Desarrollo del Proyecto de 
     * la API, por su ID unico registrado en la BD de la PGC.
     * @param authorization Token de la API, generado por el EndPoint /login      
     * @param json $idProjecto Identificardor númerico del Proyecto
     */
    public function findProjectForIdDonorsAction(Request $request) {
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
                 * Todos los Socios al Desarrollo registrados en la PGC, con filtros 
                 * (idProjecto) y con sus respectivas relaciones para los datos 
                 * generales.
                 */
                $proyectoPGCIdAgencyBen = $em->getRepository("BackendBundle:TblSocioDesarrollo")->findOneBy(
                        array(
                            "idProyecto" => $id_proyecto
                        )
                );

                // Conteo de los Registros
                $countProjects = count($proyectoPGCIdAgencyBen);

                if ($countProjects > 0) {
                    $data = array(
                        "status" => "success",
                        "code" => 200,
                        "msg" => "En hora buena, tus datos se han obtenido de forma satisfactoria !!",
                        "totalRecords" => $countProjects,
                        "data" => $proyectoPGCIdAgencyBen,
                    );
                } else {
                    $data = array(
                        "status" => "error",
                        "code" => 300,
                        "msg" => "No existe un Socio al Desarrollo para el Proyecto, con el ID Solicitado !!",
                        "totalRecords" => $countProjects,
                        "data" => $proyectoPGCIdAgencyBen,
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

        // FIN | FND-00008
    }

}
