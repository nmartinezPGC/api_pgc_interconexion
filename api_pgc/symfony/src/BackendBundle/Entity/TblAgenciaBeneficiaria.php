<?php

namespace BackendBundle\Entity;

/**
 * TblAgenciaBeneficiaria
 */
class TblAgenciaBeneficiaria
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
    private $nombreAgenciaBeneficiaria;

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
     * @return TblAgenciaBeneficiaria
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
     * Set nombreAgenciaBeneficiaria
     *
     * @param string $nombreAgenciaBeneficiaria
     *
     * @return TblAgenciaBeneficiaria
     */
    public function setNombreAgenciaBeneficiaria($nombreAgenciaBeneficiaria)
    {
        $this->nombreAgenciaBeneficiaria = $nombreAgenciaBeneficiaria;

        return $this;
    }

    /**
     * Get nombreAgenciaBeneficiaria
     *
     * @return string
     */
    public function getNombreAgenciaBeneficiaria()
    {
        return $this->nombreAgenciaBeneficiaria;
    }

    /**
     * Set idOrganizacion
     *
     * @param \BackendBundle\Entity\TblOrganizaciones $idOrganizacion
     *
     * @return TblAgenciaBeneficiaria
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
