<?php

declare(strict_types=1);

namespace Pluswerk\PwCookbook\Domain\Repository;

use TYPO3\CMS\Extbase\Persistence\Exception\InvalidQueryException;
use TYPO3\CMS\Extbase\Persistence\QueryResultInterface;
use TYPO3\CMS\Extbase\Persistence\Repository;

/**
 * This file is part of the "Cookbook" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * (c) 2022 
 */

/**
 * The repository for Recipes
 */
class RecipeRepository extends Repository
{

    /**
     * @param string $search
     * @param int $category
     * @throws InvalidQueryException
     * @return QueryResultInterface|array
     */
    public function searchRecipes(string $search = "", int $category = 0): QueryResultInterface|array
    {
        $query = $this->createQuery();
        $constraints = [];
        if (!empty($search)) {
            $constraints[] = $query->logicalOr(
            $query->like('title', '%' . $search . '%'),
            $query->like('short_description', '%' . $search . '%'),
            $query->like('description', '%' . $search . '%')
            );
        }
        if (!empty($category)) {
            $constraints[] = $query->contains('categories', $category);
        }
        if (!empty($constraints)) {
            $query->matching($query->logicalAnd($constraints));
        }
        return $query->execute();
    }
}
