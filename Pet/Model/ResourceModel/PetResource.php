<?php

namespace Webjump\Pet\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class PetResource extends AbstractDb
{

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
