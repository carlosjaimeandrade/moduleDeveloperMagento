<?php

namespace Webjump\PetExt\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class PetExtResource extends AbstractDb
{

    /**
     * Init construct
     *
     * @return void
     */
    protected function _construct(): void
    {
        $this->_init('pet_ext', 'entity_id');
    }
}
