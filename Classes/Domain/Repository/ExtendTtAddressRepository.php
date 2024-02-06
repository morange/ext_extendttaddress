<?php

declare(strict_types=1);

namespace DerMatthesFrauHofer\ExtExtendttaddress\Domain\Repository;

use \TYPO3\CMS\Extbase\Persistence\QueryInterface;
use \TYPO3\CMS\Extbase\Persistence\Repository;


/**
 * This file is part of the "Extend TtAddress" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * (c) 2024 Steffen Matthes <info@dermatthes-frauhofer.de>, Der Matthes und Frau Hofer
 */

/**
 * The repository for ExtendTtAddresses
 */
class ExtendTtAddressRepository extends \TYPO3\CMS\Extbase\Persistence\Repository
{

    /**
     * @var array
     */
	/*
	 * @method QueryResultInterface findByLastName(string $last_name)
	 */
	protected $defaultOrderings = [
		'last_name' => QueryInterface::ORDER_ASCENDING
	];

	public function findByCategory($categoryid) {
		$query = $this->createQuery();
		$query->matching($query->contains('categories', $categoryid));
		return $query->execute();
	}
}


