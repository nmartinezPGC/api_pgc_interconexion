<?php

namespace BackendBundle\Entity;

/**
 * TblSectoresClasificacion
 */
class TblSectoresClasificacion
{
    /**
     * @var integer
     */
    private $sectorClassId;

    /**
     * @var string
     */
    private $sectorClassName;

    /**
     * @var string
     */
    private $description;

    /**
     * @var \BackendBundle\Entity\TblSectoresSchema
     */
    private $sectorSchema;


    /**
     * Get sectorClassId
     *
     * @return integer
     */
    public function getSectorClassId()
    {
        return $this->sectorClassId;
    }

    /**
     * Set sectorClassName
     *
     * @param string $sectorClassName
     *
     * @return TblSectoresClasificacion
     */
    public function setSectorClassName($sectorClassName)
    {
        $this->sectorClassName = $sectorClassName;

        return $this;
    }

    /**
     * Get sectorClassName
     *
     * @return string
     */
    public function getSectorClassName()
    {
        return $this->sectorClassName;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return TblSectoresClasificacion
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set sectorSchema
     *
     * @param \BackendBundle\Entity\TblSectoresSchema $sectorSchema
     *
     * @return TblSectoresClasificacion
     */
    public function setSectorSchema(\BackendBundle\Entity\TblSectoresSchema $sectorSchema = null)
    {
        $this->sectorSchema = $sectorSchema;

        return $this;
    }

    /**
     * Get sectorSchema
     *
     * @return \BackendBundle\Entity\TblSectoresSchema
     */
    public function getSectorSchema()
    {
        return $this->sectorSchema;
    }
}

