<?php

namespace Webjump\Pet\Setup\Patch\Data;

use Magento\Customer\Api\CustomerMetadataInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;

class UninstallPetKind implements DataPatchInterface
{
    protected $eavSetupFactory;

    public function __construct(\Magento\Eav\Setup\EavSetupFactory $eavSetupFactory)
    {
        $this->eavSetupFactory = $eavSetupFactory;
    }


    public static function getDependencies(): array
    {
        return [];
    }

    public function getAliases(): array
    {
        return [];
    }

    public function apply()
    {

        $eavSetup = $this->eavSetupFactory->create();
        $entityTypeId = CustomerMetadataInterface::ATTRIBUTE_SET_ID_CUSTOMER;
        $eavSetup->removeAttribute($entityTypeId, 'pet_kind');

    }
}

