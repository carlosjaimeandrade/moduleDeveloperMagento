<?php

namespace Webjump\Pet\Test\Unit\Model\ResourceModel\Collection;

use Magento\Framework\Data\Collection\Db\FetchStrategyInterface;
use Magento\Framework\Data\Collection\EntityFactoryInterface;
use Magento\Framework\DB\Adapter\AdapterInterface;
use Magento\Framework\DB\Select;
use Magento\Framework\Event\ManagerInterface;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use Webjump\Pet\Model\ResourceModel\Collection\Collection;
use PHPUnit\Framework\TestCase;
use Psr\Log\LoggerInterface;

class CollectionTest extends TestCase
{

    /**
     * Set up mocks
     */
    protected function setUp(): void
    {
        $entityFactoryMock = $this->createMock(EntityFactoryInterface::class);
        $loggerMock = $this->createMock(LoggerInterface::class);
        $fetchStrategyMock = $this->createMock(FetchStrategyInterface::class);
        $eventManagerMock = $this->createMock(ManagerInterface::class);
        $connectionMock = $this->createMock(AdapterInterface::class);
        $resourceMock = $this->createMock(AbstractDb::class);

        $resourceMock->method('getConnection')
            ->willReturn($connectionMock);

        $selectMock = $this->createPartialMock(Select::class, ['from']);
        $connectionMock->method('select')
            ->willReturn($selectMock);

        $selectMock->method('from')
            ->willReturnSelf();

        $this->collection = new Collection(
            $entityFactoryMock,
            $loggerMock,
            $fetchStrategyMock,
            $eventManagerMock,
            $connectionMock,
            $resourceMock
        );
    }

    /**
     * Test construct
     */
    public function testCanCreate(): void
    {
        $this->assertInstanceOf(Collection::class, $this->collection);
    }
}
