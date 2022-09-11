<?php

namespace App\Components;

use App\Models\Category;

class CategoryRecursive
{
    private $html;

    public function __construct()
    {
        $this->html = '<option value=" ">Category Root</option>';
    }

    public function createCategory($parentId = null, $subMark = '|--')
    {
        $data = Category::where('parent_id', $parentId)->get();
        foreach ($data as $dataItem) {
            $this->html .= '<option value="' . $dataItem->id . '">' . $subMark . $dataItem->name . '</option>';
            $this->createCategory($dataItem->id, $subMark . ' -- ');
        }

        return $this->html;
    }

    public function editCategory($id, $parentIdEdit, $parentId = null, $subMark = '|--')
    {
        $data = Category::where('parent_id', $parentId)->get();

        foreach ($data as $dataItem) {
            if ($parentIdEdit == $dataItem->id) {
                $this->html .= '<option selected value="' . $dataItem->id . '">' . $subMark . $dataItem->name . '</option>';
            } elseif ($id == $dataItem->id) {
                $this->html .= '<option disabled class="text-black" value="' . $dataItem->id . '">' . $subMark . $dataItem->name . '</option>';
            } else {
                $this->html .= '<option value="' . $dataItem->id . '">' . $subMark . $dataItem->name . '</option>';
            }

            $this->editCategory($id, $parentIdEdit, $dataItem->id, $subMark . ' -- ');
        }

        return $this->html;
    }
}
