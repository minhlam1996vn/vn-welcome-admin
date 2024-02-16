<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Admin\ArticleService;
use App\Services\Admin\CategoryService;

class ArticleController extends Controller
{
    /**
     * The article service instance.
     *
     * @var ArticleService
     */
    protected $articleService;

    /**
     * The category service instance.
     *
     * @var CategoryService
     */
    protected $categoryService;

    /**
     * Constructor for ArticleController class.
     *
     * @param ArticleService $articleService The article service instance.
     * @param CategoryService $categoryService The category service instance.
     */
    public function __construct(
        ArticleService $articleService,
        CategoryService $categoryService
    ) {
        $this->articleService = $articleService;
        $this->categoryService = $categoryService;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request The HTTP request instance.
     * @return \Illuminate\View\View The view for listing articles.
     */
    public function index(Request $request)
    {
        $params = $request->all();
        $categories = $this->categoryService->getAllCategories();
        $articles = $this->articleService->getArticles($params);

        return view('admin.article.index', compact('params', 'categories', 'articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View The view for creating an article.
     */
    public function create()
    {
        $categories = $this->categoryService->getAllCategories();

        return view('admin.article.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request The HTTP request instance.
     * @return \Illuminate\Http\RedirectResponse The redirect response after storing the article.
     */
    public function store(Request $request)
    {
        dd($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param string $id The ID of the article to be displayed.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param string $id The ID of the article to be edited.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request The HTTP request instance.
     * @param string $id The ID of the article to be updated.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param string $id The ID of the article to be deleted.
     */
    public function destroy(string $id)
    {
        //
    }
}
