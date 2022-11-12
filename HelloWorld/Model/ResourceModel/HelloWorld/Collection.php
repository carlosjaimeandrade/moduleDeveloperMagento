<?php

namespace Webjump\HelloWorld\Model\ResourceModel\HelloWorld;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Webjump\HelloWorld\Api\Data\HelloWorldInterface;
use Webjump\HelloWorld\Model\ResourceModel\HelloWorld;

class Collection extends AbstractCollection
{
    /**
     * @var string
     */
    protected $_eventPrefix = 'pet_table';

    /**
     * Initialize collection model.
     */
    protected function _construct()
    {
        $this->_init(HelloWorldInterface::class, HelloWorld::class);
    }
}
