<?php

declare(strict_types=1);

namespace DerMatthesFrauHofer\ExtExtendttaddress\Domain\Repository;

use DerMatthesFrauHofer\ExtExtendttaddress\Domain\Model\Category;
use TYPO3\CMS\Core\Utility\DebugUtility;
use TYPO3\CMS\Extbase\Persistence\Exception\InvalidQueryException;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;
use TYPO3\CMS\Extbase\Persistence\QueryInterface;
use TYPO3\CMS\Extbase\Persistence\Repository;


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
 * @method findByLastName(string $string)
 * @method findByParent(Category $category)
 */
class ExtendTtAddressRepository extends Repository
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

    /**
     * @throws InvalidQueryException
     */
    public function findByCategories(ObjectStorage $categories, string $conjunction, ?ObjectStorage $subCategories = null)
    {
        $query = $this->createQuery();
        $constraint = null;
        $categoryConstraints = [];

        // If "ignore category selection" is used, nothing needs to be done
        if (empty($conjunction)) {
            return $query->execute();
        }

        foreach ($categories as $category) {
            if ($subCategories !== null) {
                $subCategoryConstraint = [];
                $subCategoryConstraint[] = $query->contains('categories', $category);
                if (count($subCategories) > 0) {
                    foreach ($subCategories as $subCategory) {
                        $subCategoryConstraint[] = $query->contains('categories', $subCategory);
                    }
                }
                if ($subCategoryConstraint) {
                    $categoryConstraints[] = $query->logicalOr($subCategoryConstraint);
                }
            } else {
                $categoryConstraints[] = $query->contains('categories', $category);
            }
        }

        foreach ($categories as $category) {
            $categoryConstraints[] = $constraint = $query->contains('categories', $category);
        }

        if ($categoryConstraints) {
            switch (strtolower($conjunction)) {
                case 'or':
                    $constraint = $query->logicalOr($categoryConstraints);
                    break;
                case 'notor':
                    $constraint = $query->logicalNot($query->logicalOr($categoryConstraints));
                    break;
                case 'notand':
                    $constraint = $query->logicalNot($query->logicalAnd($categoryConstraints));
                    break;
                case 'and':
                default:
                    $constraint = $query->logicalAnd($categoryConstraints);
            }
        }

        if ($constraint !== null) {
            $query->matching(
                $query->logicalAnd($constraint)
            );
        }

        return $query->execute();
    }
}


