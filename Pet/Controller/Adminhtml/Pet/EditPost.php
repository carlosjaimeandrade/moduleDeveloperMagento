<?php

namespace Webjump\Pet\Controller\Adminhtml\Pet;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\Result\RedirectFactory;
use Magento\Framework\Controller\ResultInterface;
use Webjump\Pet\Api\Data\PetInterfaceFactory;
use Webjump\Pet\Api\PetRepositoryInterface;

class EditPost extends Action
{
    const WEBJUM_PET_UPDATE =  'Webjump_Pet::Pet_update';

    private RequestInterface $request;
    private RedirectFactory $redirectFactory;
    private PetInterfaceFactory $pet;
    private PetRepositoryInterface $petRepositoryInterface;
    private PetRepositoryInterface $petRepository;

    /**
     * @param Context $context
     * @param RequestInterface $request
     * @param RedirectFactory $redirectFactory
     * @param PetInterfaceFactory $pet
     * @param PetRepositoryInterface $petRepositoryInterface
     */
    public function __construct(
        Context $context,
        RequestInterface $request,
        RedirectFactory $redirectFactory,
        PetInterfaceFactory $pet,
        PetRepositoryInterface $petRepositoryInterface
    )
    {
        parent::__construct($context);
        $this->request = $request;
        $this->redirectFactory = $redirectFactory;
        $this->pet = $pet;
        $this->petRepository = $petRepositoryInterface;
    }

    /**
     * Edit one pet with base in id
     *
     * @return ResultInterface
     */
    public function execute(): ResultInterface
    {
        $resultRedirect = $this->redirectFactory->create();
        $request = $this->getRequest();
        $id = $request->getParam('entity_id');
        $name = $request->getParam('name');
        $description = $request->getParam('description');

        try {
            $pet = $this->pet->create();
            $pet->setId($id);
            $pet->setName($name);
            $pet->setDescription($description);

            $this->petRepository->save($pet);

        } catch (\Exception $exception)
        {
            $this->messageManager->addErrorMessage(__('This id not exists.'));
            return $resultRedirect->setPath('*/*/index');
        }

        $this->messageManager->addSuccessMessage(__('Pet edit with success'));
        return $resultRedirect->setPath('*/*/');
    }

    /**
     * Check authorization acl edit
     *
     * @return bool
     */
    protected function _isAllowed(): bool
    {
        return $this->_authorization->isAllowed(static::WEBJUM_PET_UPDATE);
    }


}
