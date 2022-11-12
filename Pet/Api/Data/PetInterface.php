<?php

namespace Webjump\Pet\Api\Data;

use Webjump\Pet\Model\Pet;

interface PetInterface
{
    const TABLE = 'pet';
    const ENTITY_ID = 'entity_id';
    const NAME = 'name';
    const DESCRIPTION = 'description';
    const CREATED_AT = 'created_at';

    /**
     * Get Name
     *
     * @return string|null
     */
    public function getName(): ?string;

    /**
     * Set name
     *
     * @param string $name
     * @return Pet
     */
    public function setName(string $name): Pet;

    /**
     * Get description
     *
     * @return string|null
     */
    public function getDescription(): ?string;

    /**
     * Set description
     *
     * @param string $description
     * @return Pet
     */
    public function setDescription(string $description): Pet;
}
