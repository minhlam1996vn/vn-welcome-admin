<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ArticleRequest;
use App\Services\Admin\ArticleService;
use App\Services\Admin\CategoryService;
use App\Services\Admin\TagService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
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
     * The tag service instance.
     *
     * @var TagService
     */
    protected $tagService;

    /**
     * Constructor for ArticleController class.
     *
     * @param ArticleService $articleService The article service instance.
     * @param CategoryService $categoryService The category service instance.
     * @param TagService $tagService The tag service instance.
     */
    public function __construct(
        ArticleService $articleService,
        CategoryService $categoryService,
        TagService $tagService,
    ) {
        $this->articleService = $articleService;
        $this->categoryService = $categoryService;
        $this->tagService = $tagService;
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
        $uuid = Session::get('uuid') ?? Str::uuid();
        $categories = $this->categoryService->getAllCategories();
        $tags = $this->tagService->getAllTags();

        return view('admin.article.create', compact('categories', 'tags', 'uuid'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request The HTTP request instance.
     * @return \Illuminate\Http\RedirectResponse The redirect response after storing the article.
     */
    public function store(ArticleRequest $request)
    {
        $articleCreate = [
            'uuid' => $request->uuid,
            'user_id' => Auth::guard('admin')->id(),
            'article_title' => $request->article_title,
            'article_slug' => Str::slug($request->article_title),
            'article_description' => $request->article_description,
            'article_keywords' => $request->article_keywords,
            'article_content' => $request->article_content,
            'category_id' => $request->category_id,
            'publication_date' => $request->is_public ? Carbon::now() : null,
        ];

        $tagId = $request->tag_id;
        $imageBase64 = $request->image_base64;
        $mediaUse = $request->img_path;

        if ($this->articleService->createArticle($articleCreate, $tagId, $imageBase64, $mediaUse)) {
            return redirect()->route('admin.article.index')->with('success', 'Thêm bài viết thành công');
        }

        return redirect()->back()->with('error', 'Có lỗi xảy ra');
    }

    /**
     * Display the specified resource.
     *
     * @param string $id The ID of the article to be displayed.
     * @return \Illuminate\View\View The view for displaying a specific article.
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
     * @return \Illuminate\View\View The view for editing the article.
     */
    public function edit(string $id)
    {
        $article = $this->articleService->getArticle($id);
        $categories = $this->categoryService->getAllCategories();
        $tags = $this->tagService->getAllTags();

        return view('admin.article.update', compact('article', 'categories', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request The HTTP request instance.
     * @param string $id The ID of the article to be updated.
     * @return \Illuminate\Http\RedirectResponse The redirect response after updating the article.
     */
    public function update(ArticleRequest $request, string $id)
    {
        $articleUpdate = [
            'article_title' => $request->article_title,
            'article_description' => $request->article_description,
            'article_keywords' => $request->article_keywords,
            'article_content' => $request->article_content,
            'category_id' => $request->category_id,
        ];

        $tagId = $request->tag_id;
        $imageBase64 = $request->image_base64;
        $mediaUse = $request->img_path;

        if ($request->is_public) $articleUpdate['publication_date'] = Carbon::now();

        if ($this->articleService->updateArticle($id, $articleUpdate, $tagId, $imageBase64, $mediaUse)) {
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
