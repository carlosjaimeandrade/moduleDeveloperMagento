<?php

namespace Webjump\HelloWorld\Controller\ExampleForward;

use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\Result\ForwardFactory;

class Index extends \Magento\Framework\App\Action\Action
{
    private $forwardFactory;

    /**
     * @param Context $context
     * @param ForwardFactory $forwardFactory
     */
    public function __construct(Context $context, ForwardFactory $forwardFactory)
    {
        parent::__construct($context);
        $this->forwardFactory = $forwardFactory;
    }

    public function execute()
    {
        $forwardFactory = $this->forwardFactory->create();
        return $forwardFactory->setModule('helloworld')
            ->setController('exampleforward')
            ->forward('test');
    }
}
