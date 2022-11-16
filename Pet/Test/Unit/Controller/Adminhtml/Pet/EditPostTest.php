<?php

namespace Webjump\Pet\Test\Unit\Controller\Adminhtml\Pet;

use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Request\Http;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\Controller\Result\RedirectFactory;
use Magento\Framework\Controller\Result\Redirect;
use Webjump\Pet\Api\PetRepositoryInterface;
use Webjump\Pet\Controller\Adminhtml\Pet\EditPost;
use PHPUnit\Framework\TestCase;
use Webjump\Pet\Api\Data\PetInterfaceFactory;
use Webjump\Pet\Api\Data\PetInterface;
use Webjump\Pet\Model\Pet;
use Magento\Framework\Message\ManagerInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Backend\App\Action;

class EditPostTest extends TestCase
{
    private Context|\PHPUnit\Framework\MockObject\MockObject $contextMock;
    private \PHPUnit\Framework\MockObject\MockObject|RequestInterface $requestInterfaceMock;
    private PetInterfaceFactory|\PHPUnit\Framework\MockObject\MockObject $petInterfaceFactoryMock;
    private \PHPUnit\Framework\MockObject\MockObject|PetRepositoryInterface $petRepositoryInterfaceMock;
    private EditPost $editPost;
    private Redirect|\PHPUnit\Framework\MockObject\MockObject $redirectMock;

    /**
     * Init Mock
     *
     * @return void
     */
    public function setUp(): void
    {
        $this->contextMock = $this->createMock(Context::class);
        $this->requestInterfaceMock = $this->createMock(RequestInterface::class);
        $this->redirectFactoryMock = $this->createMock(RedirectFactory::class);
        $this->petInterfaceFactoryMock = $this->createMock(PetInterfaceFactory::class);
        $this->petRepositoryInterfaceMock = $this->createMock(PetRepositoryInterface::class);

        $this->contextMock->method('getRequest')
            ->willReturn($this->requestInterfaceMock);

        $this->requestMock = $this->createMock(Http::class);


        $this->editPost = new EditPost(
            $this->contextMock,
            $this->requestInterfaceMock,
            $this->redirectFactoryMock,
            $this->petInterfaceFactoryMock,
            $this->petRepositoryInterfaceMock
        );

        $this->redirectMock = $this->createMock(Redirect::class);
        $this->petMock = $this->createMock(Pet::class);
        $this->managerInterfaceMock = $this->createMock(ManagerInterface::class);
        $this->resultInterfaceMock = $this->createMock(ResultInterface::class);
        $this->editPostMock = $this->createMock(EditPost::class);

    }

    /**
     * Test construct
     *
     * @return void
     */
    public function testConstruct(): void
    {
        $this->assertInstanceOf(EditPost::class, $this->editPost);
    }

    /**
     * Test Execute method
     *
     * @return void
     */
    public function testExecute(): void
    {
        $this->redirectFactoryMock
            ->expects($this->once())
            ->method('create')
            ->willReturn($this->redirectMock);

        $this->requestInterfaceMock
            ->expects($this->once())
            ->method('getParam')
            ->with('entity_id')
            ->willReturn(10);

        $this->requestInterfaceMock
            ->expects($this->once())
            ->method('getParam')
            ->with('name')
            ->willReturn('carlos');

        $this->requestInterfaceMock
            ->expects($this->once())
            ->method('getParam')
            ->with('description')
            ->willReturn('description');


        $this->petInterfaceFactoryMock
            ->expects($this->once())
            ->method('create')
            ->willReturn($this->petMock);

        $this->petMock
            ->expects($this->once())
            ->method('setId')
            ->with(10)
            ->willReturn($this->petMock);

        $this->petMock
            ->expects($this->once())
            ->method('setName')
            ->with('carlos')
            ->willReturn($this->petMock);

        $this->petMock
            ->expects($this->once())
            ->method('setDescription')
            ->with('description')
            ->willReturn($this->petMock);

        $this->petRepositoryInterfaceMock
            ->expects($this->once())
            ->method('save')
            ->with($this->petMock)
            ->willReturn($this->petMock);

        $this->managerInterfaceMock
            ->expects($this->once())
            ->method('addSuccessMessage')
            ->with('Pet edit with success')
            ->willReturn($this->managerInterfaceMock);

        $this->redirectMock
            ->expects($this->once())
            ->method('setPath')
            ->with('*/*/index')
            ->willReturn($this->redirectMock);

        $this->assertEquals($this->resultInterfaceMock, $this->editPost->execute());
    }
}
