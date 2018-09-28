<?php

namespace BackendBundle\Entity;

/**
 * TblAdmonFinanciero
 */
class TblAdmonFinanciero
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
    private $nombreAdmonFinanciero;

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
     * @return TblAdmonFinanciero
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
     * Set nombreAdmonFinanciero
     *
     * @param string $nombreAdmonFinanciero
     *
     * @return TblAdmonFinanciero
     */
    public function setNombreAdmonFinanciero($nombreAdmonFinanciero)
    {
        $this->nombreAdmonFinanciero = $nombreAdmonFinanciero;

        return $this;
    }

    /**
     * Get nombreAdmonFinanciero
     *
     * @return string
     */
    public function getNombreAdmonFinanciero()
    {
        return $this->nombreAdmonFinanciero;
    }

    /**
     * Set idOrganizacion
     *
     * @param \BackendBundle\Entity\TblOrganizaciones $idOrganizacion
     *
     * @return TblAdmonFinanciero
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

