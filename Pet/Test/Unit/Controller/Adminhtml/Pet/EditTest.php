<?php

namespace Webjump\Pet\Test\Unit\Controller\Adminhtml\Pet;

use Magento\Backend\App\AbstractAction;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\AuthorizationInterface;
use Magento\Framework\View\Page\Config;
use Magento\Framework\View\Page\Title;
use Magento\Framework\View\Result\Page;
use Magento\Framework\View\Result\PageFactory;
use Webjump\Pet\Controller\Adminhtml\Pet\Create;
use Webjump\Pet\Controller\Adminhtml\Pet\Edit;
use PHPUnit\Framework\TestCase;


class EditTest extends TestCase
{
    private Context|\PHPUnit\Framework\MockObject\MockObject $context;
    private \PHPUnit\Framework\MockObject\MockObject|PageFactory $pageFactory;

    public function setUp(): void
    {
        $this->contextMock = $this->createMock(Context::class);
        $this->pageFactoryMock = $this->createMock(PageFactory::class);

        $this->edit = new Edit(
            $this->contextMock,
            $this->pageFactoryMock
        );

        $this->page = $this->createMock(Page::class);
        $this->pageConfigMock = $this->createMock(Config::class);
        $this->titleMock = $this->createMock(Title::class);
        $this->authorizationInterfaceMock = $this->createMock(AuthorizationInterface::class);
        $this->actionMock = $this->createMock(Action::class);
        $this->abstractAction = $this->createMock(AbstractAction::class);
    }

    /**
     * Test Construct
     *
     * @return void
     */
    public function testConstruct(): void
    {
        $this->assertInstanceOf(Edit::class, $this->edit);
    }

    /**
     * Test method execute
     *
     * @return void
     */
    public function testExecute(): void
    {

        $this->pageFactoryMock
            ->expects($this->once())
            ->method('create')
            ->willReturn($this->page);

        $this->page
            ->expects($this->once())
            ->method('getConfig')
            ->willReturn($this->pageConfigMock);

        $this->pageConfigMock
            ->expects($this->once())
            ->method('getTitle')
            ->willReturn($this->titleMock);

        $this->titleMock
            ->expects($this->once())
            ->method('prepend')
            ->with('Edit a pet kind');

        $this->assertEquals($this->page, $this->edit->execute());
    }
}
