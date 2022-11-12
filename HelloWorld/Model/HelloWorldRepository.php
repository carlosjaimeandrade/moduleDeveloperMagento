<?php

namespace Webjump\HelloWorld\Model;

use Exception;
use Magento\Framework\Api\SearchCriteriaInterface;
use Webjump\HelloWorld\Api\Data\HelloWorldInterface;
use Webjump\HelloWorld\Api\Data\HelloWorldInterfaceFactory;
use Webjump\HelloWorld\Api\HelloWorldRepositoryInterface;
use Webjump\HelloWorld\Model\ResourceModel\HelloWorld as HelloWorldResource;
use Webjump\HelloWorld\Model\ResourceModel\HelloWorld\CollectionFactory;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;

class HelloWorldRepository implements HelloWorldRepositoryInterface
{

    private HelloWorldResource $resource;
    private HelloWorldInterfaceFactory $helloWorld;
    private CollectionFactory $collection;
    private CollectionProcessorInterface $collectionProcessor;
    /**
     * @param HelloWorldResource $resource
     * @param HelloWorldInterfaceFactory $helloWorld
     * @param CollectionFactory $collection
     * @param CollectionProcessorInterface $collectionProcessor
     */
    public function __construct(
        HelloWorldResource $resource,
        HelloWorldInterfaceFactory $helloWorld,
        CollectionFactory $collection,
        CollectionProcessorInterface $collectionProcessor,
    ) {
        $this->resource = $resource;
        $this->helloWorld = $helloWorld;
        $this->collection = $collection;
        $this->collectionProcessor = $collectionProcessor;
    }

    /**
     * @param HelloWorldInterface $petTable
     * @return bool
     * @throws \Magento\Framework\Exception\CouldNotSaveException
     */
    public function save(HelloWorldInterface $petTable): bool
    {
        try {
            $this->resource->save($petTable);
        } catch (Exception $exception) {
            throw new \Magento\Framework\Exception\CouldNotSaveException(__('Could not save'));
        }

        return true;
    }

    /**
     * @param int $id
     * @return HelloWorldInterface
     * @throws \Magento\Framework\Exception\CouldNotSaveException
     */
    public function getById(int $id): HelloWorldInterface
    {
        $helloWorld = $this->helloWorld->create();

        $this->resource->load($helloWorld, $id);

        if (!$helloWorld->getEntityId()) {
            throw new \Magento\Framework\Exception\CouldNotSaveException(__('not found record'));
        }

        return $helloWorld;
    }

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @return mixed
     */
    public function getList(SearchCriteriaInterface $searchCriteria)
    {
        $collection = $this->collection->create();

        $this->collectionProcessor->process($searchCriteria, $collection);

        $searchResult = $this->searchResultsFactory->create();
        $searchResult->setItems($collection->getItems());
        $searchResult->setTotalCount($collection->getSize());
        $searchResult->setSearchCriteria($searchCriteria);

        return $searchResult;
    }

    /**
     * @param HelloWorldInterface $petTable
     * @return bool
     * @throws \Magento\Framework\Exception\CouldNotSaveExceptions
     */
    public function delete(HelloWorldInterface $petTable): bool
    {
        try {
            $this->resource->delete($petTable);
        } catch (Exception $exception) {
            throw new \Magento\Framework\Exception\CouldNotSaveException(__('Could not delete the pet'));
        }

        return true;
    }
}
