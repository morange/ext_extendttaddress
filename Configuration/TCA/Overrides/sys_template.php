<?php

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

defined('TYPO3') || die();

ExtensionManagementUtility::addStaticFile(
    'ext_extendttaddress',
    'Configuration/TypoScript',
    'Extend TtAddress'
);
