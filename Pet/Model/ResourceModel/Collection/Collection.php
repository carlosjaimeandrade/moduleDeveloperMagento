<?php

namespace Webjump\Pet\Model\ResourceModel\Collection;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Webjump\Pet\Model\Pet;
use Webjump\Pet\Model\ResourceModel\PetResource;

class Collection extends AbstractCollection
{
    /**
     * Init construct
     *
     * @return void
     */
    protected function _construct(): void
    {
        $this->_init(Pet::class, PetResource::class);
    }
}
