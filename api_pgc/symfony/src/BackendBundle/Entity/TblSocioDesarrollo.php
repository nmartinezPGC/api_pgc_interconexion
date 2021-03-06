<?php

namespace BackendBundle\Entity;

/**
 * TblSocioDesarrollo
 */
class TblSocioDesarrollo
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
    private $nombreSocioDesarrollo;

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
     * @return TblSocioDesarrollo
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
     * Set nombreSocioDesarrollo
     *
     * @param string $nombreSocioDesarrollo
     *
     * @return TblSocioDesarrollo
     */
    public function setNombreSocioDesarrollo($nombreSocioDesarrollo)
    {
        $this->nombreSocioDesarrollo = $nombreSocioDesarrollo;

        return $this;
    }

    /**
     * Get nombreSocioDesarrollo
     *
     * @return string
     */
    public function getNombreSocioDesarrollo()
    {
        return $this->nombreSocioDesarrollo;
    }

    /**
     * Set idOrganizacion
     *
     * @param \BackendBundle\Entity\TblOrganizaciones $idOrganizacion
     *
     * @return TblSocioDesarrollo
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
