<?php

declare(strict_types=1);

namespace DerMatthesFrauHofer\ExtExtendttaddress\Domain\Repository;

use DerMatthesFrauHofer\ExtExtendttaddress\Domain\Model\Category;
use TYPO3\CMS\Extbase\Persistence\Exception\InvalidQueryException;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;
use TYPO3\CMS\Extbase\Persistence\QueryInterface;
use TYPO3\CMS\Extbase\Persistence\QueryResultInterface;
use TYPO3\CMS\Extbase\Persistence\Repository;

// use TYPO3\CMS\Core\Utility\DebugUtility;

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
        'last_name' => QueryInterface::ORDER_ASCENDING,
    ];

    /**
     * @throws InvalidQueryException
     */
    public function findByCategories(ObjectStorage $categories, string $conjunction, ?ObjectStorage $subCategories, string $atozvalue = '')
    {
        $query = $this->createQuery();
        $constraints = [];
        $categoryConstraints = [];

        // If "ignore category selection" is used, nothing needs to be done
        if ($conjunction === '' || $conjunction === '0') {
            return $this->findAll($atozvalue);
        }

        foreach ($categories as $category) {
            if ($subCategories instanceof ObjectStorage) {
                $subCategoryConstraint = [];
                $subCategoryConstraint[] = $query->contains('categories', $category);
                if (count($subCategories) > 0) {
                    foreach ($subCategories as $subCategory) {
                        $subCategoryConstraint[] = $query->contains('categories', $subCategory);
                    }
                }
                $categoryConstraints[] = $query->logicalOr(...$subCategoryConstraint);
            } else {
                $categoryConstraints[] = $query->contains('categories', $category);
            }
        }

        foreach ($categories as $category) {
            $categoryConstraints[] = $query->contains('categories', $category);
        }

        if ($categoryConstraints !== []) {
            $constraints[] = match (strtolower($conjunction)) {
                'or' => $query->logicalOr(...$categoryConstraints),
                'notor' => $query->logicalNot($query->logicalOr(...$categoryConstraints)),
                'notand' => $query->logicalNot($query->logicalAnd(...$categoryConstraints)),
                default => $query->logicalAnd(...$categoryConstraints),
            };
        }

        if ($atozvalue !== '') {
            // DebugUtility::debug($atozvalue);
            $constraints[] = $query->like('lastName', $atozvalue . '%');
        }

        if ($constraints !== null) {
            $query->matching(
                $query->logicalAnd(...$constraints)
            );
        }

        return $query->execute();
    }

    /**
     * @return array|object[]|QueryResultInterface
     * @throws InvalidQueryException
     */
    public function findAll(string $atozvalue = '')
    {
        $query = $this->createQuery();

        if ($atozvalue !== '') {
            $query->matching(
                $query->like('lastName', $atozvalue . '%')
            );
        }

        return $query->execute();
    }

    /**
     * @throws InvalidQueryException
     */
    public function getFirstLettersOfLastNameByCategory(ObjectStorage $categories, string $conjunction, ?ObjectStorage $subCategories): array
    {
        return $this->getFirstLettersFromResults(
            $this->findByCategories($categories, $conjunction, $subCategories)
        );
    }

    /**
     * @throws InvalidQueryException
     */
    public function getFirstLettersOfLastName(): array
    {
        return $this->getFirstLettersFromResults(
            $this->findAll()
        );
    }

    /**
     * @param $results
     */
    protected function getFirstLettersFromResults($results): array
    {
        $chars = [];
        foreach ($results as $result) {
            $chars[] = strtoupper(substr((string) $result->getLastName(), 0, 1));
        }
        return $chars;
    }
}
