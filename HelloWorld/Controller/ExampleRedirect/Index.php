<?php

namespace Webjump\HelloWorld\Controller\ExampleRedirect;

use Magento\Framework\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\Result\Redirect;
use Magento\Framework\Controller\Result\RedirectFactory;

class Index extends \Magento\Framework\App\Action\Action
{
    /**
     * @var RedirectFactory
     */
    private $redirectFactory;

    /**
     * @param Context $context
     * @param RedirectFactory $redirectFactory
     */
    public function __construct(Context $context, RedirectFactory $redirectFactory)
    {
        parent::__construct($context);
        $this->redirectFactory = $redirectFactory;
    }

    /**
     * @return ResponseInterface|Redirect|\Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $result = $this->redirectFactory->create();
        return $result->setPath('/');
    }
}
