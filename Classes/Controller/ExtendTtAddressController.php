<?php

declare(strict_types=1);

namespace DerMatthesFrauHofer\ExtExtendttaddress\Controller;


use DerMatthesFrauHofer\ExtExtendttaddress\Domain\Model\ExtendTtAddress;
use DerMatthesFrauHofer\ExtExtendttaddress\Domain\Repository\CategoryRepository;
use DerMatthesFrauHofer\ExtExtendttaddress\Domain\Repository\ExtendTtAddressRepository;
use GeorgRinger\NumberedPagination\NumberedPagination;
use Psr\Http\Message\ResponseInterface;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Extbase\Mvc\Exception\NoSuchArgumentException;
use TYPO3\CMS\Extbase\Pagination\QueryResultPaginator;
use TYPO3\CMS\Extbase\Persistence\Exception\InvalidQueryException;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

/**
 * This file is part of the "Extend TtAddress" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * (c) 2024 Steffen Matthes <info@dermatthes-frauhofer.de>, Der Matthes und Frau Hofer
 */

/**
 * ExtendTtAddressController
 */
class ExtendTtAddressController extends ActionController
{

    /**
     * extendTtAddressRepository
     *
     * @var ExtendTtAddressRepository
     */
    protected ExtendTtAddressRepository $extendTtAddressRepository;

    /**
     * categoryRepository
     *
     * @var CategoryRepository
     */
    protected CategoryRepository $categoryRepository;

    public function __construct(
        ExtendTtAddressRepository $extendTtAddressRepository,
        CategoryRepository        $categoryRepository
    )
    {
        $this->extendTtAddressRepository = $extendTtAddressRepository;
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * action list
     *
     * @return ResponseInterface
     * @throws InvalidQueryException
     * @throws NoSuchArgumentException
     */
    public function listAction(): ResponseInterface
    {
        $atozvalue = ($this->request->hasArgument('atoz')) ? $this->request->getArgument('atoz') : '';

        if ($this->settings['categories'] !== '') {
            $categoryUids = GeneralUtility::intExplode(',', $this->settings['categories']);
            $categoryConjunction = (string)$this->settings['categoryConjunction'];
            $includeSubCategories = (bool)$this->settings['includeSubCategories'];

            $categories = GeneralUtility::makeInstance(ObjectStorage::class);
            foreach ($categoryUids as $categoryUid) {
                $categoryObject = $this->categoryRepository->findByUid($categoryUid);
                $categories->attach($categoryObject);
            }

            $subCategories = null;
            if ($includeSubCategories) {
                $subCategories = $this->categoryRepository->getSubCategories($categories);
            }

            $extendTtAddresses = $this->extendTtAddressRepository->findByCategories($categories, $categoryConjunction, $subCategories, $atozvalue);
            $firstLettersOfLastName = $this->extendTtAddressRepository->getFirstLettersOfLastNameByCategory($categories, $categoryConjunction, $subCategories);
        } else {
            $extendTtAddresses = $this->extendTtAddressRepository->findAll($atozvalue);
            $firstLettersOfLastName = $this->extendTtAddressRepository->getFirstLettersOfLastName();
        }

        $itemsPerPage = $this->settings['list']['paginate']['itemsPerPage'];
        $maximumLinks = $this->settings['list']['paginate']['maximumLinks'];

        $currentPage = $this->request->hasArgument('currentPage') ? (int)$this->request->getArgument('currentPage') : 1;
        $paginator = GeneralUtility::makeInstance(QueryResultPaginator::class, $extendTtAddresses, $currentPage, $itemsPerPage);
        $pagination = GeneralUtility::makeInstance(NumberedPagination::class, $paginator, $maximumLinks);

        $atoz = [];
        foreach (range("A", "Z") as $char) {
            $atoz[] = [
                "character" => $char,
                "active" => (in_array($char, $firstLettersOfLastName, true))
            ];
        }

        $this->view->assignMultiple([
            'atozvalue' => $atozvalue,
            'atoz' => $atoz,
            'pagination' => [
                'paginator' => $paginator,
                'pagination' => $pagination,
            ]
        ]);

        return $this->htmlResponse();
    }

    /**
     * action show
     *
     * @param ExtendTtAddress $extendTtAddress
     * @return ResponseInterface
     */
    public function showAction(ExtendTtAddress $extendTtAddress): ResponseInterface
    {
        $this->view->assign(
            'extendTtAddress',
            $extendTtAddress
        );
        return $this->htmlResponse();
    }

    /**
     * action atoz
     *
     * @return ResponseInterface
     */
    public function atozAction(): ResponseInterface
    {
        $extendTtAddresses = $this->extendTtAddressRepository->findByLastName('Ahrens');
        $this->view->assign(
            'extendTtAddresses',
            $extendTtAddresses
        );
        return $this->htmlResponse();
    }

    /**
     * action pulldown
     *
     * @return ResponseInterface
     */
    public function pulldownAction(): ResponseInterface
    {
        return $this->htmlResponse();
    }
}
