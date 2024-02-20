<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Admin\ArticleService;
use App\Services\Admin\CategoryService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

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
        // Prepare data for creating a new article
        $articleCreate = [
            'user_id' => Auth::guard('admin')->id(),
            'article_title' => $request->article_title,
            'article_slug' => Str::slug($request->article_title),
            'article_description' => $request->article_description,
            'article_keywords' => $request->article_keywords,
            'article_content' => $request->article_content,
            'category_id' => $request->category_id,
            'article_thumbnail' => 'https://placehold.jp/1280x720.png',
            'publication_date' => $request->is_public ? Carbon::now() : null,
        ];

        // Check if an article thumbnail is provided in the request
        if ($request->article_thumbnail) {
            $articleThumbnail = $this->articleService->uploadThumbnailArticle($request->article_thumbnail);

            $articleCreate['article_thumbnail'] = $articleThumbnail;
        }

        // Attempt to create the article and redirect based on the result
        if ($this->articleService->createArticle($articleCreate)) {
            return redirect()->route('admin.article.index')->with('success', 'Thêm bài viết thành công');
        }

        return redirect()->back()->with('error', 'Có lỗi xảy ra');
    }

    /**
     * Display the specified resource.
     *
     * @param string $id The ID of the article to be displayed.
     */
    public function show(string $id)
    {
        Carbon::setLocale('vi');

        $article = $this->articleService->getArticle($id);
        $articlePublicationDate = ucfirst(Carbon::parse($article->publication_date)->isoFormat('dddd, DD/MM/YYYY | HH:mm [GMT]Z'));
        $categories = $this->categoryService->getAllCategories();

        return view('admin.article.show', compact('article', 'articlePublicationDate', 'categories'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param string $id The ID of the article to be edited.
     */
    public function edit(string $id)
    {
        $article = $this->articleService->getArticle($id);
        $categories = $this->categoryService->getAllCategories();

        return view('admin.article.update', compact('article', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request The HTTP request instance.
     * @param string $id The ID of the article to be updated.
     */
    public function update(Request $request, string $id)
    {
        $articleUpdate = [
            'article_title' => $request->article_title,
            'article_description' => $request->article_description,
            'article_keywords' => $request->article_keywords,
            'article_content' => $request->article_content,
            'category_id' => $request->category_id,
        ];

        if ($request->is_public) {
            $articleUpdate['publication_date'] = Carbon::now();
        }

        if ($request->article_thumbnail) {
            $articleThumbnail = $this->articleService->uploadThumbnailArticle($request->article_thumbnail);

            $articleUpdate['article_thumbnail'] = $articleThumbnail;
        }

        if ($this->articleService->updateArticle($id, $articleUpdate)) {
            return redirect()->route('admin.article.index')->with('success', 'Cập nhật bài viết thành công');
        }

        return redirect()->back()->with('error', 'Có lỗi xảy ra');
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
