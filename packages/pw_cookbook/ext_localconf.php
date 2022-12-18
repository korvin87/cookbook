<?php
defined('TYPO3') || die();

(static function() {
    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
        'PwCookbook',
        'Pi1',
        [
            \Pluswerk\PwCookbook\Controller\RecipeController::class => 'list, show, addFavoriteRecipe, removeFavoriteRecipe, addReview'
        ],
        // non-cacheable actions
        [
            \Pluswerk\PwCookbook\Controller\RecipeController::class => 'list, show, addFavoriteRecipe, removeFavoriteRecipe, addReview'
        ]
    );

    // wizards
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig(
        'mod {
            wizards.newContentElement.wizardItems.plugins {
                elements {
                    pi1 {
                        iconIdentifier = pw_cookbook-plugin-pi1
                        title = LLL:EXT:pw_cookbook/Resources/Private/Language/locallang_db.xlf:tx_pw_cookbook_pi1.name
                        description = LLL:EXT:pw_cookbook/Resources/Private/Language/locallang_db.xlf:tx_pw_cookbook_pi1.description
                        tt_content_defValues {
                            CType = list
                            list_type = pwcookbook_pi1
                        }
                    }
                }
                show = *
            }
       }'
    );
})();
