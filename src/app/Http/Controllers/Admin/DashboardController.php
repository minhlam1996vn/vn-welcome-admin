<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\ArticleService;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * The article service instance.
     *
     * @var ArticleService
     */
    protected $articleService;

    /**
     * Constructor for ArticleController class.
     *
     * @param ArticleService $articleService The article service instance.
     */
    public function __construct(
        ArticleService $articleService,
    ) {
        $this->articleService = $articleService;
    }

    /**
     * Display the admin dashboard.
     *
     * @return \Illuminate\View\View The view for the admin dashboard.
     */
    public function dashboard()
    {
        $articleCount = $this->articleService->getCountArticle();

        return view('admin.dashboard', compact('articleCount'));
    }
}
