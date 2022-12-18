<?php
defined('TYPO3') || die();

(static function() {
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_pwcookbook_domain_model_recipe', 'EXT:pw_cookbook/Resources/Private/Language/locallang_csh_tx_pwcookbook_domain_model_recipe.xlf');
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_pwcookbook_domain_model_recipe');

    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_pwcookbook_domain_model_review', 'EXT:pw_cookbook/Resources/Private/Language/locallang_csh_tx_pwcookbook_domain_model_review.xlf');
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_pwcookbook_domain_model_review');

    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_pwcookbook_domain_model_ingredient', 'EXT:pw_cookbook/Resources/Private/Language/locallang_csh_tx_pwcookbook_domain_model_ingredient.xlf');
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_pwcookbook_domain_model_ingredient');
})();
