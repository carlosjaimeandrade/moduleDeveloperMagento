<?php

namespace Webjump\PetExt\Plugin\Customer\Model\ResourceModel;

use Magento\Customer\Api\Data\CustomerSearchResultsInterface;
use Magento\Customer\Model\CustomerSearchResults;
use Magento\Customer\Model\ResourceModel\CustomerRepository;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Webjump\PetExt\Api\Data\PetExtInterface;
use Webjump\PetExt\Model\Repository\PetExtRepository;
use Magento\Customer\Api\Data\CustomerInterface;

class CustomerRepositoryPlugin
{

    private PetExtRepository $petExtRepository;
    private CustomerSearchResultsInterface $customerSearchResultsInterface;

    /**
     * @param PetExtRepository $petExtRepository
     * @param CustomerSearchResultsInterface $customerSearchResultsInterface
     */
    public function __construct(
        PetExtRepository $petExtRepository,
        CustomerSearchResultsInterface $customerSearchResultsInterface,
    ) {
        $this->petExtRepository = $petExtRepository;
        $this->customerSearchResultsInterface = $customerSearchResultsInterface;
    }

    /**
     * @throws NoSuchEntityException
     */
    public function afterGetById(CustomerRepository $subject, CustomerInterface $customer): CustomerInterface
    {
        $ourCustomData = $this->petExtRepository->getById($customer->getId());

        $extensionAttributes = $customer->getExtensionAttributes();
        /** get current extension attributes from entity **/

        $extensionAttributes->setPetExt($ourCustomData);
        $customer->setExtensionAttributes($extensionAttributes);

        return $customer;
    }

    /**
     * @throws CouldNotSaveException
     */
    public function afterSave
    (
        CustomerRepository $subject,
        CustomerInterface $result,
        CustomerInterface $entity
    ): CustomerInterface
    {
        $extensionAttributes = $entity->getExtensionAttributes(); /** get original extension attributes from entity **/
        $ourCustomData = $extensionAttributes->getPetExt();
        $this->petExtRepository->save($ourCustomData);

        $resultAttributes = $result->getExtensionAttributes(); /** get extension attributes as they exist after save **/
        $resultAttributes->setPetExt($ourCustomData); /** update the extension attributes with correct data **/
        $result->setExtensionAttributes($resultAttributes);

        return $result;
    }

    /**
     * @param CustomerRepository $subject
     * @param CustomerSearchResultsInterface $searchResults
     * @return CustomerSearchResultsInterface
     * @throws NoSuchEntityException
     */
    public function afterGetList(
        CustomerRepository $subject,
        CustomerSearchResultsInterface $searchResults
    ) : CustomerSearchResultsInterface {
        $products = [];
        foreach ($searchResults->getItems() as $entity) {
            $ourCustomData = $this->petExtRepository->getById($entity->getId());

            $extensionAttributes = $entity->getExtensionAttributes();
            $extensionAttributes->setPetExt($ourCustomData);
            $entity->setExtensionAttributes($extensionAttributes);

            $products[] = $entity;
        }
        $searchResults->setItems($products);
        return $searchResults;
    }

}
