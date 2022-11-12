<?php

namespace Webjump\PetExt\Model;

use Magento\Framework\Model\AbstractModel;
use Webjump\PetExt\Api\Data\PetExtInterface;
use Webjump\PetExt\Model\ResourceModel\PetExtResource;

class PetExt extends AbstractModel implements PetExtInterface
{

    /**
     * Init construct
     *
     * @return void
     */
    protected function _construct(): void
    {
        $this->_init(PetExtResource::class);
    }

    /**
     * Get entity id customer
     *
     * @return int|null
     */
    public function getEntityIdCustomer(): ?int
    {
        return (string)$this->getData(PetExtInterface::ENTITY_ID_CUSTOMER);
    }

    /**
     * Set entity id customer
     *
     * @param int $entityIdCustomer
     * @return PetExtInterface
     */
    public function setEntityIdCustomer(int $entityIdCustomer): PetExtInterface
    {
        return $this->setData(PetExtInterface::ENTITY_ID_CUSTOMER, $entityIdCustomer);
    }

    /**
     * Get entity entity id pet
     *
     * @return int|null
     */
    public function getEntityIdPet(): ?int
    {
        return (string)$this->getData(PetExtInterface::ENTITY_ID_PET);
    }

    /**
     * Set entity entity id pet
     *
     * @param int $entityIdPet
     * @return PetExtInterface
     */
    public function setEntityIdPet(int $entityIdPet): PetExtInterface
    {
        return $this->setData(PetExtInterface::ENTITY_ID_PET, $entityIdPet);
    }
}
