<?php
defined('TYPO3') || die();

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
    'ExtExtendttaddress',
    'Extendttaddress',
    'Extend TtAddress'
);


// plugin signature: <extension key without underscores> '_' <plugin name in lowercase>
$pluginSignature = 'extextendttaddress_extendttaddress';
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue(
	$pluginSignature,
	// FlexForm configuration schema file
	'FILE:EXT:ext_extendttaddress/Configuration/FlexForms/Registration.xml'
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue(
// 'list_type' does not apply here
	'*',
	// FlexForm configuration schema file
	'FILE:EXT:ext_extendttaddress/Configuration/FlexForms/Registration.xml',
	// ctype
	'list'
);