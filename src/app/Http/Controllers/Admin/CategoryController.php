<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Admin\CategoryService;

class CategoryController extends Controller
{
    protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    /**
     * Display a listing of the resource.
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
     */
    public function create()
    {
        $categories = $this->categoryService->getAllCategoriesParent();

        return view('admin.category.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
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
     */
    public function edit(string $id)
    {
        $category = $this->categoryService->getCategory($id);
        $categories = $this->categoryService->getAllCategories();

        return view('admin.category.update', compact('category', 'categories'));
    }

    /**
     * Update the specified resource in storage.
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
     */
    public function destroy(string $id)
    {
        if ($this->categoryService->destroyCategory($id)) {
            return redirect()->back()->with('success', 'Xóa danh mục thành công');
        }

        return redirect()->back()->with('error', 'Có lỗi xảy ra');
    }

    /**
     * Update Sort Categories.
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
