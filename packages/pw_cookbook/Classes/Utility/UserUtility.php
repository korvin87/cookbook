<?php

declare(strict_types=1);

namespace Pluswerk\PwCookbook\Utility;

use Pluswerk\PwCookbook\Domain\Model\Recipe;
use Pluswerk\PwCookbook\Domain\Model\Review;
use Pluswerk\PwCookbook\Domain\Model\User;
use TYPO3\CMS\Core\Context\Context;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Persistence\Exception\IllegalObjectTypeException;
use TYPO3\CMS\Extbase\Persistence\Exception\UnknownObjectException;
use TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager;
use Pluswerk\PwCookbook\Domain\Repository\UserRepository;
use Pluswerk\PwCookbook\Exception\UserNotLoggedInException;


/**
 * This file is part of the "Cookbook" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * (c) 2022 
 */

/**
 * UserUtility
 */
class UserUtility
{

    /**
     * userRepository
     *
     * @var ?UserRepository
     */
    protected ?UserRepository $userRepository = null;

    /**
     * user
     *
     * @var ?User;
     */
    protected ?User $user = null;

    public function __construct(UserRepository $userRepository) {
        $this->userRepository = $userRepository;

        $context = GeneralUtility::makeInstance(Context::class);
        $userIsLoggedIn = $context->getPropertyFromAspect('frontend.user', 'isLoggedIn');

        if ($userIsLoggedIn) {
            $userId = $context->getPropertyFromAspect('frontend.user', 'id');
            $this->user = $this->userRepository->findByUid($userId);
        }
        
    }

    /**
     * Add recipe to user favorite recipes list
     *
     * @param Recipe $recipe
     * @return void
     * @throws UserNotLoggedInException
     * @throws IllegalObjectTypeException
     * @throws UnknownObjectException
     *
     */
    public function addRecipe(Recipe $recipe):void {
        
        if (empty($this->user)) {
            throw new UserNotLoggedInException();
        }
        $this->user->addFavoriteRecipe($recipe);
        $this->userRepository->update($this->user);

        $persistenceManager = GeneralUtility::makeInstance(PersistenceManager::class);
        $persistenceManager->persistAll();
        
    }

    /**
     * Remove recipe from user favorite recipes list
     *
     * @param Recipe $recipe
     * @return void
     * @throws UserNotLoggedInException
     * @throws IllegalObjectTypeException
     * @throws UnknownObjectException
     */
    public function removeRecipe(Recipe $recipe): void {
        
        if (empty($this->user)) {
            throw new UserNotLoggedInException();
        }
        $this->user->removeFavoriteRecipe($recipe);
        $this->userRepository->update($this->user);

        $persistenceManager = GeneralUtility::makeInstance(PersistenceManager::class);
        $persistenceManager->persistAll();
        
    }

    /**
     * Add user review
     *
     * @param Review $review
     * @return void
     * @throws UserNotLoggedInException
     * @throws IllegalObjectTypeException
     * @throws UnknownObjectException
     *
     */
    public function addReview(Review $review):void {

        if (empty($this->user)) {
            throw new UserNotLoggedInException();
        }
        $this->user->addReview($review);
        $this->userRepository->update($this->user);

        $persistenceManager = GeneralUtility::makeInstance(PersistenceManager::class);
        $persistenceManager->persistAll();

    }

    /**
     * Returns info if given recipe is in list of favorite recipes
     *
     * @param Recipe $recipe
     * @return bool
     */
    public function isFavorite(Recipe $recipe): bool
    {
        if (empty($this->user)) {
            return false;
        }

        $recipes = $this->user->getFavoriteRecipes();
        if (empty($recipes)) {
            return false;
        }

        foreach($recipes as $item) {
            if ($item->getUid() == $recipe->getUid()) {
                return true;
            }
        }

        return false;
    }

    /**
     * Returns info if given recipe was already reviewd by user
     *
     * @param Recipe $recipe
     * @return bool
     */
    public function isReviewed(Recipe $recipe): bool
    {
        if (empty($this->user)) {
            return false;
        }

        $reviews = $this->user->getReviews();
        if (empty($reviews)) {
            return false;
        }

        foreach($reviews as $item) {
            if ($item->getRecipe()->getUid() == $recipe->getUid()) {
                return true;
            }
        }

        return false;
    }

}
