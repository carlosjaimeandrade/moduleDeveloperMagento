<?php

namespace Webjump\PetGraphQl\Model\Resolver;

use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Query\Resolver\ContextInterface;
use Magento\Framework\GraphQl\Query\Resolver\Value;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use Webjump\Pet\Api\Data\PetInterfaceFactory;
use Webjump\Pet\Api\PetRepositoryInterface;

class DelPetKind implements ResolverInterface
{

    private PetRepositoryInterface $petRepository;
    private PetInterfaceFactory $pet;

    /**
     * @param PetRepositoryInterface $petRepositoryInterface
     */
    public function __construct(
        PetRepositoryInterface $petRepositoryInterface

    ) {
        $this->petRepository = $petRepositoryInterface;
    }

    public function resolve(Field $field, $context, ResolveInfo $info, array $value = null, array $args = null)
    {
        try {
            $petModel = $this->petRepository->getById($args['id']);
            $this->petRepository->delete($petModel);
            return true;
        } catch (\Exception $e) {
            return false;
        }

    }
}
