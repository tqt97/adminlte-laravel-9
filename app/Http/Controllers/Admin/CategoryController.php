<?php

namespace App\Http\Controllers\Admin;

use App\Components\CategoryRecursive;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    private $categoryRecursive;

    public function __construct(CategoryRecursive $categoryRecursive, Category $category)
    {
        $this->categoryRecursive = $categoryRecursive;
    }
    public function index()
    {
        $categories = Category::root()  // root = whereNull('parent_id')
            ->with('childrenCategories')
            ->withCount('categories')
            ->withCount('childrenCategories')
            ->get();
        Session::put('back_url', url()->full()); // get full back url
        return view('admin.pages.category.index', compact('categories'));
    }

    public function create()
    {
        $options = $this->categoryRecursive->createCategory();
        return view('admin.pages.category.create', compact('options'));
    }

    public function store(StoreCategoryRequest $request)
    {
        if ($request->file('image')) {
            $file = $request->file('image');
            $originalName = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $hashName = pathinfo($originalName, PATHINFO_FILENAME) . '-' . time() . '.' . $extension;
            $file->storeAs('category', $hashName, 'public');
        }
        $data = [
            'name' => $request->name,
            'slug' => $request->slug ? $request->slug : Str::slug($request->name),
            'publish' => $request->publish ? true : false,
            'feature' => $request->feature ? true : false,
            'parent_id' => $request->parent_id,
            'order_at' => $request->order_at,
            'image' => $hashName
        ];

        Category::create($data);

        return redirect()->route('admin.blogs.categories.index')->with('message', 'Add category successful !');
    }

    public function show(Category $category)
    {
        //
    }

    public function edit(Category $category)
    {
        $options = $this->categoryRecursive->editCategory($category->id, $category->parent_id);
        return view('admin.pages.category.edit', compact('category', 'options'));
    }


    public function update(UpdateCategoryRequest $request, Category $category)
    {
        if ($request->file('image') && request('image') != '') {
            // unlink old image
            $old_image = $category->image; // lấy tên image cũ
            $old_url_image = public_path('storage/category/' . $old_image); // lấy url hình ảnh cũ

            if (File::exists($old_url_image) && $old_image != '') {
                unlink($old_url_image);
            }

            $file = $request->file('image');
            $originalName = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $hashName = pathinfo($originalName, PATHINFO_FILENAME) . '-' . time() . '.' . $extension;
            $file->storeAs('category', $hashName, 'public');
        }
        $data = [
            'name' => $request->name,
            'slug' => $request->slug ? $request->slug : Str::slug($request->name),
            'publish' => $request->publish ? true : false,
            'feature' => $request->feature ? true : false,
            'parent_id' => $request->parent_id,
            'order_at' => $request->order_at,
            'image' => $hashName ?? $category->image // isset($a) ? $a : %b
        ];
        $category->update($data);

        return redirect()->route('admin.blogs.categories.index')->with('message', 'Category updated successfully !');
    }

    public function destroy(Category $category)
    {
        $category->delete();

        if (session('back_url')) {
            return redirect(session('back_url'))->with('message', 'Category has been deleted and move to archives !');
        }
        return redirect()->route('admin.categories.index')
            ->with('message', 'Category has been deleted and move to archives !');
    }
    public function restore($id)
    {
        $category = Category::onlyTrashed()->findOrFail($id);
        if ($category && $category->trashed()) {
            $category->restore();
        }

        if (session('back_url')) {
            return redirect(session('back_url'))->with('message', 'Category restore successful !');
        }
        return redirect()->route('admin.blogs.categories.index')->with('message', 'Category restore successful !');
    }
    public function forceDelete($id)
    {
        $category = Category::onlyTrashed()->findOrFail($id);
        if ($category) {
            $category->forceDelete();
        }

        if (session('back_url')) {
            return redirect(session('back_url'))->with('message', 'Category force delete successful !');
        }
        return redirect()->route('admin.blogs.categories.index')->with('message', 'Category force delete successful !');
    }
}
