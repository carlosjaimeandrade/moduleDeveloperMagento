<?php

namespace Webjump\HelloWorld\Controller\ExampleJson;

use Magento\Framework\App\Action\Context;

use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\Result\Json;
use Magento\Framework\Controller\Result\jsonFactory;
use Magento\Framework\Controller\ResultInterface;

class Index extends \Magento\Framework\App\Action\Action
{

    /**
     * @var jsonFactory
     */
    private jsonFactory $jsonFactory;

    /**
     * @param Context $context
     * @param jsonFactory $jsonFactory
     */
    public function __construct(Context $context, jsonFactory $jsonFactory)
    {
        parent::__construct($context);
        $this->jsonFactory = $jsonFactory;
    }

    /**
     * @return ResponseInterface|Json|ResultInterface
     */
    public function execute(): Json|ResultInterface|ResponseInterface
    {
        return $this->jsonFactory->create()->setData([
            'name' => 'Carlos Jaime',
            'idade' => '27 anos'
        ]);
    }
}
