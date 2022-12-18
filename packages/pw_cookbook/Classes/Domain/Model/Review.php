<?php

declare(strict_types=1);

namespace Pluswerk\PwCookbook\Domain\Model;

use DateTime;
use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;

/**
 * This file is part of the "Cookbook" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * (c) 2022 
 */

/**
 * Review
 */
class Review extends AbstractEntity
{

    /**
     * text
     *
     * @var string
     */
    protected string $text = '';

    /**
     * score
     *
     * @var int
     */
    protected int $score = 0;

    /**
     * date
     *
     * @var ?DateTime
     */
    protected ?DateTime $date = null;

    /**
     * recipe
     *
     * @var ?Recipe
     */
    protected ?Recipe $recipe = null;

    /**
     * Returns the text
     *
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }

    /**
     * Sets the text
     *
     * @param string $text
     * @return void
     */
    public function setText(string $text): void
    {
        $this->text = $text;
    }

    /**
     * Returns the score
     *
     * @return int
     */
    public function getScore(): int
    {
        return $this->score;
    }

    /**
     * Sets the score
     *
     * @param int $score
     * @return void
     */
    public function setScore(int $score): void
    {
        $this->score = $score;
    }

    /**
     * Returns the recipe
     *
     * @return ?Recipe
     */
    public function getRecipe(): ?Recipe
    {
        return $this->recipe;
    }

    /**
     * Sets the recipe
     *
     * @param Recipe $recipe
     * @return void
     */
    public function setRecipe(Recipe $recipe): void
    {
        $this->recipe = $recipe;
    }

    /**
     * Returns the date
     *
     * @return ?DateTime
     */
    public function getDate(): ?DateTime
    {
        return $this->date;
    }

    /**
     * Sets the date
     *
     * @param DateTime $date
     * @return void
     */
    public function setDate(DateTime $date): void
    {
        $this->date = $date;
    }
}
