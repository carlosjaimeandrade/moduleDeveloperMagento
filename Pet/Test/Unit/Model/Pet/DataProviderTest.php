<?php

namespace Webjump\Pet\Test\Unit\Model\Pet;

use Webjump\Pet\Model\Pet\DataProvider;
use PHPUnit\Framework\TestCase;
use Webjump\Pet\Model\ResourceModel\Collection\CollectionFactory;
use Magento\Framework\App\Request\DataPersistorInterface;
use Webjump\Pet\Model\ResourceModel\Collection\Collection;
use Magento\Framework\DataObject;
use Webjump\Pet\Model\Pet;

/**
 * @coversDefaultClass \Webjump\Pet\Model\Pet\DataProvider
 */
class DataProviderTest extends TestCase
{
    private \PHPUnit\Framework\MockObject\MockObject|CollectionFactory $collectionFactoryMock;
    private \PHPUnit\Framework\MockObject\MockObject|DataPersistorInterface $dataPersistorMock;

    /**
     * Init class
     *
     * @return void
     */
    protected function setUp(): void
    {
        $this->collectionFactoryMock = $this->createMock(CollectionFactory::class);
        $this->dataPersistorMock = $this->createMock(DataPersistorInterface::class);

        $this->dataProvider = new DataProvider(
            'name',
            'primaryFieldName',
            'requestFieldName',
            $this->collectionFactoryMock,
            $this->dataPersistorMock
        );

        $this->collectionMock = $this->createMock(Collection::class);
        $this->PetMock = $this->createMock(Pet::class);
    }

    /**
     * @return void
     */
    public function testConstruct(): void
    {
        $this->assertInstanceOf(DataProvider::class, $this->dataProvider);
    }

    /**
     * @return void
     */
    public function testGetData(): void
    {
        $this->collectionFactoryMock
            ->expects($this->once())
            ->method('create')
            ->willReturn($this->collectionMock);

        $this->collectionMock
            ->expects($this->once())
            ->method("getItems")
            ->willReturn([$this->PetMock]);

        $this->PetMock
            ->expects($this->once())
            ->method('getId')
            ->willReturn(10);

        $this->PetMock
            ->expects($this->once())
            ->method('getData')
            ->willReturn([]);

        $this->assertEquals(
            [10 => []],
            $this->dataProvider->getData()
        );
    }
}
