<?php

namespace BackendBundle\Entity;

/**
 * TblProgramas
 */
class TblProgramas
{
    /**
     * @var integer
     */
    private $idPadrePrograma;

    /**
     * @var string
     */
    private $codigoPrograma;

    /**
     * @var string
     */
    private $nombrePrograma;

    /**
     * @var integer
     */
    private $nivelPrograma;

    /**
     * @var boolean
     */
    private $borrado = false;

    /**
     * @var \BackendBundle\Entity\TblProgramas
     */
    private $idPrograma;

    /**
     * @var \BackendBundle\Entity\TblCategorias
     */
    private $idCategoria;


    /**
     * Set idPadrePrograma
     *
     * @param integer $idPadrePrograma
     *
     * @return TblProgramas
     */
    public function setIdPadrePrograma($idPadrePrograma)
    {
        $this->idPadrePrograma = $idPadrePrograma;

        return $this;
    }

    /**
     * Get idPadrePrograma
     *
     * @return integer
     */
    public function getIdPadrePrograma()
    {
        return $this->idPadrePrograma;
    }

    /**
     * Set codigoPrograma
     *
     * @param string $codigoPrograma
     *
     * @return TblProgramas
     */
    public function setCodigoPrograma($codigoPrograma)
    {
        $this->codigoPrograma = $codigoPrograma;

        return $this;
    }

    /**
     * Get codigoPrograma
     *
     * @return string
     */
    public function getCodigoPrograma()
    {
        return $this->codigoPrograma;
    }

    /**
     * Set nombrePrograma
     *
     * @param string $nombrePrograma
     *
     * @return TblProgramas
     */
    public function setNombrePrograma($nombrePrograma)
    {
        $this->nombrePrograma = $nombrePrograma;

        return $this;
    }

    /**
     * Get nombrePrograma
     *
     * @return string
     */
    public function getNombrePrograma()
    {
        return $this->nombrePrograma;
    }

    /**
     * Set nivelPrograma
     *
     * @param integer $nivelPrograma
     *
     * @return TblProgramas
     */
    public function setNivelPrograma($nivelPrograma)
    {
        $this->nivelPrograma = $nivelPrograma;

        return $this;
    }

    /**
     * Get nivelPrograma
     *
     * @return integer
     */
    public function getNivelPrograma()
    {
        return $this->nivelPrograma;
    }

    /**
     * Set borrado
     *
     * @param boolean $borrado
     *
     * @return TblProgramas
     */
    public function setBorrado($borrado)
    {
        $this->borrado = $borrado;

        return $this;
    }

    /**
     * Get borrado
     *
     * @return boolean
     */
    public function getBorrado()
    {
        return $this->borrado;
    }

    /**
     * Set idPrograma
     *
     * @param \BackendBundle\Entity\TblProgramas $idPrograma
     *
     * @return TblProgramas
     */
    public function setIdPrograma(\BackendBundle\Entity\TblProgramas $idPrograma = null)
    {
        $this->idPrograma = $idPrograma;

        return $this;
    }

    /**
     * Get idPrograma
     *
     * @return \BackendBundle\Entity\TblProgramas
     */
    public function getIdPrograma()
    {
        return $this->idPrograma;
    }

    /**
     * Set idCategoria
     *
     * @param \BackendBundle\Entity\TblCategorias $idCategoria
     *
     * @return TblProgramas
     */
    public function setIdCategoria(\BackendBundle\Entity\TblCategorias $idCategoria = null)
    {
        $this->idCategoria = $idCategoria;

        return $this;
    }

    /**
     * Get idCategoria
     *
     * @return \BackendBundle\Entity\TblCategorias
     */
    public function getIdCategoria()
    {
        return $this->idCategoria;
    }
}
