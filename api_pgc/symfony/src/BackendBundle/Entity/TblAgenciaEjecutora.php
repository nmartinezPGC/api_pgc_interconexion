<?php

namespace BackendBundle\Entity;

/**
 * TblAgenciaEjecutora
 */
class TblAgenciaEjecutora
{
    /**
     * @var integer
     */
    private $idRegistro;

    /**
     * @var integer
     */
    private $idProyecto;

    /**
     * @var string
     */
    private $nombreAgenciaEjecutora;

    /**
     * @var \BackendBundle\Entity\TblOrganizaciones
     */
    private $idOrganizacion;


    /**
     * Get idRegistro
     *
     * @return integer
     */
    public function getIdRegistro()
    {
        return $this->idRegistro;
    }

    /**
     * Set idProyecto
     *
     * @param integer $idProyecto
     *
     * @return TblAgenciaEjecutora
     */
    public function setIdProyecto($idProyecto)
    {
        $this->idProyecto = $idProyecto;

        return $this;
    }

    /**
     * Get idProyecto
     *
     * @return integer
     */
    public function getIdProyecto()
    {
        return $this->idProyecto;
    }

    /**
     * Set nombreAgenciaEjecutora
     *
     * @param string $nombreAgenciaEjecutora
     *
     * @return TblAgenciaEjecutora
     */
    public function setNombreAgenciaEjecutora($nombreAgenciaEjecutora)
    {
        $this->nombreAgenciaEjecutora = $nombreAgenciaEjecutora;

        return $this;
    }

    /**
     * Get nombreAgenciaEjecutora
     *
     * @return string
     */
    public function getNombreAgenciaEjecutora()
    {
        return $this->nombreAgenciaEjecutora;
    }

    /**
     * Set idOrganizacion
     *
     * @param \BackendBundle\Entity\TblOrganizaciones $idOrganizacion
     *
     * @return TblAgenciaEjecutora
     */
    public function setIdOrganizacion(\BackendBundle\Entity\TblOrganizaciones $idOrganizacion = null)
    {
        $this->idOrganizacion = $idOrganizacion;

        return $this;
    }

    /**
     * Get idOrganizacion
     *
     * @return \BackendBundle\Entity\TblOrganizaciones
     */
    public function getIdOrganizacion()
    {
        return $this->idOrganizacion;
    }
}

