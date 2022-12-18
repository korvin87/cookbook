<?php
defined('TYPO3') || die();

if (!isset($GLOBALS['TCA']['fe_users']['ctrl']['type'])) {
    // no type field defined, so we define it here. This will only happen the first time the extension is installed!!
    $GLOBALS['TCA']['fe_users']['ctrl']['type'] = 'tx_extbase_type';
    $tempColumnstx_pwcookbook_fe_users = [];
    $tempColumnstx_pwcookbook_fe_users[$GLOBALS['TCA']['fe_users']['ctrl']['type']] = [
        'exclude' => true,
        'label' => 'LLL:EXT:pw_cookbook/Resources/Private/Language/locallang_db.xlf:tx_pwcookbook.tx_extbase_type',
        'config' => [
            'type' => 'select',
            'renderType' => 'selectSingle',
            'items' => [
                ['', ''],
                ['User', 'Tx_PwCookbook_User']
            ],
            'default' => 'Tx_PwCookbook_User',
            'size' => 1,
            'maxitems' => 1,
        ]
    ];
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('fe_users', $tempColumnstx_pwcookbook_fe_users);
}

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes(
    'fe_users',
    $GLOBALS['TCA']['fe_users']['ctrl']['type'],
    '',
    'after:' . $GLOBALS['TCA']['fe_users']['ctrl']['label']
);

$tmp_pw_cookbook_columns = [

    'favorite_recipes' => [
        'exclude' => true,
        'label' => 'LLL:EXT:pw_cookbook/Resources/Private/Language/locallang_db.xlf:tx_pwcookbook_domain_model_user.favorite_recipes',
        'config' => [
            'type' => 'select',
            'renderType' => 'selectMultipleSideBySide',
            'foreign_table' => 'tx_pwcookbook_domain_model_recipe',
            'MM' => 'tx_pwcookbook_user_recipe_mm',
            'size' => 10,
            'autoSizeMax' => 30,
            'maxitems' => 9999,
            'multiple' => 0,
            'fieldControl' => [
                'editPopup' => [
                    'disabled' => false,
                ],
                'addRecord' => [
                    'disabled' => false,
                ],
                'listModule' => [
                    'disabled' => true,
                ],
            ],
        ],
        
    ],
    'reviews' => [
        'exclude' => true,
        'label' => 'LLL:EXT:pw_cookbook/Resources/Private/Language/locallang_db.xlf:tx_pwcookbook_domain_model_user.reviews',
        'config' => [
            'type' => 'select',
            'renderType' => 'selectMultipleSideBySide',
            'foreign_table' => 'tx_pwcookbook_domain_model_review',
            'MM' => 'tx_pwcookbook_user_review_mm',
            'size' => 10,
            'autoSizeMax' => 30,
            'maxitems' => 9999,
            'multiple' => 0,
            'fieldControl' => [
                'editPopup' => [
                    'disabled' => false,
                ],
                'addRecord' => [
                    'disabled' => false,
                ],
                'listModule' => [
                    'disabled' => true,
                ],
            ],
        ],
        
    ],

];

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('fe_users', $tmp_pw_cookbook_columns);

// inherit and extend the show items from the parent class
if (isset($GLOBALS['TCA']['fe_users']['types']['0']['showitem'])) {
    $GLOBALS['TCA']['fe_users']['types']['Tx_PwCookbook_User']['showitem'] = $GLOBALS['TCA']['fe_users']['types']['0']['showitem'];
} elseif (is_array($GLOBALS['TCA']['fe_users']['types'])) {
    // use first entry in types array
    $fe_users_type_definition = reset($GLOBALS['TCA']['fe_users']['types']);
    $GLOBALS['TCA']['fe_users']['types']['Tx_PwCookbook_User']['showitem'] = $fe_users_type_definition['showitem'];
} else {
    $GLOBALS['TCA']['fe_users']['types']['Tx_PwCookbook_User']['showitem'] = '';
}
$GLOBALS['TCA']['fe_users']['types']['Tx_PwCookbook_User']['showitem'] .= ',--div--;LLL:EXT:pw_cookbook/Resources/Private/Language/locallang_db.xlf:tx_pwcookbook_domain_model_user,';
$GLOBALS['TCA']['fe_users']['types']['Tx_PwCookbook_User']['showitem'] .= 'favorite_recipes, reviews';

$GLOBALS['TCA']['fe_users']['columns'][$GLOBALS['TCA']['fe_users']['ctrl']['type']]['config']['items'][] = [
    'LLL:EXT:pw_cookbook/Resources/Private/Language/locallang_db.xlf:fe_users.tx_extbase_type.Tx_PwCookbook_User',
    'Tx_PwCookbook_User'
];
