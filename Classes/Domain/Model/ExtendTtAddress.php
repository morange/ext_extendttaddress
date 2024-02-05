<?php

declare(strict_types=1);

namespace DerMatthesFrauHofer\ExtExtendttaddress\Domain\Model;


/**
 * This file is part of the "Extend TtAddress" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * (c) 2024 Steffen Matthes <info@dermatthes-frauhofer.de>, Der Matthes und Frau Hofer
 */

/**
 * ExtendTtAddress
 */
class ExtendTtAddress extends \FriendsOfTYPO3\TtAddress\Domain\Model\Address
{

    /**
     * txBirtday
     *
     * @var string|null
     */
    protected $txBirthday = null;

    /**
     * txDeathday
     *
     * @var string|null
     */
    protected $txDeathday = null;

    /**
     * Returns the txBirthday
     *
     * @return string|null
     */
    public function gettxBirthday()
    {
        return $this->txBirthday;
    }

    /**
     * Sets the txBirthday
     *
     * @param string|null $txBirthday
     * @return void
     */
    public function settxBirthday(?string $txBirthday)
    {
        $this->txBirthday = $txBirthday;
    }

    /**
     * Returns the txDeathday
     *
     * @return string|null
     */
    public function getTxDeathday()
    {
        return $this->txDeathday;
    }

    /**
     * Sets the txDeathday
     *
     * @param string|null $txDeathday
     * @return void
     */
    public function setTxDeathday(?string $txDeathday)
    {
        $this->txDeathday = $txDeathday;
    }
}
