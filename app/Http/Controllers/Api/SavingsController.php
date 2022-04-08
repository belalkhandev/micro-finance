<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\Savings\SavingsRepositoryInterface;
use Illuminate\Http\Request;

class SavingsController extends Controller
{
    protected $savings;

    public function __construct(SavingsRepositoryInterface $savings)
    {
        $this->savings = $savings;
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
