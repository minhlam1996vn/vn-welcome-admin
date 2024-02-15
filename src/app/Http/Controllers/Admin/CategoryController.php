<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
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

        return view('admin.category.index', compact('params', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        $inputs = $request->except('_token', '_method');

        if ($this->categoryService->updateCategory($id, $inputs)) {
            return redirect()->back()->with('success', 'Cập nhật danh mục thành công');
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
        $sortValue = json_decode($request->sort_value, true);

        $this->categoryService->updateSortCategories($sortValue);

        return redirect()->back()->with('success', 'Sắp xếp danh mục thành công');
    }
}
