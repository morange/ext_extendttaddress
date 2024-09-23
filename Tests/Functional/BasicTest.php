<?php

declare(strict_types=1);

namespace DerMatthesFrauHofer\ExtExtendttaddress\Tests\Functional;

use TYPO3\TestingFramework\Core\Functional\FunctionalTestCase;

/**
 * Test case
 *
 * @author Steffen Matthes <info@dermatthes-frauhofer.de>
 */
class BasicTest extends FunctionalTestCase
{
    /**
     * @var array
     */
    protected $testExtensionsToLoad = [
        'typo3conf/ext/ext_extendttaddress',
    ];

    /**
     * Just a dummy to show that at least one test is actually executed
     *
     * @test
     */
    public function dummy(): void
    {
        self::assertTrue(true);
    }
}
