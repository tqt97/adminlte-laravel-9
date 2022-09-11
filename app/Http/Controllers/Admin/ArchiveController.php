<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Support\Facades\Session;


class ArchiveController extends Controller
{
    public function category()
    {
        $categories = Category::onlyTrashed()
            ->with('childrenCategories')
            ->orderBy('deleted_at', 'ASC')
            ->paginate(10);
        Session::put('back_url', url()->full());

        return view('admin.pages.category.archive', compact('categories'));
    }
}
