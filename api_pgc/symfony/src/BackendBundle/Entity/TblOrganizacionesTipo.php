<?php

namespace BackendBundle\Entity;

/**
 * TblOrganizacionesTipo
 */
class TblOrganizacionesTipo
{
    /**
     * @var integer
     */
    private $idOrgType;

    /**
     * @var string
     */
    private $orgTypeNombre;

    /**
     * @var string
     */
    private $orgTypeCode;


    /**
     * Get idOrgType
     *
     * @return integer
     */
    public function getIdOrgType()
    {
        return $this->idOrgType;
    }

    /**
     * Set orgTypeNombre
     *
     * @param string $orgTypeNombre
     *
     * @return TblOrganizacionesTipo
     */
    public function setOrgTypeNombre($orgTypeNombre)
    {
        $this->orgTypeNombre = $orgTypeNombre;

        return $this;
    }

    /**
     * Get orgTypeNombre
     *
     * @return string
     */
    public function getOrgTypeNombre()
    {
        return $this->orgTypeNombre;
    }

    /**
     * Set orgTypeCode
     *
     * @param string $orgTypeCode
     *
     * @return TblOrganizacionesTipo
     */
    public function setOrgTypeCode($orgTypeCode)
    {
        $this->orgTypeCode = $orgTypeCode;

        return $this;
    }

    /**
     * Get orgTypeCode
     *
     * @return string
     */
    public function getOrgTypeCode()
    {
        return $this->orgTypeCode;
    }
}

