<?php

namespace Webjump\Pet\Test\Unit\Model\Source;

use Magento\Framework\Api\SearchCriteriaBuilder;
use Webjump\Pet\Model\Repository\PetRepository;
use Webjump\Pet\Model\ResourceModel\Collection\CollectionFactory;
use Webjump\Pet\Model\ResourceModel\Collection\Collection;
use Webjump\Pet\Model\Source\PetKind;
use PHPUnit\Framework\TestCase;
use Magento\Framework\DataObject;
use Webjump\Pet\Model\Pet;

class PetKindTest extends TestCase
{
    private \PHPUnit\Framework\MockObject\MockObject|SearchCriteriaBuilder $searchCriteriaBuilderMock;
    private \PHPUnit\Framework\MockObject\MockObject|PetRepository $petRepositoryMock;
    private \PHPUnit\Framework\MockObject\MockObject|CollectionFactory $collectionFactory;

    /**
     * @inheritDoc
     */
    protected function setUp(): void
    {
        $this->searchCriteriaBuilderMock = $this->createMock(SearchCriteriaBuilder::class);
        $this->petRepositoryMock = $this->createMock(PetRepository::class);
        $this->collectionFactory = $this->createMock(CollectionFactory::class);

        $this->petKind = new PetKind(
            $this->petRepositoryMock,
            $this->searchCriteriaBuilderMock,
            $this->collectionFactory
        );

        $this->collectionMock = $this->createMock(Collection::class);
        $this->dataObjectMock = $this->createMock(DataObject::class);
        $this->pet = $this->createMock(Pet::class);
    }

    /**
     * Test construct
     *
     * @return void
     */
    public function testConstruct(): void
    {
        $this->assertInstanceOf(PetKind::class,  $this->petKind);
    }

    public function testToOptionArray(): void
    {
        $this->collectionFactory
            ->expects($this->once())
            ->method('create')
            ->willReturn($this->collectionMock);

        $this->collectionMock
            ->expects($this->once())
            ->method('getItems')
            ->willReturn([$this->pet]);

        $this->pet
            ->expects($this->exactly(2))
            ->method('getName')
            ->willReturn('test');

        $this->assertEquals(
            [['label' => 'test','value' => 'test']],
            $this->petKind->toOptionArray());

    }
}
