<?php

namespace Webjump\Pet\Test\Unit\Model\ResourceModel;

use Magento\Framework\App\ResourceConnection;
use Magento\Framework\Model\ResourceModel\Db\Context;
use PHPUnit\Framework\MockObject\MockObject;
use Webjump\ItemPrescription\Api\Data\ItemPrescriptionInterface;
use Webjump\ItemPrescription\Model\ResourceModel\ItemPrescription as ItemPrescriptionResourceModel;
use Webjump\Pet\Model\ResourceModel\PetResource;
use PHPUnit\Framework\TestCase;

class PetResourceTest extends TestCase
{


    /**
     * Set up mocks
     */
    protected function setUp(): void
    {
        $contextMock = $this->createMock(Context::class);
        $this->resourceConnectionMock = $this->createMock(ResourceConnection::class);

        $contextMock->expects($this->once())
            ->method('getResources')
            ->willReturn($this->resourceConnectionMock);

        $this->resourceModel = new PetResource($contextMock);
    }

    public function testCanCreate(): void
    {
        $this->assertInstanceOf(PetResource::class, $this->resourceModel);
    }

    public function testGetIdFieldName(): void
    {
        $this->assertEquals(PetResource::ENTITY_ID, $this->resourceModel->getIdFieldName());
    }

    public function testGetMainTable(): void
    {
        $this->resourceConnectionMock->expects($this->once())
            ->method('getTableName')
            ->with(PetResource::TABLE_NAME, 'default')
            ->willReturn(PetResource::TABLE_NAME);

        $this->assertSame(PetResource::TABLE_NAME, $this->resourceModel->getMainTable());
    }
}
