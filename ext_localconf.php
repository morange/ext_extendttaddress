<?php
defined('TYPO3') || die();

(static function() {
    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
        'ExtExtendttaddress',
        'Extendttaddress',
        [
            \DerMatthesFrauHofer\ExtExtendttaddress\Controller\ExtendTtAddressController::class => 'list, show, atoz, pulldown'
        ],
        // non-cacheable actions
        [
            \DerMatthesFrauHofer\ExtExtendttaddress\Controller\ExtendTtAddressController::class => ''
        ]
    );

    // wizards
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig(
        'mod {
            wizards.newContentElement.wizardItems.plugins {
                elements {
                    extendttaddress {
                        iconIdentifier = ext_extendttaddress-plugin-extendttaddress
                        title = LLL:EXT:ext_extendttaddress/Resources/Private/Language/locallang_db.xlf:tx_ext_extendttaddress_extendttaddress.name
                        description = LLL:EXT:ext_extendttaddress/Resources/Private/Language/locallang_db.xlf:tx_ext_extendttaddress_extendttaddress.description
                        tt_content_defValues {
                            CType = list
                            list_type = extextendttaddress_extendttaddress
                        }
                    }
                }
                show = *
            }
       }'
    );
})();
