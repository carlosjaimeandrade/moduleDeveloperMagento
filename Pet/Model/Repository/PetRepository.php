<?php

namespace Webjump\Pet\Model\Repository;

use Magento\Framework\Api\SearchCriteriaInterface;
use Webjump\Pet\Api\Data\PetInterface;
use Webjump\Pet\Api\PetRepositoryInterface;
use Webjump\Pet\Model\ResourceModel\PetResource;
use Magento\Framework\Exception\CouldNotSaveException;
use Webjump\Pet\Model\PetFactory;
use Magento\Framework\Exception\NoSuchEntityException;
use Webjump\Pet\Model\ResourceModel\Collection\Collection;
use Webjump\Pet\Model\ResourceModel\Collection\CollectionFactory;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Webjump\Pet\Api\Data\PetSearchResultInterfaceFactory;
use Webjump\Pet\Api\Data\PetSearchResultInterface;
use Magento\Framework\Exception\CouldNotDeleteException;

class PetRepository implements PetRepositoryInterface
{

    private PetResource $petResource;
    private PetFactory $petFactory;
    private CollectionFactory $collectionFactory;
    private CollectionProcessorInterface $collectionProcessor;
    private PetSearchResultInterfaceFactory $petSearchResultFactory;

    public function __construct(
        PetResource $petResource,
        PetFactory $petFactory,
        CollectionFactory $collectionFactory,
        CollectionProcessorInterface $collectionProcessor,
        PetSearchResultInterfaceFactory $petSearchResultFactory
    )
    {
        $this->petResource = $petResource;
        $this->petFactory = $petFactory;
        $this->collectionFactory = $collectionFactory;
        $this->collectionProcessor = $collectionProcessor;
        $this->petSearchResultFactory = $petSearchResultFactory;
    }

    /**
     * Save values in pet table
     *
     * @param PetInterface $pet
     * @return PetInterface
     * @throws CouldNotSaveException
     */
    public function save(PetInterface $pet): PetInterface
    {
        try {
            $this->petResource->save($pet);
            return $pet;
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
     * Get first item with params id
     *
     * @param int $id
     * @return PetInterface
     * @throws NoSuchEntityException
     */
    public function getById(int $id): PetInterface
    {
        /** @var PetInterface $pet */
        $pet = $this->petFactory->create();
        $this->petResource->load($pet, $id);
        if (!$pet->getEntityId()) {
            throw new NoSuchEntityException(
                __(
                    'Product Pdf with id "%1" does not exist.',
                    $pet
                )
            );
        }
        return $pet;
    }

    /**
     * Get data list of table
     *
     * @param SearchCriteriaInterface $searchCriteria
     * @return PetSearchResultInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria): PetSearchResultInterface
    {
        /** @var Collection $collection */
        $collection = $this->collectionFactory->create();
        var_dump($collection);
        $this->collectionProcessor->process($searchCriteria, $collection);
        /** @var PetSearchResultInterface $searchResults */
        $searchResults = $this->petSearchResultFactory->create();
        $searchResults->setItems($collection->getItems());
        $searchResults->setTotalCount($collection->getSize());
        $searchResults->setSearchCriteria($searchCriteria);

        return $searchResults;
    }

    /**
     * Delete one item of table, with base in param
     *
     * @param PetInterface $pet
     * @return bool
     * @throws CouldNotDeleteException
     */
    public function delete(PetInterface $pet): bool
    {
        try {
            $this->petResource->delete($pet);
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
