<?php

namespace App\Http\Controllers\Blog\Admin;

use Alpha\B;
use App\Http\Controllers\Controller;
use App\Http\Requests\BlogCategoryCreateRequest;
use App\Http\Requests\BlogCategoryUpdateRequest;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support;
use function Webmozart\Assert\Tests\StaticAnalysis\email;
use function Webmozart\Assert\Tests\StaticAnalysis\resource;
use  App\Repositories\BlogCategoryRepository;

class CategoryController extends BaseController
{
    private $blogCategoryRepository;
    public function __construct()
    {
        parent::__construct();
        $this->blogCategoryRepository = new BlogCategoryRepository();
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $paginator = $this->blogCategoryRepository->getAllWithPaginate(7);
        return view('blog.admin.categories.index', compact('paginator'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $item = new BlogCategory();
        $categoryList = $this->blogCategoryRepository->getForComboBox();
        return view('blog.admin.categories.edit',
        compact('item', 'categoryList'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(BlogCategoryCreateRequest $request)
    {
        $data = $request->input();
        if (empty($data['slug'])) {
            $data['slug'] = Support\Str::slug($data['title']);
        }
        $item = new BlogCategory($data);
        $item->save();
        if ($item instanceof BlogCategory) {
            return redirect()->route('blog.admin.categories.edit', [$item->id])
                ->with(['success' => 'успешно сохранено']);
        } else {
            return back()->withInput()
                ->withErrors(['msg' => 'Ошибка сохранения']);
        }
    }


    /**
     * @param $id
     * @param BlogCategoryRepository $categoryRepository
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($id, BlogCategoryRepository $categoryRepository)
    {
        $item = $categoryRepository->getEdit($id);
        if (empty($item)) {
            abort(404);
        }
        $categoryList = $categoryRepository->getForComboBox();
//        $item = BlogCategory::findOrFail($id);
//        $categoryList = BlogCategory::all();

        return view('blog.admin.categories.edit',
            compact('item', 'categoryList'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(BlogCategoryUpdateRequest $request, $id)
    {
        /** @var BlogCategory $item */
        $item = BlogCategory::find($id);
        if (empty($item)) {
            return back()
                ->withErrors(['msg' => "Запись id=[{$id}] не найдена"])
                ->withInput();
        }
        $data = $request->all();
        if(empty($data['slug'])) {
            $data['slug'] = Support\Str::slug($data['title']);
        }
        $result = $item->update($data);

        if ($result) {
            return redirect()
                ->route('blog.admin.categories.edit', $id)
                ->with(['success' => 'Успешно сохранено']);
        } else {
            return back()
                ->withErrors(['msg' => 'Ошибка сохранения'])
                ->withInput();
        }
    }
}
