<?php

namespace Webjump\PetExt\Model\Repository;

use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Webjump\PetExt\Api\Data\PetExtInterface;
use Webjump\PetExt\Api\Data\PetExtSearchResultInterface;
use Webjump\PetExt\Api\PetExtRepositoryInterface;
use Webjump\PetExt\Model\ResourceModel\PetExtResource;
use Webjump\PetExt\Model\PetExtFactory;
use Webjump\PetExt\Model\ResourceModel\Collection\Collection;
use Webjump\PetExt\Model\ResourceModel\Collection\CollectionFactory;
use Webjump\PetExt\Api\Data\PetExtSearchResultInterfaceFactory;

class PetExtRepository implements PetExtRepositoryInterface
{

    private PetExtResource $petExtResource;
    private PetExtFactory $petExtFactory;
    private CollectionFactory $collectionFactory;
    private CollectionProcessorInterface $collectionProcessor;
    private PetExtSearchResultInterfaceFactory $petExtSearchResultInterfaceFactory;

    public function __construct(
        PetExtResource $petExtResource,
        PetExtFactory $petExtFactory,
        CollectionFactory $collectionFactory,
        CollectionProcessorInterface $collectionProcessor,
        PetExtSearchResultInterfaceFactory $petExtSearchResultInterfaceFactory
    )
    {
        $this->petExtResource = $petExtResource;
        $this->petExtFactory = $petExtFactory;
        $this->collectionFactory = $collectionFactory;
        $this->collectionProcessor = $collectionProcessor;
        $this->petExtSearchResultInterfaceFactory = $petExtSearchResultInterfaceFactory;
    }

    /**
     * Save values in pet table
     *
     * @param PetExtInterface $petExt
     * @return PetExtInterface
     * @throws CouldNotSaveException
     */
    public function save(PetExtInterface $petExt): PetExtInterface
    {
        try {
            $this->petExtResource->save($petExt);
            return $petExt;
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(
                __(
                    'Could not save the order status state: %1',
                    $exception->getMessage()
                )
            );
        }
    }

    /**
     * Get first item with params id customer
     *
     * @param int $id
     * @return PetExtInterface
     * @throws NoSuchEntityException
     */
    public function getById(int $id): PetExtInterface
    {
        /** @var PetExtInterface $petExt */
        $petExt = $this->petExtFactory->create();
        $this->petExtResource->load($petExt, $id, PetExtInterface::ENTITY_ID_CUSTOMER);

        if (!$petExt->getEntityId()) {
            throw new NoSuchEntityException(
                __(
                    'Pet Kind with id "%1" does not exist.',
                    $id
                )
            );
        }
        return $petExt;
    }

    /**
     * Get data list of table
     *
     * @param SearchCriteriaInterface $searchCriteria
     * @return PetExtSearchResultInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria): PetExtSearchResultInterface
    {
        /** @var Collection $collection */
        $collection = $this->collectionFactory->create();

        $this->collectionProcessor->process($searchCriteria, $collection);
        /** @var PetExtSearchResultInterface $searchResults */
        $searchResults = $this->petExtSearchResultInterfaceFactory->create();
        $searchResults->setItems($collection->getItems());
        $searchResults->setTotalCount($collection->getSize());
        $searchResults->setSearchCriteria($searchCriteria);

        return $searchResults;
    }

    /**
     * Delete one item of table, with base in param
     *
     * @param PetExtInterface $petExt
     * @return bool
     * @throws CouldNotDeleteException
     */
    public function delete(PetExtInterface $petExt): bool
    {
        try {
            $this->petExtResource->delete($petExt);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(
                __(
                    'Could not delete order status state: %1',
                    $exception->getMessage()
                ),
                $exception
            );
        }
        return true;
    }
}
