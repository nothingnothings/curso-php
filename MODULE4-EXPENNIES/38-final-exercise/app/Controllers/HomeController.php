<?php

declare(strict_types=1);

namespace App\Controllers;

use App\ResponseFormatter;
use App\Services\CategoryService;
use App\Services\TransactionService;
use DateTime;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\SimpleCache\CacheInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\Twig;

class HomeController
{
    public function __construct(
        private readonly Twig $twig,
        private readonly CacheInterface $cache,
        private readonly TransactionService $transactionService,
        private readonly CategoryService $categoryService,
        private readonly ResponseFormatter $responseFormatter
    ) {}

    public function index(Request $request, Response $response): Response
    {
        // Get the user's id:
        $userId = $request->getAttribute('user')->getId();

        $startDate = DateTime::createFromFormat('Y-m-d', date('Y-m-01'));
        $endDate   = new DateTime('now');
        $totals = $this->transactionService->getTotals($startDate, $endDate, $userId);
        $recentTransactions = $this->transactionService->getRecentTransactions(10);
        $topSpendingCategories = $this->categoryService->getTopSpendingCategories(4);

        return $this->twig->render($response, 'dashboard.twig', [
            'totals' => $totals,
            'transactions' => $recentTransactions,
            'topSpendingCategories' => $topSpendingCategories,
        ]);
    }


    public function getYearToDateStatistics(Request $request, Response $response): Response
    {   
        // Get the user's id:
        $userId = $request->getAttribute('user')->getId();

        $data = $this->transactionService->getMonthlySummary((int) date('Y'), $userId);

        return $this->responseFormatter->asJson($response, $data);
    }
}