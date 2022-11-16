<?php

namespace Webjump\Pet\Model\Pet;

use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Ui\DataProvider\AbstractDataProvider;
use Webjump\Pet\Model\ResourceModel\Collection\Collection;
use Webjump\Pet\Model\ResourceModel\Collection\CollectionFactory;

class DataProvider extends AbstractDataProvider
{
    /**
     * @var array
     */
    protected $loadedData;

    /**
     * @var DataPersistorInterface
     */
    protected $dataPersistor;

    /**
     * @var Collection
     */
    protected $collection;

    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $collectionFactory,
        DataPersistorInterface $dataPersistor,
        array $meta = [],
        array $data = []
    ) {
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
        $this->collection = $collectionFactory;
        $this->dataPersistor = $dataPersistor;
    }

    /**
     * Get data
     *
     * @return array|null
     */
    public function getData(): ?array
    {

        $collection = $this->collection->create();
        $items = $collection->getItems();

        foreach ($items as $model) {
            $this->loadedData[$model->getId()] = $model->getData();
        }

        return $this->loadedData;
    }
}
