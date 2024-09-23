<?php

declare(strict_types=1);

namespace DerMatthesFrauHofer\ExtExtendttaddress\Tests\Unit\Domain\Model;

use DerMatthesFrauHofer\ExtExtendttaddress\Domain\Model\ExtendTtAddress;
use PHPUnit\Framework\MockObject\MockObject;
use TYPO3\TestingFramework\Core\AccessibleObjectInterface;
use TYPO3\TestingFramework\Core\Unit\UnitTestCase;

/**
 * Test case
 *
 * @author Steffen Matthes <info@dermatthes-frauhofer.de>
 */
class ExtendTtAddressTest extends UnitTestCase
{
    /**
     * @var ExtendTtAddress|MockObject|AccessibleObjectInterface
     */
    protected $subject;

    protected function setUp(): void
    {
        parent::setUp();

        $this->subject = $this->getAccessibleMock(
            ExtendTtAddress::class,
            ['dummy']
        );
    }

    protected function tearDown(): void
    {
        parent::tearDown();
    }

    /**
     * @test
     */
    public function getTxBirthdayReturnsInitialValueForString(): void {}

    /**
     * @test
     */
    public function setTxBirthdayForStringSetsTxBirthday(): void {}

    /**
     * @test
     */
    public function getTxDeathdayReturnsInitialValueForString(): void {}

    /**
     * @test
     */
    public function setTxDeathdayForStringSetsTxDeathday(): void {}
}
