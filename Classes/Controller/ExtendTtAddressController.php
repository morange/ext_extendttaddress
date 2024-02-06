<?php

declare(strict_types=1);

namespace DerMatthesFrauHofer\ExtExtendttaddress\Controller;


use TYPO3\CMS\Core\Pagination\ArrayPaginator;
use TYPO3\CMS\Core\Pagination\PaginatorInterface;
use TYPO3\CMS\Core\Utility\DebugUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Pagination\QueryResultPaginator;
use GeorgRinger\NumberedPagination\NumberedPagination;

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
class ExtendTtAddressController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{

    /**
     * extendTtAddressRepository
     *
     * @var \DerMatthesFrauHofer\ExtExtendttaddress\Domain\Repository\ExtendTtAddressRepository
     */
    protected $extendTtAddressRepository = null;

    /**
     * @param \DerMatthesFrauHofer\ExtExtendttaddress\Domain\Repository\ExtendTtAddressRepository $extendTtAddressRepository
     */
    public function injectExtendTtAddressRepository(\DerMatthesFrauHofer\ExtExtendttaddress\Domain\Repository\ExtendTtAddressRepository $extendTtAddressRepository)
    {
        $this->extendTtAddressRepository = $extendTtAddressRepository;
    }

    /**
     * action list
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function listAction(): \Psr\Http\Message\ResponseInterface
    {
        $extendTtAddresses = $this->extendTtAddressRepository->findAll();

		//DebugUtility::debug($this->settings['list']['paginate']['itemsPerPage']);
		$itemsPerPage = $this->settings['list']['paginate']['itemsPerPage'];
		$maximumLinks = $this->settings['list']['paginate']['maximumLinks'];

		$currentPage = $this->request->hasArgument('currentPage') ? (int)$this->request->getArgument('currentPage') : 1;
		$paginator = GeneralUtility::makeInstance(QueryResultPaginator::class, $extendTtAddresses, $currentPage, $itemsPerPage);
		$pagination = GeneralUtility::makeInstance(NumberedPagination::class, $paginator, $maximumLinks);

		//$res = $this->extendTtAddressRepository->

//		$atoz = [];
//		foreach (range("A", "Z") as $char) {
//			$atoz[] = ["character" => $char, "active" => (array_search($char, $res) !== false)];
//		}

		$this->view->assignMultiple([
			'extendTtAddresses' => $extendTtAddresses,
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
     * @param \DerMatthesFrauHofer\ExtExtendttaddress\Domain\Model\ExtendTtAddress $extendTtAddress
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function showAction(\DerMatthesFrauHofer\ExtExtendttaddress\Domain\Model\ExtendTtAddress $extendTtAddress): \Psr\Http\Message\ResponseInterface
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
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function atozAction(): \Psr\Http\Message\ResponseInterface
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
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function pulldownAction(): \Psr\Http\Message\ResponseInterface
    {
        return $this->htmlResponse();
    }
}
