<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ShoppingCart;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ShoppingCartController extends Controller
{
    public function addToCart(Request $request) 
    {
        // validasi input
        $validator = Validator::make($request->all(), [
            'product_id' => 'required|exists:products',
            'quantity' => 'required|numeric|min:1',
        ]);

        // jika validasi gagal, tampilkan error
        if ($validator->fails()) {
            return response()->json(['status' => 'Bad Request', 'message' => $validator->errors()->first()], 400);
        }

        DB::beginTransaction();
        try {
            $product = Product::find($request->product_id); // cari data produk

            // insert data ke database
            ShoppingCart::create([
                'user_id' => Auth::user()->id,
                'product_id' => $product->id,
                'quantity' => $request->quantity,
                'subtotal' => $request->quantity * $product->price,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            DB::commit();
            return response()->json(['status' => 'Success', 'message' => 'Successfully add to cart'], 200); // tampil pesan berhasil

        } catch (Exception $e) {
            DB::rollBack();
            return response()->json(['status' => 'Error', 'message'=> $e->getMessage()], 500); // tampil pesan error
        }
    }

    public function deleteCart($id) 
    {
        DB::beginTransaction();
        try {
            $cart = ShoppingCart::where('id', $id)->first(); // cari keranjang

            // jika tidak ditemukan, tampilkan error
            if (!$cart) {
                return response()->json(['status' => 'Bad Request', 'message' => 'Shopping cart does not exist!'], 400); 
            }

            $cart->delete(); // hapus keranjang belanja
            DB::commit();

            return response()->json(['status' => 'Success', 'message' => 'Shopping cart has been removed!'], 200);

        } catch (Exception $e) {
            DB::rollBack();
            return response()->json(['status' => 'Error', 'message' => $e->getMessage()], 500);
        } 
    }
}
