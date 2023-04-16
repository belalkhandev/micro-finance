<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\Savings\SavingsRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SavingsController extends Controller
{
    protected $savings;

    public function __construct(SavingsRepositoryInterface $savings)
    {
        $this->savings = $savings;
    }

    public function index(Request $request)
    {
        $savings = $this->savings->getByPaginate($request, 20);

        if ($savings) {
            return response()->json([
                'status' => true,
                'savings' => $savings
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => "No savings found"
        ]);
    }

    public function memberSavings($member_id)
    {
        $savings = $this->savings->memberSavings($member_id);

        if ($savings) {
            return response()->json([
                'status' => true,
                'savings' => $savings
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => "No savings found"
        ]);
    }

    /**
     * Store saving deposit or withdraw
     */
    public function store(Request $request)
    {
        $rules = [
            'member_id' => 'required',
            'savings_type' => 'required',
            'amount' => 'required',
        ];

        $validation = Validator::make($request->all(), $rules);

        if ($validation->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validation->errors()
            ]);
        }

        //store savings
        $savings = $this->savings->store($request);

        if ($savings) {
            return response()->json([
                'status' => true,
                'savings' => $savings
            ]);
        }

        return response()->json([
            'status' => false,
            'savings' => null
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        if ($this->savings->delete($id)) {
            return response()->json([
                'status' => true,
                'message' => 'Savings deleted successfully'
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => 'Failed to delete savings'
        ]);
    }
}
