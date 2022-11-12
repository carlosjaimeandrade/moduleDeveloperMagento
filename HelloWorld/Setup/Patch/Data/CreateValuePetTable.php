<?php

namespace Webjump\HelloWorld\Setup\Patch\Data;

use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Webjump\HelloWorld\Api\Data\HelloWorldInterfaceFactory;
use Webjump\HelloWorld\Api\HelloWorldRepositoryInterface;

class CreateValuePetTable implements DataPatchInterface
{
    private ModuleDataSetupInterface $moduleDataSetup;
    private HelloWorldInterfaceFactory $helloWorld;
    private HelloWorldRepositoryInterface $helloWorldRepository;

    public function __construct(
        ModuleDataSetupInterface   $moduleDataSetup,
        HelloWorldInterfaceFactory $helloWorld,
        HelloWorldRepositoryInterface $helloWorldRepository
    ) {
        $this->moduleDataSetup = $moduleDataSetup;
        $this->helloWorld = $helloWorld;
        $this->helloWorldRepository = $helloWorldRepository;
    }

    /**
     * @return array|string[]
     */
    public static function getDependencies(): array
    {
        return [];
    }

    /**
     * @return array|string[]
     */
    public function getAliases(): array
    {
        return [];
    }

    public function apply()
    {
        $this->moduleDataSetup->getConnection()->startSetup();

        foreach ($this->dataPet() as $pet) {
            $helloWorld = $this->helloWorld->create();
            $helloWorld->setPetName($pet['name']);
            $helloWorld->setPetOwner($pet['owner']);
            $helloWorld->setOwnerTelephone($pet['telephone']);
            $helloWorld->setOwnerId($pet['ownerId']);

            $this->helloWorldRepository->save($helloWorld);
        }

        $this->moduleDataSetup->getConnection()->endSetup();
    }

    public function dataPet(): array
    {
        return [
            'pet1' => [
                'name' => "name example 1",
                'owner' => "owner example 1",
                'telephone' => "11111232323",
                'ownerId' => 1,
            ],
            'pet2' => [
                'name' => "name example 2",
                'owner' => "owner example 2",
                'telephone' => "22223232323",
                'ownerId' => 1,
            ],
            'pet3' => [
                'name' => "name example 3",
                'owner' => "owner example 3",
                'telephone' => "3333311",
                'ownerId' => 1,
            ]
        ];
    }
}
