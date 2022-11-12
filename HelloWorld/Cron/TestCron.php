<?php
namespace Webjump\HelloWorld\Cron;

use Psr\Log\LoggerInterface;

class TestCron
{
    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @param LoggerInterface $logger
     */
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function execute(): void
    {
        $this->logger->critical("A cron test foi executada ");
    }
}
