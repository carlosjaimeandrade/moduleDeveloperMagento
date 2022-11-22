<?php

namespace Webjump\Pet\Controller\Adminhtml\Pet;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\View\Result\PageFactory;
use Magento\Customer\Model\ResourceModel\CustomerRepository;

class Index extends Action
{
    private PageFactory $pageFactory;
    private CustomerRepository $customerRepository;

    /**
     * Init construct
     *
     * @param Context $context
     * @param PageFactory $pageFactory
     * @param CustomerRepository $customerRepository
     */
    public function __construct(
        Context $context,
        PageFactory $pageFactory,
        CustomerRepository $customerRepository
    )
    {
        parent::__construct($context);
        $this->pageFactory = $pageFactory;
        $this->customerRepository = $customerRepository;
    }

    /**
     * Render page of pet listing
     *
     * @return ResultInterface
     */
    public function execute(): ResultInterface
    {
        $test = $this->customerRepository->getById(2)->getExtensionAttributes()->getPetExt()->getEntityIdPet();
        var_dump($test);
        exit();
        $resultPage = $this->pageFactory->create();
        $resultPage->getConfig()->getTitle()->prepend(__("list of pet kind"));
        return $resultPage;
    }
}
