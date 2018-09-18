<?php

namespace BackendBundle\Entity;

/**
 * TblProyectos
 */
class TblProyectos
{
    /**
     * @var integer
     */
    private $idRegistro;

    /**
     * @var integer
     */
    private $idProjecto;

    /**
     * @var string
     */
    private $codigoPgc;

    /**
     * @var string
     */
    private $nombreProyecto;

    /**
     * @var \DateTime
     */
    private $fechaEfectividad;

    /**
     * @var \DateTime
     */
    private $fechaFirma;

    /**
     * @var \DateTime
     */
    private $fechaFinalizacion;

    /**
     * @var string
     */
    private $descripcionProyecto;

    /**
     * @var string
     */
    private $objetivosProyecto;

    /**
     * @var string
     */
    private $resultadosProyecto;

    /**
     * @var string
     */
    private $resultadosEsperados;

    /**
     * @var string
     */
    private $antecedentesProyecto;

    /**
     * @var string
     */
    private $estadoProyecto;

    /**
     * @var string
     */
    private $estadoInformacion;

    /**
     * @var string
     */
    private $codigoSefin;

    /**
     * @var \BackendBundle\Entity\TblCategorias
     */
    private $idEstado;


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
     * Set idProjecto
     *
     * @param integer $idProjecto
     *
     * @return TblProyectos
     */
    public function setIdProjecto($idProjecto)
    {
        $this->idProjecto = $idProjecto;

        return $this;
    }

    /**
     * Get idProjecto
     *
     * @return integer
     */
    public function getIdProjecto()
    {
        return $this->idProjecto;
    }

    /**
     * Set codigoPgc
     *
     * @param string $codigoPgc
     *
     * @return TblProyectos
     */
    public function setCodigoPgc($codigoPgc)
    {
        $this->codigoPgc = $codigoPgc;

        return $this;
    }

    /**
     * Get codigoPgc
     *
     * @return string
     */
    public function getCodigoPgc()
    {
        return $this->codigoPgc;
    }

    /**
     * Set nombreProyecto
     *
     * @param string $nombreProyecto
     *
     * @return TblProyectos
     */
    public function setNombreProyecto($nombreProyecto)
    {
        $this->nombreProyecto = $nombreProyecto;

        return $this;
    }

    /**
     * Get nombreProyecto
     *
     * @return string
     */
    public function getNombreProyecto()
    {
        return $this->nombreProyecto;
    }

    /**
     * Set fechaEfectividad
     *
     * @param \DateTime $fechaEfectividad
     *
     * @return TblProyectos
     */
    public function setFechaEfectividad($fechaEfectividad)
    {
        $this->fechaEfectividad = $fechaEfectividad;

        return $this;
    }

    /**
     * Get fechaEfectividad
     *
     * @return \DateTime
     */
    public function getFechaEfectividad()
    {
        return $this->fechaEfectividad;
    }

    /**
     * Set fechaFirma
     *
     * @param \DateTime $fechaFirma
     *
     * @return TblProyectos
     */
    public function setFechaFirma($fechaFirma)
    {
        $this->fechaFirma = $fechaFirma;

        return $this;
    }

    /**
     * Get fechaFirma
     *
     * @return \DateTime
     */
    public function getFechaFirma()
    {
        return $this->fechaFirma;
    }

    /**
     * Set fechaFinalizacion
     *
     * @param \DateTime $fechaFinalizacion
     *
     * @return TblProyectos
     */
    public function setFechaFinalizacion($fechaFinalizacion)
    {
        $this->fechaFinalizacion = $fechaFinalizacion;

        return $this;
    }

    /**
     * Get fechaFinalizacion
     *
     * @return \DateTime
     */
    public function getFechaFinalizacion()
    {
        return $this->fechaFinalizacion;
    }

