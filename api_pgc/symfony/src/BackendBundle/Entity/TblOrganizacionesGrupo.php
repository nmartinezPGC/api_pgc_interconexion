<?php

namespace BackendBundle\Entity;

/**
 * TblOrganizacionesGrupo
 */
class TblOrganizacionesGrupo
{
    /**
     * @var integer
     */
    private $idOrgGrupo;

    /**
     * @var string
     */
    private $orgGrupoName;

    /**
     * @var string
     */
    private $orgGrupoCode;

    /**
     * @var \BackendBundle\Entity\TblOrganizacionesTipo
     */
    private $orgType;


    /**
     * Get idOrgGrupo
     *
     * @return integer
     */
    public function getIdOrgGrupo()
    {
        return $this->idOrgGrupo;
    }

    /**
     * Set orgGrupoName
     *
     * @param string $orgGrupoName
     *
     * @return TblOrganizacionesGrupo
     */
    public function setOrgGrupoName($orgGrupoName)
    {
        $this->orgGrupoName = $orgGrupoName;

        return $this;
    }

    /**
     * Get orgGrupoName
     *
     * @return string
     */
    public function getOrgGrupoName()
    {
        return $this->orgGrupoName;
    }

    /**
     * Set orgGrupoCode
     *
     * @param string $orgGrupoCode
     *
     * @return TblOrganizacionesGrupo
     */
    public function setOrgGrupoCode($orgGrupoCode)
    {
        $this->orgGrupoCode = $orgGrupoCode;

        return $this;
    }

    /**
     * Get orgGrupoCode
     *
     * @return string
     */
    public function getOrgGrupoCode()
    {
        return $this->orgGrupoCode;
    }

    /**
     * Set orgType
     *
     * @param \BackendBundle\Entity\TblOrganizacionesTipo $orgType
     *
     * @return TblOrganizacionesGrupo
     */
    public function setOrgType(\BackendBundle\Entity\TblOrganizacionesTipo $orgType = null)
    {
        $this->orgType = $orgType;

        return $this;
    }

    /**
     * Get orgType
     *
     * @return \BackendBundle\Entity\TblOrganizacionesTipo
     */
    public function getOrgType()
    {
        return $this->orgType;
    }
}
