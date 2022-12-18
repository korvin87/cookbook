<?php

declare(strict_types=1);

namespace Pluswerk\PwCookbook\Domain\Model;

use TYPO3\CMS\Extbase\Domain\Model\FrontendUser;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

/**
 * This file is part of the "Cookbook" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * (c) 2022 
 */

/**
 * User
 */
class User extends FrontendUser
{

    /**
     * favoriteRecipes
     *
     * @var ?ObjectStorage<Recipe>
     */
    protected ?ObjectStorage $favoriteRecipes = null;

    /**
     * reviews
     *
     * @var ?ObjectStorage<Review>
     */
    protected ?ObjectStorage $reviews = null;

    /**
     * __construct
     */
    public function __construct()
    {

        // Do not remove the next line: It would break the functionality
        $this->initializeObject();
    }

    /**
     * Initializes all ObjectStorage properties when model is reconstructed from DB (where __construct is not called)
     * Do not modify this method!
     * It will be rewritten on each save in the extension builder
     * You may modify the constructor of this class instead
     *
     * @return void
     */
    public function initializeObject(): void
    {
        $this->favoriteRecipes = $this->favoriteRecipes ?: new ObjectStorage();
        $this->reviews = $this->reviews ?: new ObjectStorage();
    }

    /**
     * Adds a Recipe
     *
     * @param Recipe $favoriteRecipe
     * @return void
     */
    public function addFavoriteRecipe(Recipe $favoriteRecipe): void
    {
        $this->favoriteRecipes->attach($favoriteRecipe);
    }

    /**
     * Removes a Recipe
     *
     * @param Recipe $favoriteRecipeToRemove The Recipe to be removed
     * @return void
     */
    public function removeFavoriteRecipe(Recipe $favoriteRecipeToRemove): void
    {
        $this->favoriteRecipes->detach($favoriteRecipeToRemove);
    }

    /**
     * Returns the favoriteRecipes
     *
     * @return ?ObjectStorage<Recipe>
     */
    public function getFavoriteRecipes(): ?ObjectStorage
    {
        return $this->favoriteRecipes;
    }

    /**
     * Sets the favoriteRecipes
     *
     * @param ?ObjectStorage<Recipe> $favoriteRecipes
     * @return void
     */
    public function setFavoriteRecipes(?ObjectStorage $favoriteRecipes): void
    {
        $this->favoriteRecipes = $favoriteRecipes;
    }

    /**
     * Adds a Review
     *
     * @param Review $review
     * @return void
     */
    public function addReview(Review $review): void
    {
        $this->reviews->attach($review);
    }

    /**
     * Removes a Review
     *
     * @param Review $reviewToRemove The Review to be removed
     * @return void
     */
    public function removeReview(Review $reviewToRemove): void
    {
        $this->reviews->detach($reviewToRemove);
    }

    /**
     * Returns the reviews
     *
     * @return ?ObjectStorage<Review>
     */
    public function getReviews(): ?ObjectStorage
    {
        return $this->reviews;
    }

    /**
     * Sets the reviews
     *
     * @param ObjectStorage<Review> $reviews
     * @return void
     */
    public function setReviews(ObjectStorage $reviews): void
    {
        $this->reviews = $reviews;
    }
}
