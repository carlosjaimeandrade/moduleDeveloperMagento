<?php

namespace Webjump\Pet\Controller\Adminhtml\Pet;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\Controller\Result\RedirectFactory;
use Magento\Framework\Controller\Result\Redirect;
use Magento\Framework\Controller\ResultInterface;
use Webjump\Pet\Model\Repository\PetRepository;

class
Remove extends Action
{

    const WEBJUMP_PET_DELETE = 'Webjump_Pet::Pet_delete';

    private RequestInterface $request;
    private PetRepository $petRepository;
    private RedirectFactory $redirectFactory;

    /**
     * @param Context $context
     * @param RequestInterface $request
     * @param PetRepository $petRepository
     * @param RedirectFactory $redirectFactory
     */
    public function __construct(
        Context $context,
        RequestInterface $request,
        PetRepository $petRepository,
        RedirectFactory $redirectFactory
    )
    {
        parent::__construct($context);
        $this->request = $request;
        $this->petRepository = $petRepository;
        $this->redirectFactory = $redirectFactory;
    }


    /**
     *  Delete one value with base in id
     */
    public function execute()
    {

        $resultRedirect = $this->redirectFactory->create();

        $id = $this->request->getParam('petId');
        if ($id){
            try {
            $petModel = $this->petRepository->getById($id);
            $this->petRepository->delete($petModel);
            $this->messageManager->addSuccessMessage(__('You deleted the pet.'));

            return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage($e->getMessage());

                return $resultRedirect->setPath('*/*/');
            }
        }

        return $resultRedirect->setPath('*/*/');
    }

    /**
     * Check authorization acl
     *
     * @inheritDoc
     */
    protected function _isAllowed(): bool
    {
        return $this->_authorization->isAllowed(static::WEBJUMP_PET_DELETE);
    }
}
