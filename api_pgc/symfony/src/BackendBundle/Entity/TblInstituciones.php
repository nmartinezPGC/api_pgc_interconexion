<?php

namespace BackendBundle\Entity;

/**
 * TblInstituciones
 */
class TblInstituciones
{
    /**
     * @var integer
     */
    private $idInstitucion;

    /**
     * @var string
     */
    private $codInstitucion;

    /**
     * @var string
     */
    private $nombreInstitucion;

    /**
     * @var string
     */
    private $acronimo;

    /**
     * @var boolean
     */
    private $activo = true;


    /**
     * Get idInstitucion
     *
     * @return integer
     */
    public function getIdInstitucion()
    {
        return $this->idInstitucion;
    }

    /**
     * Set codInstitucion
     *
     * @param string $codInstitucion
     *
     * @return TblInstituciones
     */
    public function setCodInstitucion($codInstitucion)
    {
        $this->codInstitucion = $codInstitucion;

        return $this;
    }

    /**
     * Get codInstitucion
     *
     * @return string
     */
    public function getCodInstitucion()
    {
        return $this->codInstitucion;
    }

    /**
     * Set nombreInstitucion
     *
     * @param string $nombreInstitucion
     *
     * @return TblInstituciones
     */
    public function setNombreInstitucion($nombreInstitucion)
    {
        $this->nombreInstitucion = $nombreInstitucion;

        return $this;
    }

    /**
     * Get nombreInstitucion
     *
     * @return string
     */
    public function getNombreInstitucion()
    {
        return $this->nombreInstitucion;
    }

    /**
     * Set acronimo
     *
     * @param string $acronimo
     *
     * @return TblInstituciones
     */
    public function setAcronimo($acronimo)
    {
        $this->acronimo = $acronimo;

        return $this;
    }

    /**
     * Get acronimo
     *
     * @return string
     */
    public function getAcronimo()
    {
        return $this->acronimo;
    }

    /**
     * Set activo
     *
     * @param boolean $activo
     *
     * @return TblInstituciones
     */
    public function setActivo($activo)
    {
        $this->activo = $activo;

        return $this;
    }

    /**
     * Get activo
     *
     * @return boolean
     */
    public function getActivo()
    {
        return $this->activo;
    }
}
