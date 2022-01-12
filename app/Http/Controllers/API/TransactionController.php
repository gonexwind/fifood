<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Auth;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function all(Request $request)
    {
        $id = $request->input('id');
        $limit = $request->input('limit');
        $food_id = $request->input('food_id');
        $status = $request->input('status');

        if ($id) {
            $transaction = Transaction::with(['food', 'user'])->find($id);
            if ($transaction) {
                return ResponseFormatter::success(
                    $transaction,
                    'Success get transaction'
                );
            } else {
                return ResponseFormatter::error(
                    null,
                    'Transaction is empty',
                    404,
                );
            }
        }

        $transaction = Transaction::with(['food', 'user'])
            ->where('user_id', Auth::user()->id);

        if($food_id) $transaction->where('food_id', $food_id);

        if($status) $transaction->where('status', $status);

        return ResponseFormatter::success(
            $transaction->paginate($limit),
            "Success get list transactions",
        );
    }

}
