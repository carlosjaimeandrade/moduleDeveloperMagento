<?php

namespace Webjump\PetExt\Plugin\Customer\Controller\Adminhtml\Index;

use Magento\Customer\Controller\Adminhtml\Index\Save;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\Result\RedirectFactory;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Webjump\PetExt\Model\PetExt;
use Webjump\PetExt\Model\Repository\PetExtRepository;
use Webjump\PetExt\Model\ResourceModel\Collection\Collection;
use Magento\Customer\Model\ResourceModel\Customer\Collection as CollectionCustomer;

class SaveTest
{
    private PetExt $petExt;
    private PetExtRepository $petExtRepository;
    private Collection $collection;
    private RedirectFactory $redirectFactory;
    private Context $context;
    private CollectionCustomer $collectionCustomer;

    public function __construct(
        PetExt $petExt,
        PetExtRepository $petExtRepository,
        RedirectFactory $redirectFactory,
        Collection $collection,
        Context $context,
        CollectionCustomer $collectionCustomer
    ) {
        $this->petExt = $petExt;
        $this->petExtRepository = $petExtRepository;
        $this->redirectFactory = $redirectFactory;
        $this->collection = $collection;
        $this->context = $context;
        $this->collectionCustomer = $collectionCustomer;
    }

    /**
     * @throws CouldNotSaveException
     * @throws NoSuchEntityException
     */
    public function afterExecute(Save $subject, $result)
    {
        $request = $subject->getRequest()->getPostValue();


        $petKind = $request['customer']['pet_kind_select'];

        if (isset($request['customer']['entity_id'])) {
            $entityId = $request['customer']['entity_id'];
            $userPetKind = $this->collection->addFieldToFilter('entity_id_customer', $entityId)->getFirstItem();
            if($userPetKind->getEntityId()){
                $this->petExt->setEntityId((int)$userPetKind->getEntityId());
            }
            $this->petExt->setEntityIdCustomer($entityId);
            $this->petExt->setEntityIdPet($petKind);
            $this->petExtRepository->save($this->petExt);
            return $result;
        }

        $newUser = $this->collectionCustomer->getLastItem();

        $this->petExt->setEntityIdCustomer($newUser['entity_id']);
        $this->petExt->setEntityIdPet($petKind);
        $this->petExtRepository->save($this->petExt);
        return $result;
    }
}
