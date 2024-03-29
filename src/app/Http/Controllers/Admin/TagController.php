<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TagRequest;
use App\Services\Admin\TagService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;

class TagController extends Controller
{
    /**
     * The tag service instance.
     *
     * @var TagService
     */
    protected $tagService;

    /**
     * Constructor for TagController class.
     *
     * @param TagController $tagService The category service instance.
     */
    public function __construct(TagService $tagService)
    {
        $this->tagService = $tagService;
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
        $tags = $this->tagService->getTags($params);

        return view('admin.tag.index', compact('params', 'tags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View The view for creating a new tag.
     */
    public function create()
    {
        return view('admin.tag.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request The HTTP request instance.
     * @return \Illuminate\Http\RedirectResponse The redirect response after storing the tag.
     */
    public function store(TagRequest $request)
    {
        $tagCreate = [
            'tag_name' => $request->tag_name,
            'tag_slug' => Str::slug($request->tag_name),
            'tag_description' => $request->tag_description,
            'tag_keywords' => $request->tag_keywords,
        ];

        if ($this->tagService->createTag($tagCreate)) {
            return redirect()->route('admin.tag.index')->with('success', 'Thêm tag thành công');
        }

        return redirect()->back()->with('error', 'Có lỗi xảy ra');
    }

    /**
     * Display the specified resource.
     *
     * @param string $id The ID of the resource to be displayed.
     * @return \Illuminate\Http\Response
     */
    public function show(string $id)
    {
        abort(Response::HTTP_NOT_FOUND);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param string $id The ID of the tag to be edited.
     * @return \Illuminate\View\View The view for editing the tag.
     */
    public function edit(string $id)
    {
        $tag = $this->tagService->getTag($id);

        return view('admin.tag.update', compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request The HTTP request instance.
     * @param string $id The ID of the tag to be updated.
     * @return \Illuminate\Http\RedirectResponse The redirect response after updating the tag.
     */
    public function update(TagRequest $request, string $id)
    {
        $tagUpdate = [
            'tag_name' => $request->tag_name,
            'tag_slug' => Str::slug($request->tag_name),
            'tag_description' => $request->tag_description,
            'tag_keywords' => $request->tag_keywords,
        ];

        if ($this->tagService->updateTag($id, $tagUpdate)) {
            return redirect()->route('admin.tag.index')->with('success', 'Cập nhật tag thành công');
        }

        return redirect()->back()->with('error', 'Có lỗi xảy ra');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param string $id The ID of the tag to be deleted.
     * @return \Illuminate\Http\RedirectResponse The redirect response after deleting the tag.
     */
    public function destroy(string $id)
    {
        if ($this->tagService->destroyTag($id)) {
            return redirect()->back()->with('success', 'Xóa tag thành công');
        }

        return redirect()->back()->with('error', 'Có lỗi xảy ra');
    }
}
