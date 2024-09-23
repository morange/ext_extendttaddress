<?php

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Extbase\Utility\ExtensionUtility;

defined('TYPO3') || die();

ExtensionUtility::registerPlugin(
    'ExtExtendttaddress',
    'Extendttaddress',
    'Extend TtAddress'
);

// plugin signature: <extension key without underscores> '_' <plugin name in lowercase>
$pluginSignature = 'extextendttaddress_extendttaddress';
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
ExtensionManagementUtility::addPiFlexFormValue(
    $pluginSignature,
    // FlexForm configuration schema file
    'FILE:EXT:ext_extendttaddress/Configuration/FlexForms/Registration.xml'
);

ExtensionManagementUtility::addPiFlexFormValue(
    // 'list_type' does not apply here
    '*',
    // FlexForm configuration schema file
    'FILE:EXT:ext_extendttaddress/Configuration/FlexForms/Registration.xml',
    // ctype
    'list'
);
