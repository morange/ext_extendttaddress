<?php
defined('TYPO3') || die();

/*
if (!isset($GLOBALS['TCA']['tt_address']['ctrl']['type'])) {
    // no type field defined, so we define it here. This will only happen the first time the extension is installed!!
    $GLOBALS['TCA']['tt_address']['ctrl']['type'] = 'tx_extbase_type';
    $tempColumnstx_extextendttaddress_tt_address = [];
    $tempColumnstx_extextendttaddress_tt_address[$GLOBALS['TCA']['tt_address']['ctrl']['type']] = [
        'exclude' => true,
        'label' => 'LLL:EXT:ext_extendttaddress/Resources/Private/Language/locallang_db.xlf:tx_extextendttaddress.tx_extbase_type',
        'config' => [
            'type' => 'select',
            'renderType' => 'selectSingle',
            'items' => [
                ['', ''],
                ['ExtendTtAddress', 'Tx_ExtExtendttaddress_ExtendTtAddress']
            ],
            'default' => 'Tx_ExtExtendttaddress_ExtendTtAddress',
            'size' => 1,
            'maxitems' => 1,
        ]
    ];
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('tt_address', $tempColumnstx_extextendttaddress_tt_address);
}

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes(
    'tt_address',
    $GLOBALS['TCA']['tt_address']['ctrl']['type'],
    '',
    'after:' . $GLOBALS['TCA']['tt_address']['ctrl']['label']
);
*/
$tmp_ext_extendttaddress_columns = [

    'tx_birthday' => [
        'exclude' => true,
        'label' => 'LLL:EXT:ext_extendttaddress/Resources/Private/Language/locallang_db.xlf:tx_extextendttaddress_domain_model_extendttaddress.tx_birthday',
        // 'description' => 'LLL:EXT:ext_extendttaddress/Resources/Private/Language/locallang_db.xlf:tx_extextendttaddress_domain_model_extendttaddress.tx_birthday.description',
        'config' => [
            'type' => 'input',
            'size' => 30,
            'eval' => 'trim',
            'default' => null
        ],
    ],
    'tx_deathday' => [
        'exclude' => true,
        'label' => 'LLL:EXT:ext_extendttaddress/Resources/Private/Language/locallang_db.xlf:tx_extextendttaddress_domain_model_extendttaddress.tx_deathday',
        // 'description' => 'LLL:EXT:ext_extendttaddress/Resources/Private/Language/locallang_db.xlf:tx_extextendttaddress_domain_model_extendttaddress.tx_deathday.description',
        'config' => [
            'type' => 'input',
            'size' => 30,
            'eval' => 'trim',
            'default' => null
        ],
    ],

];

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('tt_address', $tmp_ext_extendttaddress_columns);
/*
// inherit and extend the show items from the parent class
if (isset($GLOBALS['TCA']['tt_address']['types']['0']['showitem'])) {
    $GLOBALS['TCA']['tt_address']['types']['Tx_ExtExtendttaddress_ExtendTtAddress']['showitem'] = $GLOBALS['TCA']['tt_address']['types']['0']['showitem'];
} elseif (is_array($GLOBALS['TCA']['tt_address']['types'])) {
    // use first entry in types array
    $tt_address_type_definition = reset($GLOBALS['TCA']['tt_address']['types']);
    $GLOBALS['TCA']['tt_address']['types']['Tx_ExtExtendttaddress_ExtendTtAddress']['showitem'] = $tt_address_type_definition['showitem'];
} else {
    $GLOBALS['TCA']['tt_address']['types']['Tx_ExtExtendttaddress_ExtendTtAddress']['showitem'] = '';
}
$GLOBALS['TCA']['tt_address']['types']['Tx_ExtExtendttaddress_ExtendTtAddress']['showitem'] .= ',--div--;LLL:EXT:ext_extendttaddress/Resources/Private/Language/locallang_db.xlf:tx_extextendttaddress_domain_model_extendttaddress,';
$GLOBALS['TCA']['tt_address']['types']['Tx_ExtExtendttaddress_ExtendTtAddress']['showitem'] .= 'tx_birthday, tx_deathday';

$GLOBALS['TCA']['tt_address']['columns'][$GLOBALS['TCA']['tt_address']['ctrl']['type']]['config']['items'][] = [
    'LLL:EXT:ext_extendttaddress/Resources/Private/Language/locallang_db.xlf:tt_address.tx_extbase_type.Tx_ExtExtendttaddress_ExtendTtAddress',
    'Tx_ExtExtendttaddress_ExtendTtAddress'
];
*/

// Add new fields to pages:
// \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('tt_address', $fields);

// Make fields visible in the TCEforms:
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes(
	'tt_address', // Table name
	'--palette--;LLL:EXT:ext_extendttaddress/Resources/Private/Language/locallang_db.xlf:tx_extextendttaddress_domain_model_extendttaddress;name',
	// Field list to add
	'1', // List of specific types to add the field list to. (If empty, all type entries are affected)
	'after:name' // Insert fields before (default) or after one, or replace a field
);

// Add the new palette:
$GLOBALS['TCA']['tt_address']['palettes']['name'] = [
	'showitem' =>  'gender, title, title_suffix,--linebreak--, first_name, middle_name, last_name,--linebreak--,name, tx_birthday, tx_deathday, --linebreak--,slug'
];
