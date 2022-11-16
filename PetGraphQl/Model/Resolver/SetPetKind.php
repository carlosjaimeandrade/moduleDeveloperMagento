<?php

namespace Webjump\PetGraphQl\Model\Resolver;

use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Query\Resolver\ContextInterface;
use Magento\Framework\GraphQl\Query\Resolver\Value;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use Webjump\Pet\Api\Data\PetInterface;
use Webjump\Pet\Api\PetRepositoryInterface;
use Webjump\Pet\Api\Data\PetInterfaceFactory;

class SetPetKind implements ResolverInterface
{

    private PetRepositoryInterface $petRepository;
    private PetInterfaceFactory $pet;

    /**
     * @param PetRepositoryInterface $petRepositoryInterface
     * @param PetInterfaceFactory $pet
     */
    public function __construct(
        PetRepositoryInterface $petRepositoryInterface,
        PetInterfaceFactory $pet,

    ) {
        $this->petRepository = $petRepositoryInterface;
        $this->pet = $pet;
    }

    /**
     * Resolver save pet kind
     *
     * @param Field $field
     * @param $context
     * @param ResolveInfo $info
     * @param array|null $value
     * @param array|null $args
     * @return bool
     * @throws CouldNotSaveException
     */
    public function resolve(
        Field       $field,
                    $context,
        ResolveInfo $info,
        array       $value = null,
        array       $args = null
    ): bool
    {
        $name = $args['name'];
        $description = $args['description'];

        $pet = $this->pet->create();
        if (isset($args['id'])){
            $pet->setEntityId($args['id']);
        }
        $pet->setName($name);
        $pet->setDescription($description);

        try {
            $this->petRepository->save($pet);
            return true;
        } catch (\Exception $exception) {
            return false;
        }
    }
}
