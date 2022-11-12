<?php

namespace Webjump\PetExt\Model\ResourceModel\Collection;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Webjump\PetExt\Model\PetExt;
use Webjump\PetExt\Model\ResourceModel\PetExtResource;

class Collection extends AbstractCollection
{
    /**
     * Init construct
     *
     * @return void
     */
    protected function _construct(): void
    {
        $this->_init(PetExt::class, PetExtResource::class);
    }
}
