<?php

namespace Webjump\Pet\Test\Unit\Model\Config;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;
use PHPUnit\Framework\MockObject\MockObject;
use Webjump\BrotoNews\Api\ConfigurationInterface;
use Webjump\Pet\Model\Config\Data;
use PHPUnit\Framework\TestCase;

/**
 * Test for class: Data
 *
 * @coversDefaultClass \Webjump\Pet\Model\Config\Data
 */
class DataTest extends TestCase
{
    /**
     * @var ScopeConfigInterface|MockObject
     */
    private $scopeConfigInterfaceMock;

    /**
     * @var \Webjump\BrotoNews\Model\Config\Data
     */
    private Data $data;

    /**
     * Set up mocks
     */
    protected function setUp(): void
    {
        $this->scopeConfigInterfaceMock = $this->createMock(ScopeConfigInterface::class);

        $this->data = new Data(
            $this->scopeConfigInterfaceMock
        );
    }

    /**
     * Test constructor class
     */
    public function testConstructor(): void
    {
        $this->assertInstanceOf(
            Data::class,
            $this->data
        );
    }

    /**
     * Test get value config
     */
    public function testGetValue(): void
    {
        $this->scopeConfigInterfaceMock->expects($this->once())
            ->method('getValue')
            ->with('pet_kind_config/options/enable_pet_customer', 'store')
            ->willReturn('enable_pet_customer');

        $this->assertEquals('enable_pet_customer', $this->data->getValue('enable_pet_customer'));
    }

    /**
     * Test get value config store id not null
     */
    public function testGetValueStoreIdNotNull(): void
    {
        $this->scopeConfigInterfaceMock->expects($this->once())
            ->method('getValue')
            ->with('pet_kind_config/options/enable_pet_customer', 'store')
            ->willReturn('enable_pet_customer');

        $this->assertEquals('enable_pet_customer', $this->data->getValue('enable_pet_customer', 1));
    }

    /**
     * Test get base url config
     */
    public function testGetEnable(): void
    {
        $this->assertNull($this->data->getEnable());
    }
}
