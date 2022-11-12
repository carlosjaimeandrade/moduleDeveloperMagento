<?php

namespace Webjump\PetExt\Api\Data;

interface PetExtInterface
{
    const TABLE = 'pet_ext';
    const ENTITY_ID_PET = 'entity_id_pet';
    const ENTITY_ID_CUSTOMER = 'entity_id_customer';

    /**
     * Get entity id customer
     *
     * @return int|null
     */
    public function getEntityIdCustomer(): ?int;

    /**
     * Set entity id customer
     *
     * @param int $entityIdCustomer
     * @return PetExtInterface
     */
    public function setEntityIdCustomer(int $entityIdCustomer): PetExtInterface;

    /**
     * Get entity entity id pet
     *
     * @return int|null
     */
    public function getEntityIdPet(): ?int;

    /**
     * Set entity entity id pet
     *
     * @param int $entityIdPet
     * @return PetExtInterface
     */
    public function setEntityIdPet(int $entityIdPet): PetExtInterface;
}
