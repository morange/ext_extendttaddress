<?php

declare(strict_types=1);

namespace DerMatthesFrauHofer\ExtExtendttaddress\Tests\Unit\Controller;

use PHPUnit\Framework\MockObject\MockObject;
use TYPO3\TestingFramework\Core\AccessibleObjectInterface;
use TYPO3\TestingFramework\Core\Unit\UnitTestCase;
use TYPO3Fluid\Fluid\View\ViewInterface;

/**
 * Test case
 *
 * @author Steffen Matthes <info@dermatthes-frauhofer.de>
 */
class ExtendTtAddressControllerTest extends UnitTestCase
{
    /**
     * @var \DerMatthesFrauHofer\ExtExtendttaddress\Controller\ExtendTtAddressController|MockObject|AccessibleObjectInterface
     */
    protected $subject;

    protected function setUp(): void
    {
        parent::setUp();
        $this->subject = $this->getMockBuilder($this->buildAccessibleProxy(\DerMatthesFrauHofer\ExtExtendttaddress\Controller\ExtendTtAddressController::class))
            ->onlyMethods(['redirect', 'forward', 'addFlashMessage'])
            ->disableOriginalConstructor()
            ->getMock();
    }

    protected function tearDown(): void
    {
        parent::tearDown();
    }

    /**
     * @test
     */
    public function listActionFetchesAllExtendTtAddressesFromRepositoryAndAssignsThemToView(): void
    {
        $allExtendTtAddresses = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->disableOriginalConstructor()
            ->getMock();

        $extendTtAddressRepository = $this->getMockBuilder(\DerMatthesFrauHofer\ExtExtendttaddress\Domain\Repository\ExtendTtAddressRepository::class)
            ->onlyMethods(['findAll'])
            ->disableOriginalConstructor()
            ->getMock();
        $extendTtAddressRepository->expects(self::once())->method('findAll')->willReturn($allExtendTtAddresses);
        $this->subject->_set('extendTtAddressRepository', $extendTtAddressRepository);

        $view = $this->getMockBuilder(ViewInterface::class)->getMock();
        $view->expects(self::once())->method('assign')->with('extendTtAddresses', $allExtendTtAddresses);
        $this->subject->_set('view', $view);

        $this->subject->listAction();
    }

    /**
     * @test
     */
    public function showActionAssignsTheGivenExtendTtAddressToView(): void
    {
        $extendTtAddress = new \DerMatthesFrauHofer\ExtExtendttaddress\Domain\Model\ExtendTtAddress();

        $view = $this->getMockBuilder(ViewInterface::class)->getMock();
        $this->subject->_set('view', $view);
        $view->expects(self::once())->method('assign')->with('extendTtAddress', $extendTtAddress);

        $this->subject->showAction($extendTtAddress);
    }
}
