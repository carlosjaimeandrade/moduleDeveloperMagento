<?php

namespace Webjump\Pet\Model;

use Magento\Framework\Model\AbstractModel;
use Webjump\Pet\Api\Data\PetInterface;
use Webjump\Pet\Model\ResourceModel\PetResource;

class Pet extends AbstractModel implements PetInterface
{

    /**
     * Init construct
     *
     * @return void
     */
    protected function _construct(): void
    {
        $this->_init(PetResource::class);
    }

    /**
     * Get Name
     *
     * @return string|null
     */
    public function getName(): ?string
    {
        return (string)$this->getData(PetInterface::NAME);
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Pet
     */
    public function setName(string $name): Pet
    {
        return $this->setData(PetInterface::NAME, $name);
    }

    /**
     * Get description
     *
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return (string)$this->getData(PetInterface::DESCRIPTION);
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Pet
     */
    public function setDescription(string $description): Pet
    {
        return $this->setData(PetInterface::DESCRIPTION, $description);
    }
}
