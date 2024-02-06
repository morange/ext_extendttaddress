<?php

declare(strict_types=1);

namespace DerMatthesFrauHofer\ExtExtendttaddress\Domain\Model;


use FriendsOfTYPO3\TtAddress\Domain\Model\Address;

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
class ExtendTtAddress extends Address
{

    /**
     * txBirthday
     *
     * @var ?string
     */
    protected ?string $txBirthday = null;

    /**
     * txDeathday
     *
     * @var ?string
     */
    protected ?string $txDeathday = null;

    /**
     * Returns the txBirthday
     *
     * @return ?string
     */
    public function gettxBirthday(): ?string
    {
        return $this->txBirthday;
    }

    /**
     * Sets the txBirthday
     *
     * @param ?string $txBirthday
     * @return void
     */
    public function settxBirthday(?string $txBirthday): void
    {
        $this->txBirthday = $txBirthday;
    }

    /**
     * Returns the txDeathday
     *
     * @return ?string
     */
    public function getTxDeathday(): ?string
    {
        return $this->txDeathday;
    }

    /**
     * Sets the txDeathday
     *
     * @param ?string $txDeathday
     * @return void
     */
    public function setTxDeathday(?string $txDeathday): void
    {
        $this->txDeathday = $txDeathday;
    }
}
