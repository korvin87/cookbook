<?php

declare(strict_types=1);

namespace Pluswerk\PwCookbook\Controller;

use DateTime;
use GeorgRinger\NumberedPagination\NumberedPagination;
use Pluswerk\PwCookbook\Domain\Model\Recipe;
use Pluswerk\PwCookbook\Domain\Model\Review;
use Pluswerk\PwCookbook\Domain\Repository\RecipeRepository;
use Pluswerk\PwCookbook\Domain\Repository\ReviewRepository;
use Pluswerk\PwCookbook\Exception\UserNotLoggedInException;
use Pluswerk\PwCookbook\Utility\UserUtility;
use Psr\Http\Message\ResponseInterface;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Domain\Repository\CategoryRepository;
use TYPO3\CMS\Extbase\Http\ForwardResponse;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Extbase\Pagination\QueryResultPaginator;
use TYPO3\CMS\Extbase\Persistence\Exception\InvalidQueryException;
use TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager;

/**
 * This file is part of the "Cookbook" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * (c) 2022
 */

/**
 * RecipeController
 */
class RecipeController extends ActionController
{

    /**
     * recipeRepository
     *
     * @var ?RecipeRepository
     */
    protected ?RecipeRepository $recipeRepository = null;

    /**
     * reviewRepository
     *
     * @var ?ReviewRepository
     */
    protected ?ReviewRepository $reviewRepository = null;

    /**
     * CategoryRepository
     *
     * @var ?CategoryRepository
     */
    protected ?CategoryRepository $categoryRepository = null;

    /**
     * userUtility
     *
     * @var ?UserUtility
     */
    protected ?UserUtility $userUtility = null;

    /**
     * @param RecipeRepository $recipeRepository
     */
    public function injectRecipeRepository(RecipeRepository $recipeRepository)
    {
        $this->recipeRepository = $recipeRepository;
    }

    /**
     * @param ReviewRepository $reviewRepository
     */
    public function injectReviewRepository(ReviewRepository $reviewRepository)
    {
        $this->reviewRepository = $reviewRepository;
    }

    /**
     * @param CategoryRepository $categoryRepository
     */
    public function injectCategoryRepository(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * @param UserUtility $userUtility
     */
    public function injectUserUtility(UserUtility $userUtility)
    {
        $this->userUtility = $userUtility;
    }

    /**
     * action list
     *
     * @param string $search
     * @param int $category
     * @return ResponseInterface
     * @throws InvalidQueryException
     */
    public function listAction(string $search = "", int $category = 0): ResponseInterface
    {
        $recipes = $this->recipeRepository->searchRecipes($search, $category);
        $itemsPerPage = 6;
        $maximumLinks = 15;
        $currentPage = $this->request->hasArgument('currentPage') ? (int)$this->request->getArgument('currentPage') : 1;
        $paginator = new QueryResultPaginator($recipes, $currentPage, $itemsPerPage);
        $pagination = new NumberedPagination($paginator, $maximumLinks);
        $this->view->assign(
            'pagination',
            [
                'paginator' => $paginator,
                'pagination' => $pagination
            ]
        );
        $categories = $this->categoryRepository->findByParent($this->settings['parentCategoryId']);
        $this->view->assign('categories', $categories);
        $this->view->assign('search', $search);
        $this->view->assign('category', $category);
        return $this->htmlResponse();
    }

    /**
     * action show
     *
     * @param Recipe $recipe
     * @return ResponseInterface
     */
    public function showAction(Recipe $recipe): ResponseInterface
    {
        $reviews = $this->reviewRepository->findByRecipe($recipe);

        $this->view->assign('recipe', $recipe);
        $this->view->assign('reviews', $reviews);
        return $this->htmlResponse();
    }

    /**
     * action addFavoriteRecipe
     *
     * @param Recipe $recipe
     * @return ForwardResponse
     * @throws UserNotLoggedInException
     */
    public function addFavoriteRecipeAction(Recipe $recipe): ForwardResponse
    {
        $this->userUtility->addRecipe($recipe);
        return (new ForwardResponse('show'))->withArguments(['recipe' => $recipe]);
    }

    /**
     * action removeFavoriteRecipe
     *
     * @param Recipe $recipe
     * @return ForwardResponse
     * @throws UserNotLoggedInException
     */
    public function removeFavoriteRecipeAction(Recipe $recipe): ForwardResponse
    {
        $this->userUtility->removeRecipe($recipe);
        return (new ForwardResponse('show'))->withArguments(['recipe' => $recipe]);
    }

    /**
     * action addReview
     *
     * @return ResponseInterface
     */
    public function addReviewAction(Review $newReview): ResponseInterface
    {
        $recipe = $newReview->getRecipe();
        if (!$recipe->isReviewed()) {
            $date = new DateTime('now');
            $newReview->setDate($date);
            $this->userUtility->addReview($newReview);
            $persistenceManager = GeneralUtility::makeInstance(PersistenceManager::class);
            $persistenceManager->persistAll();
        }
        return (new ForwardResponse('show'))->withArguments(['recipe' => $newReview->getRecipe()]);
    }
}
