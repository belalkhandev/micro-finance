<?php

namespace App\Repositories\ExpenseCategory;

use App\Models\ExpenseCategory as Category;

class ExpenseCategoryRepository implements ExpenseCategoryRepositoryInterface {

    public function all()
    {
        $categories = Category::get();

        if ($categories->isNotEmpty()) {
            return $categories;
        }

        return false;
    }

    public function store($request)
    {
        $category = new Category();
        $category->name = $request->input('name');
        $category->description = $request->input('description');

        if ($category->save()) {
            return $category;
        }

        return false;

    }

    public function update($request, $id)
    {
        $category = Category::find($id);
        $category->name = $request->input('name');
        $category->description = $request->input('description');

        if ($category->save()) {
            return $category;
        }

        return false;
    }

    public function delete($id)
    {
        $category = Category::find($id);

        if ($category) {
            return $category->delete();
        }

        return false;
    }

    public function find($id)
    {
        $category = Category::find($id);

        if ($category) {
            return $category;
        }

        return false;
    }


}
