<?php

declare(strict_types=1);

/*
 * This file is part of the TYPO3 CMS project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */

namespace DerMatthesFrauHofer\ExtExtendttaddress\Domain\Repository;

use DerMatthesFrauHofer\ExtExtendttaddress\Domain\Model\Category;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Persistence\Generic\Typo3QuerySettings;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;
use TYPO3\CMS\Extbase\Persistence\Repository;

/**
 * Repository for Category models.
 * @method findByParent(Category $category)
 */
class CategoryRepository extends Repository
{
    public function initializeObject(): void
    {
        $querySettings = GeneralUtility::makeInstance(Typo3QuerySettings::class);
        $querySettings->setRespectStoragePage(false);
        $this->setDefaultQuerySettings($querySettings);
    }

    /**
     * @param $categories
     * @param $return
     */
    public function getSubCategories($categories, $return = null): ObjectStorage
    {
        if ($return === null) {
            $return = GeneralUtility::makeInstance(ObjectStorage::class);
        }
        foreach ($categories as $category) {
            $return->attach($category);
            $subCategories = $this->findByParent($category);
            $this->getSubCategories($subCategories, $return);
        }
        return $return;
    }
}
