<?php

declare(strict_types=1);

namespace DerMatthesFrauHofer\ExtExtendttaddress\Tests\Unit\Domain\Model;

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
     * @var \DerMatthesFrauHofer\ExtExtendttaddress\Domain\Model\ExtendTtAddress|MockObject|AccessibleObjectInterface
     */
    protected $subject;

    protected function setUp(): void
    {
        parent::setUp();

        $this->subject = $this->getAccessibleMock(
            \DerMatthesFrauHofer\ExtExtendttaddress\Domain\Model\ExtendTtAddress::class,
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
    public function getTxBirthdayReturnsInitialValueForString|null(): void
    {
    }

    /**
     * @test
     */
    public function setTxBirthdayForString|nullSetsTxBirthday(): void
    {
    }

    /**
     * @test
     */
    public function getTxDeathdayReturnsInitialValueForString|null(): void
    {
    }

    /**
     * @test
     */
    public function setTxDeathdayForString|nullSetsTxDeathday(): void
    {
    }
}
