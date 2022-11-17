<?php

namespace Webjump\Pet\Model\Source;

use Magento\Eav\Model\Entity\Attribute\Source\AbstractSource;
use Magento\Framework\Data\OptionSourceInterface;
use Webjump\Pet\Model\Repository\PetRepository;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Webjump\Pet\Model\ResourceModel\Collection\CollectionFactory;

class PetKind implements OptionSourceInterface
{

    private PetRepository $petRepository;
    private SearchCriteriaBuilder $searchCriteriaBuilder;
    private CollectionFactory $collectionFactory;

    /**
     * @param PetRepository $petRepository
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     * @param CollectionFactory $collectionFactory
     */
    public function __construct(
        PetRepository $petRepository,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        CollectionFactory $collectionFactory
    ) {
        $this->petRepository = $petRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->collectionFactory = $collectionFactory;
    }

    /**
     * Retrieve All options
     *
     * @return array
     */
    public function toOptionArray(): array
    {
        $collection = $this->collectionFactory->create();
        $pets = $collection->getItems();
        $petKind = [];
        foreach ($pets as $key => $pet){
            $petKind[] = ['label'=> $pet->getName(), 'value' => $pet->getEntityId()];
        }
        return $petKind;
    }
}
