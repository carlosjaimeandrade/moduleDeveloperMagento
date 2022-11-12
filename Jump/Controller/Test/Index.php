<?php

namespace Webjump\Jump\Controller\Test;

use Magento\Framework\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\Result\Json;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Framework\Controller\ResultInterface;
use Webjump\Jump\Api\HelloInterface;

class Index extends \Magento\Framework\App\Action\Action
{
    /**
     * @var HelloInterface
     */
    private $hello;
    private JsonFactory $jsonFactory;

    /**
     * @param Context $context
     * @param HelloInterface $hello
     * @param JsonFactory $jsonFactory
     */
    public function __construct(Context $context, HelloInterface $hello, jsonFactory $jsonFactory)
    {
        parent::__construct($context);
        $this->hello = $hello;
        $this->jsonFactory = $jsonFactory;
    }

    /**
     * @return ResponseInterface|Json|ResultInterface
     */
    public function execute()
    {
        return $this->jsonFactory->create()->setData([
            'message' => ['success webapi' => 'carlos']
        ]);
    }
}
