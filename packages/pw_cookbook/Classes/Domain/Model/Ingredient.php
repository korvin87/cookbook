<?php

declare(strict_types=1);

namespace Pluswerk\PwCookbook\Domain\Model;


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
 * Ingredient
 */
class Ingredient extends AbstractEntity
{

    /**
     * name
     *
     * @var string
     */
    protected string $name = '';

    /**
     * volume
     *
     * @var float
     */
    protected float $volume = 0.0;

    /**
     * unit
     *
     * @var int
     */
    protected int $unit = 0;

    /**
     * Returns the name
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Sets the name
     *
     * @param string $name
     * @return void
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * Returns the unit
     *
     * @return int
     */
    public function getUnit(): int
    {
        return $this->unit;
    }

    /**
     * Sets the unit
     *
     * @param int $unit
     * @return void
     */
    public function setUnit(int $unit): void
    {
        $this->unit = $unit;
    }

    /**
     * Returns the volume
     *
     * @return float volume
     */
    public function getVolume(): float
    {
        return $this->volume;
    }

    /**
     * Sets the volume
     *
     * @param float $volume
     * @return void
     */
    public function setVolume(float $volume): void
    {
        $this->volume = $volume;
    }
}
