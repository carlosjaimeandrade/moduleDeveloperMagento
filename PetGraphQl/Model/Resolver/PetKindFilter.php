<?php

namespace Webjump\PetGraphQl\Model\Resolver;

use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Query\Resolver\ContextInterface;
use Magento\Framework\GraphQl\Query\Resolver\Value;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use Webjump\Pet\Model\Repository\PetRepository;
use Webjump\Pet\Model\ResourceModel\Collection\CollectionFactory;

class PetKindFilter implements ResolverInterface
{

    private CollectionFactory $collectionFactory;

    /**
     * @param PetRepository $petRepository
     * @param CollectionFactory $collectionFactory
     */
    public function __construct(
        PetRepository $petRepository,
        CollectionFactory $collectionFactory
    ) {
        $this->collectionFactory = $collectionFactory;
    }

    public function resolve(Field $field, $context, ResolveInfo $info, array $value = null, array $args = null): array
    {
        $id = $args['id'];
        $collection = $this->collectionFactory->create();
        $pet = $collection->addFieldToFilter('entity_id', $id)->getFirstItem();

        return [
            'entity_id'=> $pet->getEntityId(),
            'name' => $pet->getName(),
            'description' => $pet->getDescription(),
            'created_at' => $pet->getCreatedAt()
        ];
    }
}
