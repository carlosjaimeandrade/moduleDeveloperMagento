<?php

namespace Webjump\Pet\Test\Unit\Model\Repository;

use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use Webjump\Pet\Model\Pet\DataProvider;
use Webjump\Pet\Model\Repository\PetRepository;
use PHPUnit\Framework\TestCase;
use Webjump\Pet\Model\ResourceModel\PetResource;
use Webjump\Pet\Model\PetFactory;
use Webjump\Pet\Model\ResourceModel\Collection\CollectionFactory;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Webjump\Pet\Api\Data\PetSearchResultInterfaceFactory;
use Webjump\Pet\Api\Data\PetSearchResultInterface;
use Webjump\Pet\Api\Data\PetInterface;
use Webjump\Pet\Model\Pet;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use Webjump\Pet\Model\ResourceModel\Collection\Collection;
use Magento\Framework\Api\SearchCriteria;
use Magento\Framework\Api\SearchResultsInterface;
use Webjump\Pet\Model\PetSearchResult;
use Magento\Framework\Api\SearchCriteriaInterface;

class PetRepositoryTest extends TestCase
{
    private \PHPUnit\Framework\MockObject\MockObject|PetResource $petResourceMock;
    private \PHPUnit\Framework\MockObject\MockObject|PetFactory $petFactoryMock;
    private \PHPUnit\Framework\MockObject\MockObject|CollectionFactory $collectionFactoryMock;
    private \PHPUnit\Framework\MockObject\MockObject|CollectionProcessorInterface $collectionProcessorMock;
    private \PHPUnit\Framework\MockObject\MockObject|PetSearchResultInterfaceFactory $petSearchResultFactoryMock;

    /**
     * @return void
     */
    protected function setUp(): void
    {
        $this->petResourceMock = $this->createMock(PetResource::class);
        $this->petFactoryMock = $this->createMock(PetFactory::class);
        $this->collectionFactoryMock = $this->createMock(CollectionFactory::class);
        $this->collectionProcessorMock = $this->createMock(CollectionProcessorInterface::class);
        $this->petSearchResultFactoryMock = $this->createMock(PetSearchResultInterfaceFactory::class);

        $this->petRepository = new PetRepository(
            $this->petResourceMock,
            $this->petFactoryMock,
            $this->collectionFactoryMock,
            $this->collectionProcessorMock,
            $this->petSearchResultFactoryMock
        );

        $this->petInterfaceMock = $this->createMock(PetInterface::class);
        $this->abstractDbMock = $this->createMock(AbstractDb::class);
        $this->petMock = $this->createMock(Pet::class);
        $this->collectionMock = $this->createMock(Collection::class);
        $this->searchCriteriaMock = $this->createMock(SearchCriteria::class);
        $this->searchResultsInterfaceMock = $this->createMock(SearchResultsInterface::class);
        $this->petSearchResultMock = $this->createMock(PetSearchResult::class);
        $this->searchCriteriaInterfaceMock = $this->createMock(SearchCriteriaInterface::class);
        $this->petSearchResultInterface = $this->createMock(PetSearchResultInterface::class);
    }

    /**
     * @return void
     */
    public function testConstruct(): void
    {
        $this->assertInstanceOf(PetRepository::class, $this->petRepository);
    }

    /**
     * Test save
     *
     * @return void
     * @throws \Magento\Framework\Exception\CouldNotSaveException
     */
    public function testSave(): void
    {
        $this->petResourceMock
            ->expects($this->once())
            ->method('save')
            ->with($this->petMock)
            ->willReturn($this->abstractDbMock);

        $this->assertEquals(
            $this->petMock,
            $this->petRepository->save($this->petMock)
        );
    }

    /**
     * Test save exception
     *
     * @return void
     * @throws \Magento\Framework\Exception\CouldNotSaveException
     */
    public function testSaveException(): void
    {
        $this->petResourceMock
            ->expects($this->once())
            ->method('save')
            ->with($this->petMock)
            ->willThrowException(new \Exception("Error!"));

        $this->expectException(LocalizedException::class);
        $this->expectExceptionMessage('Could not save the order status state: Error!');

        $this->petRepository->save($this->petMock);
    }

    /**
     * Test get by id
     *
     * @throws NoSuchEntityException
     */
    public function testGetById(): void
    {
        $this->petFactoryMock
            ->expects($this->once())
            ->method('create')
            ->willReturn($this->petMock);

        $this->petResourceMock
            ->expects($this->once())
            ->method('load')
            ->with($this->petMock, 10)
            ->willReturn($this->abstractDbMock);

        $this->petMock
            ->expects($this->once())
            ->method('getEntityId')
            ->willReturn(10);

        $this->assertEquals(
            $this->petMock,
            $this->petRepository->getById(10)
        );
    }

    /**
     * Test get by id
     *
     * @throws NoSuchEntityException
     */
    public function testGetByIdException(): void
    {
        $this->petFactoryMock
            ->expects($this->once())
            ->method('create')
            ->willReturn($this->petMock);

        $this->petResourceMock
            ->expects($this->once())
            ->method('load')
            ->with($this->petMock, 10)
            ->willReturn($this->abstractDbMock);

        $this->expectException(LocalizedException::class);
        $this->expectExceptionMessage('Pet with id "%1" does not exist.');


        $this->petRepository->getById(10);
    }

    /**
     * Test get list
     *
     * @return void
     */
    public function testGetList(): void
    {
        $this->collectionFactoryMock
            ->expects($this->once())
            ->method('create')
            ->willReturn($this->collectionMock);

        $this->collectionProcessorMock
            ->expects($this->once())
            ->method('process')
            ->with($this->searchCriteriaInterfaceMock, $this->collectionMock);

        $this->petSearchResultFactoryMock
            ->expects($this->once())
            ->method('create')
            ->willReturn($this->petSearchResultInterface);

        $this->collectionMock
            ->expects($this->once())
            ->method('getItems')
            ->willReturn([]);

        $this->petSearchResultInterface
            ->expects($this->once())
            ->method('setItems')
            ->with([])
            ->willReturn($this->petSearchResultInterface);

        $this->collectionMock
            ->expects($this->once())
            ->method('getSize')
            ->willReturn(10);

        $this->petSearchResultInterface
            ->expects($this->once())
            ->method('setTotalCount')
            ->with(10)
            ->willReturn($this->petSearchResultInterface);

        $this->petSearchResultInterface
            ->expects($this->once())
            ->method('setSearchCriteria')
            ->with($this->searchCriteriaInterfaceMock)
            ->willReturn($this->petSearchResultInterface);

        $this->assertEquals(
            $this->petSearchResultInterface,
            $this->petRepository->getList($this->searchCriteriaInterfaceMock)
        );
    }

    /**
     * Test delete
     *
     * @throws \Magento\Framework\Exception\CouldNotDeleteException
     */
    public function testDelete()
    {
        $this->petResourceMock
            ->expects($this->once())
            ->method('delete')
            ->with($this->petMock)
            ->willReturn($this->abstractDbMock);

        $this->assertEquals(
            true,
            $this->petRepository->delete($this->petMock)
        );
    }

    /**
     * Test delete Exception
     *
     * @throws \Magento\Framework\Exception\CouldNotDeleteException
     */
    public function testDeleteException()
    {
        $this->petResourceMock
            ->expects($this->once())
            ->method('delete')
            ->with($this->petMock)
            ->willThrowException(new \Exception("Error!"));

        $this->expectException(LocalizedException::class);
        $this->expectExceptionMessage("Error!");


        $this->petRepository->delete($this->petMock);
    }
}
