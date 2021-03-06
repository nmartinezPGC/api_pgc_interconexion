<?php

namespace BackendBundle\Entity;

/**
 * TblSectores
 */
class TblSectores
{
    /**
     * @var integer
     */
    private $idSector;

    /**
     * @var string
     */
    private $sectorName;

    /**
     * @var string
     */
    private $sectorCodeOfficial;

    /**
     * @var string
     */
    private $description;

    /**
     * @var \BackendBundle\Entity\TblSectores
     */
    private $parentSector;

    /**
     * @var \BackendBundle\Entity\TblSectoresSchema
     */
    private $sectorSchema;


    /**
     * Get idSector
     *
     * @return integer
     */
    public function getIdSector()
    {
        return $this->idSector;
    }

    /**
     * Set sectorName
     *
     * @param string $sectorName
     *
     * @return TblSectores
     */
    public function setSectorName($sectorName)
    {
        $this->sectorName = $sectorName;

        return $this;
    }

    /**
     * Get sectorName
     *
     * @return string
     */
    public function getSectorName()
    {
        return $this->sectorName;
    }

    /**
     * Set sectorCodeOfficial
     *
     * @param string $sectorCodeOfficial
     *
     * @return TblSectores
     */
    public function setSectorCodeOfficial($sectorCodeOfficial)
    {
        $this->sectorCodeOfficial = $sectorCodeOfficial;

        return $this;
    }

    /**
     * Get sectorCodeOfficial
     *
     * @return string
     */
    public function getSectorCodeOfficial()
    {
        return $this->sectorCodeOfficial;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return TblSectores
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
     * Set parentSector
     *
     * @param \BackendBundle\Entity\TblSectores $parentSector
     *
     * @return TblSectores
     */
    public function setParentSector(\BackendBundle\Entity\TblSectores $parentSector = null)
    {
        $this->parentSector = $parentSector;

        return $this;
    }

    /**
     * Get parentSector
     *
     * @return \BackendBundle\Entity\TblSectores
     */
    public function getParentSector()
    {
        return $this->parentSector;
    }

    /**
     * Set sectorSchema
     *
     * @param \BackendBundle\Entity\TblSectoresSchema $sectorSchema
     *
     * @return TblSectores
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
