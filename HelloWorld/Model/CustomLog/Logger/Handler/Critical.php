<?php

namespace Webjump\HelloWorld\Model\CustomLog\Logger\Handler;

use Monolog\Logger;

class Critical extends \Magento\Framework\Logger\Handler\Base
{
    /**
     * @var string
     */
    protected $loggerType = Logger::CRITICAL;

    /**
     * File name
     * @var string
     */
    protected $fileName = '/var/log/custom-critical.log';
}
