<?php

namespace BackendBundle\Entity;

/**
 * TblSectoresSchema
 */
class TblSectoresSchema
{
    /**
     * @var integer
     */
    private $sectorSchemaId;

    /**
     * @var string
     */
    private $sectorSchemaCode;

    /**
     * @var string
     */
    private $sectorSchemaName;


    /**
     * Get sectorSchemaId
     *
     * @return integer
     */
    public function getSectorSchemaId()
    {
        return $this->sectorSchemaId;
    }

    /**
     * Set sectorSchemaCode
     *
     * @param string $sectorSchemaCode
     *
     * @return TblSectoresSchema
     */
    public function setSectorSchemaCode($sectorSchemaCode)
    {
        $this->sectorSchemaCode = $sectorSchemaCode;

        return $this;
    }

    /**
     * Get sectorSchemaCode
     *
     * @return string
     */
    public function getSectorSchemaCode()
    {
        return $this->sectorSchemaCode;
    }

    /**
     * Set sectorSchemaName
     *
     * @param string $sectorSchemaName
     *
     * @return TblSectoresSchema
     */
    public function setSectorSchemaName($sectorSchemaName)
    {
        $this->sectorSchemaName = $sectorSchemaName;

        return $this;
    }

    /**
     * Get sectorSchemaName
     *
     * @return string
     */
    public function getSectorSchemaName()
    {
        return $this->sectorSchemaName;
    }
}
