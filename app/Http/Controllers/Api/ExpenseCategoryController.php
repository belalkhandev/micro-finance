<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\ExpenseCategory\ExpenseCategoryRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ExpenseCategoryController extends Controller
{
    protected $category;

    public function __construct(ExpenseCategoryRepositoryInterface $category)
    {
        $this->category = $category;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = $this->category->all();

        if ($categories) {
            return response()->json([
                'status' => true,
                'categories' => $categories,
                'message' => 'Found categories data'
            ]);
        }

        return response()->json([
            'status' => false,
            'categories' => null,
            'message' => 'No data found'
        ]);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|unique:expense_categories,name',
        ];

        $validation = Validator::make($request->all(), $rules);

        if ($validation->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validation->errors()
            ], 422);
        }
        
        $category = $this->category->store($request);

        if ($category) {
            return response()->json([
                'status' => true,
                'category' => $category,
                'message' => 'category has been stored successfully'
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => 'Failed to store category'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = $this->category->find($id);

        if ($category) {
            return response()->json([
                'status' => true,
                'category' => $category,
                'message' => 'Found category data'
            ]); 
        }

        return response()->json([
            'status' => false,
            'message' => 'No data found'
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'name' => 'required|unique:expense_categories,name,'.$id,
        ];

        $validation = Validator::make($request->all(), $rules);

        if ($validation->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validation->errors()
            ], 422);
        }

        $category = $this->category->update($request, $id);

        if ($category) {
            return response()->json([
                'status' => true,
                'category' => $category,
                'message' => 'Category has been updated successfully'
            ]);
        }

        return response()->json([
            'status' => false,
            'category' => null,
            'message' => 'Failed to update category'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ($this->category->delete($id)) {
            return response()->json([
                'status' => true,
                'message' => 'Category has been deleted successfully'
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => 'Failed to delete category'
        ]);
    }
}
