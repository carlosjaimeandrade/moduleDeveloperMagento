<?php

namespace Webjump\Pet\Model\Config;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;

class Data
{

    /**
     * @var string CONFIGPATH_PREFIX
     */
    public const CONFIGPATH_PREFIX = "pet_kind_config/options/";

    /**
     * @var string BASE_URL
     */
    public const ENABLE = 'enable_pet_customer';

    /**
     * @var ScopeConfigInterface
     */
    protected ScopeConfigInterface $scopeConfigInterface;

    /**
     * Data constructor.
     *
     * @param ScopeConfigInterface $scopeConfigInterface
     */
    public function __construct(
        ScopeConfigInterface $scopeConfigInterface
    ) {
        $this->scopeConfigInterface = $scopeConfigInterface;
    }

    /**
     * Get value from config
     *
     * @param string $field
     * @param int|null $storeId
     * @return string|null
     */
    public function getValue(string $field, int $storeId = null): ?string
    {
        return $this->getSystemConfigModule($field, $storeId);
    }

    /**
     * Method return configuration customize to module
     *
     * @param string $field
     * @param int|null $storeId
     * @return string|null
     */
    private function getSystemConfigModule($field, int $storeId = null): ?string
    {
        $field = self::CONFIGPATH_PREFIX . $field;
        return $this->getSystemConfig($field, ScopeInterface::SCOPE_STORE, $storeId);
    }

    /**
     * Get configuration value
     *
     * @param string $field
     * @param string $scope
     * @param int $storeId
     * @return string|null
     */
    private function getSystemConfig($field, $scope, $storeId = null): ?string
    {
        if ($storeId === null) {
            return $this->scopeConfigInterface->getValue($field, $scope);
        }
        return $this->scopeConfigInterface->getValue($field, $scope, $storeId);
    }

    /**
     * Get config base url
     *
     * @return string|null
     */
    public function getEnable(): ?string
    {
        return $this->getValue(self::ENABLE);
    }
}
