<?php

namespace Webjump\Pet\Controller\Adminhtml\Pet;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\View\Result\PageFactory;

class Create extends Action
{

    const WEBJUM_PET_CREATE=  'Webjump_Pet::Pet_save';

    /**
     * @var PageFactory
     */
    private PageFactory $pageFactory;

    /**
     * Init construct
     *
     * @param Context $context
     * @param PageFactory $pageFactory
     */
    public function __construct(
        Context $context,
        PageFactory $pageFactory,
    )
    {
        parent::__construct($context);
        $this->pageFactory = $pageFactory;
    }

    /**
     * Render page to create new register of pet
     */
    public function execute()
    {
        $resultPage = $this->pageFactory->create();
        $resultPage->getConfig()->getTitle()->prepend(__("Create a pet kind"));
        return $resultPage;
    }

    /**
     * Check authorization acl edit
     *
     * @return bool
     */
    protected function _isAllowed(): bool
    {
        return $this->_authorization->isAllowed(static::WEBJUM_PET_CREATE);
    }
}
