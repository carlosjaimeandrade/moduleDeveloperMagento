<?php

namespace Webjump\HelloWorld\Api\Data;

interface HelloWorldInterface
{
    const TABLE = 'pet_table';
    const ENTITY_ID = 'entity_id';
    const PET_NAME = 'pet_name';
    const PET_OWNER = 'pet_owner';
    const OWNER_TELEPHONE = 'owner_telephone';
    const OWNER_ID = 'owner_id';

    /**
     * @return string
     */
    public function getPetName();

    /**
     * @param $petName
     * @return mixed
     */
    public function setPetName($petName);

    /**
     * @return mixed
     */
    public function getPetOwner();

    /**
     * @param $petOwner
     * @return mixed
     */
    public function setPetOwner($petOwner);

    /**
     * @return mixed
     */
    public function getOwnerTelephone();

    /**
     * @param $ownerTelephone
     * @return mixed
     */
    public function setOwnerTelephone($ownerTelephone);

    /**
     * @return mixed
     */
    public function getOwnerId();

    /**
     * @param $ownerId
     * @return mixed
     */
    public function setOwnerId($ownerId);
}
