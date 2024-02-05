<?php

declare(strict_types=1);

namespace DerMatthesFrauHofer\ExtExtendttaddress\Controller;

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
        $this->view->assign(
			'extendTtAddresses',
			$extendTtAddresses
		);
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
        $this->view->assign('extendTtAddress', $extendTtAddress);
        return $this->htmlResponse();
    }

    /**
     * action atoz
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function atozAction(): \Psr\Http\Message\ResponseInterface
    {
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
