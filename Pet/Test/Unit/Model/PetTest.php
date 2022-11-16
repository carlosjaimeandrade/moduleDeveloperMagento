<?php

namespace  Webjump\Pet\Test\Unit\Model;

use Webjump\Pet\Model\Pet;
use PHPUnit\Framework\TestCase;
use Magento\Framework\Model\Context;
use Magento\Framework\Registry;
use Magento\Framework\Model\ResourceModel\AbstractResource;
use Magento\Framework\Data\Collection\AbstractDb;
use Webjump\Pet\Model\ResourceModel\PetResource;
use Webjump\Pet\Model\ResourceModel\Collection\Collection;

class PetTest extends TestCase
{

    /**
     * @inheritDoc
     */
    protected function setUp(): void
    {
        $context = $this->getMockBuilder(Context::class)
            ->disableOriginalConstructor()
            ->getMockForAbstractClass();
        $registry = $this->getMockBuilder(Registry::class)
            ->disableOriginalConstructor()
            ->getMockForAbstractClass();
        $resource = $this->createMock(PetResource::class);
        $collection = $this->createMock(Collection::class);

        $this->pet = new Pet(
            $context,
            $registry,
            $resource,
            $collection
        );
    }

    /**
     * Test construct
     */
    public function testCanCreate(): void
    {
        $this->assertInstanceOf(Pet::class, $this->pet);
    }

    /**
     * Test set get name
     *
     * @return void
     */
    public function testGetSetName(): void
    {
        $this->pet->setName("test");
        $result = $this->pet->getName();
        $this->assertEquals('test', $result);
    }

    /**
     * Test set get Descriptio
     *
     * @return void
     */
    public function testGetSetDescriptio(): void
    {
        $this->pet->setDescription("test");
        $result = $this->pet->getDescription();
        $this->assertEquals('test', $result);
    }
}
