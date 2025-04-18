<?php

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

namespace DerMatthesFrauHofer\ExtExtendttaddress\Domain\Model;

use TYPO3\CMS\Extbase\Annotation as Extbase;
use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Persistence\Generic\LazyLoadingProxy;

/**
 * This model represents a category (for anything).
 */
class Category extends AbstractEntity
{
    #[Extbase\Validate(['validator' => 'NotEmpty'])]
    protected string $title = '';

    protected string $description = '';

    /**
     * @var Category
     */
    #[Extbase\ORM\Lazy]
    protected $parent;

    /**
     * Gets the title.
     *
     * @return string the title, might be empty
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * Sets the title.
     *
     * @param string $title the title to set, may be empty
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * Gets the description.
     *
     * @return string the description, might be empty
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * Sets the description.
     *
     * @param string $description the description to set, may be empty
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * Gets the parent category.
     *
     * @return Category the parent category
     */
    public function getParent(): Category
    {
        if ($this->parent instanceof LazyLoadingProxy) {
            $this->parent->_loadRealInstance();
        }
        return $this->parent;
    }

    /**
     * Sets the parent category.
     *
     * @param Category $parent the parent category
     */
    public function setParent(Category $parent): void
    {
        $this->parent = $parent;
    }
}
