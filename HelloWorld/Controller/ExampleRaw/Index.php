<?php

namespace Webjump\HelloWorld\Controller\ExampleRaw;

use Magento\Framework\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\Result\Raw;

class Index extends \Magento\Framework\App\Action\Action
{

    /**
     * @var Raw
     */
    private Raw $raw;

    /**
     * @param Context $context
     * @param Raw $raw
     */
    public function __construct(
        Context $context,
        Raw $raw,
    )
    {
        parent::__construct($context);
        $this->raw = $raw;
    }

    /**
     * @return ResponseInterface|Raw|\Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        return $this->raw->setContents('Executando o raw');
    }
}
