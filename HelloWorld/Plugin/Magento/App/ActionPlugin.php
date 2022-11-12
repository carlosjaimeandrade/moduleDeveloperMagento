<?php

namespace Webjump\HelloWorld\Plugin\Magento\App;

use Magento\Framework\App\Action\Action;
use Psr\Log\LoggerInterface;
use Webjump\HelloWorld\Model\CustomLog\Logger\Logger;

class ActionPlugin
{

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @var Logger
     */
    private $loggerCustom;

    public function __construct(LoggerInterface $logger, Logger $loggerCustom)
    {
        $this->logger = $logger;
        $this->loggerCustom = $loggerCustom;
    }

    public function beforeDispatch(Action $subject, $request)
    {
        $this->logger->debug('Before Plugin Dispatch');
        $this->loggerCustom->debug('Before Plugin Dispatch');
    }

    public function afterDispatch(Action $subject, $result)
    {
        $this->logger->critical('After Plugin Dispatch');
        $this->loggerCustom->critical('After Plugin Dispatch');
        return $result;
    }

    public function aroundDispatch(Action $subject, callable $proceed, $request)
    {
        $this->logger->critical('--- Before around Plugin Dispatch');
        $returnValue = $proceed($request);
        $this->logger->critical("--- After around Plugin Dispatch");
        return  $returnValue;
    }

}
