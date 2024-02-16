<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Admin\CategoryService;

class CategoryController extends Controller
{
    /**
     * The category service instance.
     *
     * @var CategoryService
     */
    protected $categoryService;

    /**
     * Constructor for CategoryController class.
     *
     * @param CategoryService $categoryService The category service instance.
     */
    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request The HTTP request instance.
     * @return \Illuminate\View\View The view for listing categories.
     */
    public function index(Request $request)
    {
        $params = $request->all();
        $categories = $this->categoryService->getCategories($params);
        $categoriesTree = getCategories($categories);

        return view('admin.category.index', compact('params', 'categoriesTree'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View The view for creating a category.
     */
    public function create()
    {
        $categories = $this->categoryService->getAllCategoriesParent();

        return view('admin.category.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request The HTTP request instance.
     * @return \Illuminate\Http\RedirectResponse The redirect response after storing the category.
     */
    public function store(Request $request)
    {
        $inputs = $request->except('_token');

        if ($this->categoryService->createCategory($inputs)) {
            return redirect()->route('admin.category.index')->with('success', 'Thêm danh mục thành công');
        }

        return redirect()->back()->with('error', 'Có lỗi xảy ra');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param string $id The ID of the category to be edited.
     * @return \Illuminate\View\View The view for editing a category.
     */
    public function edit(string $id)
    {
        $category = $this->categoryService->getCategory($id);
        $categories = $this->categoryService->getAllCategories();

        return view('admin.category.update', compact('category', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request The HTTP request instance.
     * @param string $id The ID of the category to be updated.
     * @return \Illuminate\Http\RedirectResponse The redirect response after updating the category.
     */
    public function update(Request $request, string $id)
    {
        $categoryUpdate = [
            'category_name' => $request->category_name,
            'category_description' => $request->category_description,
            'category_keywords' => $request->category_keywords,
            'parent_id' => $request->parent_id ? (int) $request->parent_id : null,
        ];

        if ($this->categoryService->updateCategory($id, $categoryUpdate)) {
            return redirect()->route('admin.category.index')->with('success', 'Cập nhật danh mục thành công');
        }

        return redirect()->back()->with('error', 'Có lỗi xảy ra');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param string $id The ID of the category to be deleted.
     * @return \Illuminate\Http\RedirectResponse The redirect response after deleting the category.
     */
    public function destroy(string $id)
    {
        if ($this->categoryService->destroyCategory($id)) {
            return redirect()->back()->with('success', 'Xóa danh mục thành công');
        }

        return redirect()->back()->with('error', 'Có lỗi xảy ra');
    }

    /**
     * Update the sorting order of categories.
     *
     * @param Request $request The HTTP request instance.
     * @return \Illuminate\Http\RedirectResponse The redirect response after updating the sort order.
     */
    public function updateSortCategories(Request $request)
    {
        $sortValueArray = json_decode($request->sort_value, true);

        if ($this->categoryService->updateSortCategories($sortValueArray)) {
            return redirect()->back()->with('success', 'Sắp xếp danh mục thành công');
        }

        return redirect()->back()->with('error', 'Có lỗi xảy ra');
    }
}
