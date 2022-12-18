<?php

declare(strict_types=1);

namespace Pluswerk\PwCookbook\Domain\Model;

use DateTime;
use Pluswerk\PwCookbook\Domain\Repository\UserRepository;
use Pluswerk\PwCookbook\Utility\UserUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Domain\Model\Category;
use TYPO3\CMS\Extbase\Domain\Model\FileReference;
use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
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
 * Recipe
 */
class Recipe extends AbstractEntity
{

    /**
     * title
     *
     * @var string
     */
    protected string $title = '';

    /**
     * shortDescription
     *
     * @var string
     */
    protected string $shortDescription = '';

    /**
     * description
     *
     * @var string
     */
    protected string $description = '';

    /**
     * image
     *
     * @var ?FileReference
     * @TYPO3\CMS\Extbase\Annotation\ORM\Cascade("remove")
     */
    protected ?FileReference $image = null;

    /**
     * time
     *
     * @var ?DateTime
     */
    protected ?DateTime $time = null;

    /**
     * ingredients
     *
     * @var ?ObjectStorage<Ingredient>
     * @TYPO3\CMS\Extbase\Annotation\ORM\Cascade("remove")
     */
    protected ?ObjectStorage $ingredients = null;

    /**
     * categories
     *
     * @var ?ObjectStorage<Category>
     * @TYPO3\CMS\Extbase\Annotation\ORM\Cascade("remove")
     */
    protected ?ObjectStorage $categories = null;

    /**
     * Returns the description
     *
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * Sets the description
     *
     * @param string $description
     * @return void
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * Returns the title
     *
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * Sets the title
     *
     * @param string $title
     * @return void
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * Returns the time
     *
     * @return ?DateTime
     */
    public function getTime(): ?DateTime
    {
        return $this->time;
    }

    /**
     * Sets the time
     *
     * @param DateTime $time
     * @return void
     */
    public function setTime(DateTime $time): void
    {
        $this->time = $time;
    }

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
        $this->ingredients = $this->ingredients ?: new ObjectStorage();
    }

    /**
     * Adds an Ingredient
     *
     * @param Ingredient $ingredient
     * @return void
     */
    public function addIngredient(Ingredient $ingredient): void
    {
        $this->ingredients->attach($ingredient);
    }

    /**
     * Removes an Ingredient
     *
     * @param Ingredient $ingredientToRemove The Ingredient to be removed
     * @return void
     */
    public function removeIngredient(Ingredient $ingredientToRemove): void
    {
        $this->ingredients->detach($ingredientToRemove);
    }

    /**
     * Returns the ingredients
     *
     * @return ?ObjectStorage<Ingredient>
     */
    public function getIngredients(): ?ObjectStorage
    {
        return $this->ingredients;
    }

    /**
     * Sets the ingredients
     *
     * @param ObjectStorage<Ingredient> $ingredients
     * @return void
     */
    public function setIngredients(ObjectStorage $ingredients): void
    {
        $this->ingredients = $ingredients;
    }

    /**
     * Returns the shortDescription
     *
     * @return string
     */
    public function getShortDescription(): string
    {
        return $this->shortDescription;
    }

    /**
     * Sets the shortDescription
     *
     * @param string $shortDescription
     * @return void
     */
    public function setShortDescription(string $shortDescription): void
    {
        $this->shortDescription = $shortDescription;
    }

    /**
     * Returns the image
     *
     * @return ?FileReference image
     */
    public function getImage(): ?FileReference
    {
        return $this->image;
    }

    /**
     * Sets the image
     *
     * @param FileReference $image
     * @return void
     */
    public function setImage(FileReference $image): void
    {
        $this->image = $image;
    }

    /**
     * @return ?ObjectStorage
     */
    public function getCategories(): ?ObjectStorage
    {
        return $this->categories;
    }

    /**
     * @param ?ObjectStorage $categories
     */
    public function setCategories(?ObjectStorage $categories): void
    {
        $this->categories = $categories;
    }

    /**
     * Returns info if recipe is favorite for current user
     *
     * @return bool
     */
    public function isFavorite(): bool
    {
        $userRepository = GeneralUtility::makeInstance(UserRepository::class);
        $userUtility = GeneralUtility::makeInstance(UserUtility::class, $userRepository);
        return $userUtility->isFavorite($this);
    }

    /**
     * Returns info if recipe is reviewed current user
     *
     * @return bool
     */
    public function isReviewed(): bool
    {
        $userRepository = GeneralUtility::makeInstance(UserRepository::class);
        $userUtility = GeneralUtility::makeInstance(UserUtility::class, $userRepository);
        return $userUtility->isReviewed($this);
    }
}
