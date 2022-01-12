<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Food;
use Illuminate\Http\Request;

class FoodController extends Controller
{
    public function all(Request $request)
    {
        $id = $request->input('id');
        $limit = $request->input('limit', 6);
        $name = $request->input('name');
        $types = $request->input('types');
        $price_from = $request->input('price_from');
        $price_to = $request->input('price_to');
        $rate_from = $request->input('rate_from');
        $rate_to = $request->input('rate_to');

        if ($id) {
            $foods = Food::find($id);
            if ($foods) {
                return ResponseFormatter::success($foods, 'Success get food');
            } else {
                return ResponseFormatter::error(null, 'Product is empty', 404);
            }
        }

        $foods = Food::query();

        if ($name) {
            $foods->where('name', 'like', '%' . $name . '%');
        }
        if ($types) {
            $foods->where('types', 'like', '%' . $types . '%');
        }
        if($price_from) {
            $foods->when('price', '>=', $price_from);
        }
        if($price_to) {
            $foods->when('price', '<=', $price_to);
        }
        if($rate_from) {
            $foods->when('rate', '>=', $rate_from);
        }
        if($rate_to) {
            $foods->when('rate', '<=', $rate_to);
        }

        return ResponseFormatter::success(
            $foods->paginate($limit),
            'Success get list products'
        );
    }
}