    /**
     * Set descripcionProyecto
     *
     * @param string $descripcionProyecto
     *
     * @return TblProyectos
     */
    public function setDescripcionProyecto($descripcionProyecto)
    {
        $this->descripcionProyecto = $descripcionProyecto;

        return $this;
    }

    /**
     * Get descripcionProyecto
     *
     * @return string
     */
    public function getDescripcionProyecto()
    {
        return $this->descripcionProyecto;
    }

    /**
     * Set objetivosProyecto
     *
     * @param string $objetivosProyecto
     *
     * @return TblProyectos
     */
    public function setObjetivosProyecto($objetivosProyecto)
    {
        $this->objetivosProyecto = $objetivosProyecto;

        return $this;
    }

    /**
     * Get objetivosProyecto
     *
     * @return string
     */
    public function getObjetivosProyecto()
    {
        return $this->objetivosProyecto;
    }

    /**
     * Set resultadosProyecto
     *
     * @param string $resultadosProyecto
     *
     * @return TblProyectos
     */
    public function setResultadosProyecto($resultadosProyecto)
    {
        $this->resultadosProyecto = $resultadosProyecto;

        return $this;
    }

    /**
     * Get resultadosProyecto
     *
     * @return string
     */
    public function getResultadosProyecto()
    {
        return $this->resultadosProyecto;
    }

    /**
     * Set resultadosEsperados
     *
     * @param string $resultadosEsperados
     *
     * @return TblProyectos
     */
    public function setResultadosEsperados($resultadosEsperados)
    {
        $this->resultadosEsperados = $resultadosEsperados;

        return $this;
    }

    /**
     * Get resultadosEsperados
     *
     * @return string
     */
    public function getResultadosEsperados()
    {
        return $this->resultadosEsperados;
    }

    /**
     * Set antecedentesProyecto
     *
     * @param string $antecedentesProyecto
     *
     * @return TblProyectos
     */
    public function setAntecedentesProyecto($antecedentesProyecto)
    {
        $this->antecedentesProyecto = $antecedentesProyecto;

        return $this;
    }

    /**
     * Get antecedentesProyecto
     *
     * @return string
     */
    public function getAntecedentesProyecto()
    {
        return $this->antecedentesProyecto;
    }

    /**
     * Set estadoProyecto
     *
     * @param string $estadoProyecto
     *
     * @return TblProyectos
     */
    public function setEstadoProyecto($estadoProyecto)
    {
        $this->estadoProyecto = $estadoProyecto;

        return $this;
    }

    /**
     * Get estadoProyecto
     *
     * @return string
     */
    public function getEstadoProyecto()
    {
        return $this->estadoProyecto;
    }

    /**
     * Set estadoInformacion
     *
     * @param string $estadoInformacion
     *
     * @return TblProyectos
     */
    public function setEstadoInformacion($estadoInformacion)
    {
        $this->estadoInformacion = $estadoInformacion;

        return $this;
    }

    /**
     * Get estadoInformacion
     *
     * @return string
     */
    public function getEstadoInformacion()
    {
        return $this->estadoInformacion;
    }

    /**
     * Set codigoSefin
     *
     * @param string $codigoSefin
     *
     * @return TblProyectos
     */
    public function setCodigoSefin($codigoSefin)
    {
        $this->codigoSefin = $codigoSefin;

        return $this;
    }

    /**
     * Get codigoSefin
     *
     * @return string
     */
    public function getCodigoSefin()
    {
        return $this->codigoSefin;
    }

    /**
     * Set idEstado
     *
     * @param \BackendBundle\Entity\TblCategorias $idEstado
     *
     * @return TblProyectos
     */
    public function setIdEstado(\BackendBundle\Entity\TblCategorias $idEstado = null)
    {
        $this->idEstado = $idEstado;

        return $this;
    }

    /**
     * Get idEstado
     *
     * @return \BackendBundle\Entity\TblCategorias
     */
    public function getIdEstado()
    {
        return $this->idEstado;
    }
}

