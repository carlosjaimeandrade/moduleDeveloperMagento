<?php

namespace Webjump\HelloWorld\Model\ResourceModel;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use Webjump\HelloWorld\Api\Data\HelloWorldInterface;

class HelloWorld extends AbstractDb
{
    /**
     * @return void
     */
    protected function _construct(): void
    {
        $this->_init(HelloWorldInterface::TABLE, HelloWorldInterface::ENTITY_ID);
    }
}
