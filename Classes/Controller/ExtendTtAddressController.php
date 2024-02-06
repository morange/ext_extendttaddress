<?php

declare(strict_types=1);

namespace DerMatthesFrauHofer\ExtExtendttaddress\Controller;


use DerMatthesFrauHofer\ExtExtendttaddress\Domain\Model\ExtendTtAddress;
use DerMatthesFrauHofer\ExtExtendttaddress\Domain\Repository\ExtendTtAddressRepository;
use GeorgRinger\NumberedPagination\NumberedPagination;
use Psr\Http\Message\ResponseInterface;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Extbase\Pagination\QueryResultPaginator;

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
    protected $extendTtAddressRepository = null;

    /**
     * @param ExtendTtAddressRepository $extendTtAddressRepository
     */
    public function injectExtendTtAddressRepository(ExtendTtAddressRepository $extendTtAddressRepository)
    {
        $this->extendTtAddressRepository = $extendTtAddressRepository;
    }

    /**
     * action list
     *
     * @return ResponseInterface
     */
    public function listAction(): ResponseInterface
    {
        $extendTtAddresses = $this->extendTtAddressRepository->findAll();

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
