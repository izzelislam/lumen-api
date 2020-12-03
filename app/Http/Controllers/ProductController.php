<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = Product::all();

        return response()->json($data);
    }

    public function create(Request $request)
    {
        $this->validate($request,[
            'nama'=>'required',
            'harga'=>'required',
            'kondisi'=>'required',
            'warna'=>'required',
            'deskripsi'=>'required'
        ]);

        $data=$request->all();
        $product = Product::create($data);

        return response()->json($product);

        // return $request->json()->all();
    }

    public function destroy($id)
    {
        $data = Product::find($id);
        $data->delete();

        return "berhasil dihapus";
    }

    public function update(Request $request,$id)
    {
        $product=Product::find($id);
        
        if(!$product){
            return response()->json(['message' => 'data tidak ditemukan'],404);
        }

        $product->update($request->all());
        return response()->json($product);
    }
}
