<?php

namespace Webjump\Pet\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class PetResource extends AbstractDb
{

    const ENTITY_ID = 'entity_id';
    const TABLE_NAME = 'pet';

    /**
     * Init construct
     *
     * @return void
     */
    protected function _construct(): void
    {
        $this->_init('pet', 'entity_id');
    }
}
