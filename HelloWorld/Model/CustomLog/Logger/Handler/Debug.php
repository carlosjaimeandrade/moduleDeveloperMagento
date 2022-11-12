<?php

namespace Webjump\HelloWorld\Model\CustomLog\Logger\Handler;

use Monolog\Logger;

class Debug extends \Magento\Framework\Logger\Handler\Base
{
    /**
     * @var string
     */
    protected $loggerType = Logger::DEBUG;

    /**
     * File name
     * @var string
     */
    protected $fileName = '/var/log/custom-debug.log';
}
