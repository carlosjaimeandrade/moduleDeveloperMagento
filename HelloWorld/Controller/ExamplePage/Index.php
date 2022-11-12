<?php

namespace Webjump\HelloWorld\Controller\ExamplePage;

use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Webjump\HelloWorld\Setup\Patch\Data\CreateValuePetTable;

class Index extends \Magento\Framework\App\Action\Action
{

    /**
     * @var PageFactory
     */
    private $pageFactory;

    /**
     * @param Context $context
     * @param PageFactory $pageFactory
     */
    public function __construct(Context $context, PageFactory $pageFactory)
    {
        parent::__construct($context);
        $this->pageFactory = $pageFactory;
    }

    public function execute()
    {

        return  $this->pageFactory->create()->addHandle('helloworld_examplepage_index');
    }
}
