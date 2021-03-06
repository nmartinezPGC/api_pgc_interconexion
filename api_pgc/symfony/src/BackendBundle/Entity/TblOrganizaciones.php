<?php

namespace BackendBundle\Entity;

/**
 * TblOrganizaciones
 */
class TblOrganizaciones
{
    /**
     * @var integer
     */
    private $idOrg;

    /**
     * @var string
     */
    private $orgName;

    /**
     * @var string
     */
    private $descripcion;

    /**
     * @var string
     */
    private $direccion;

    /**
     * @var string
     */
    private $orgUrl;

    /**
     * @var string
     */
    private $orgAcronimo;

    /**
     * @var string
     */
    private $orgProposito;

    /**
     * @var \BackendBundle\Entity\TblOrganizacionesGrupo
     */
    private $idOrgGrupo;


    /**
     * Get idOrg
     *
     * @return integer
     */
    public function getIdOrg()
    {
        return $this->idOrg;
    }

    /**
     * Set orgName
     *
     * @param string $orgName
     *
     * @return TblOrganizaciones
     */
    public function setOrgName($orgName)
    {
        $this->orgName = $orgName;

        return $this;
    }

    /**
     * Get orgName
     *
     * @return string
     */
    public function getOrgName()
    {
        return $this->orgName;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     *
     * @return TblOrganizaciones
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set direccion
     *
     * @param string $direccion
     *
     * @return TblOrganizaciones
     */
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;

        return $this;
    }

    /**
     * Get direccion
     *
     * @return string
     */
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * Set orgUrl
     *
     * @param string $orgUrl
     *
     * @return TblOrganizaciones
     */
    public function setOrgUrl($orgUrl)
    {
        $this->orgUrl = $orgUrl;

        return $this;
    }

    /**
     * Get orgUrl
     *
     * @return string
     */
    public function getOrgUrl()
    {
        return $this->orgUrl;
    }

    /**
     * Set orgAcronimo
     *
     * @param string $orgAcronimo
     *
     * @return TblOrganizaciones
     */
    public function setOrgAcronimo($orgAcronimo)
    {
        $this->orgAcronimo = $orgAcronimo;

        return $this;
    }

    /**
     * Get orgAcronimo
     *
     * @return string
     */
    public function getOrgAcronimo()
    {
        return $this->orgAcronimo;
    }

    /**
     * Set orgProposito
     *
     * @param string $orgProposito
     *
     * @return TblOrganizaciones
     */
    public function setOrgProposito($orgProposito)
    {
        $this->orgProposito = $orgProposito;

        return $this;
    }

    /**
     * Get orgProposito
     *
     * @return string
     */
    public function getOrgProposito()
    {
        return $this->orgProposito;
    }

    /**
     * Set idOrgGrupo
     *
     * @param \BackendBundle\Entity\TblOrganizacionesGrupo $idOrgGrupo
     *
     * @return TblOrganizaciones
     */
    public function setIdOrgGrupo(\BackendBundle\Entity\TblOrganizacionesGrupo $idOrgGrupo = null)
    {
        $this->idOrgGrupo = $idOrgGrupo;

        return $this;
    }

    /**
     * Get idOrgGrupo
     *
     * @return \BackendBundle\Entity\TblOrganizacionesGrupo
     */
    public function getIdOrgGrupo()
    {
        return $this->idOrgGrupo;
    }
}
