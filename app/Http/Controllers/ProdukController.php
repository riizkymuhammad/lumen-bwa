<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Produk;

class ProdukController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

      public function index()
    {
      $produk = Produk::all();
      return response()->json($produk);
    }
    
    public function show($id)
    {
      $produk = Produk::find($id);
      return response()->json($produk);
    }


    public function create(Request $request)
    {
        $this->validate($request,[
            'nama' => 'required | string',
            'harga' => 'required | integer',
            'warna' => 'required | string',
            'kondisi' => 'required | in:baru,lama',
            'deskripsi' => 'string'
        ]);
        $data = $request->all();
        $produk = Produk::create($data);

        return response()->json($produk);
    }

        public function update(Request $request, $id)
    {
              $this->validate($request,[
            'nama' => 'string',
            'harga' => 'integer',
            'warna' => 'string',
            'kondisi' => 'in:baru,lama',
            'deskripsi' => 'string'
        ]);

      
       
        $data = $request->all();
        $produk = Produk::find($id);
          if(!$produk){
          return response()->json(['message' => 'Halaman Tidak ditemukan!']);
        }

        $produk->fill($data);
        $produk->save();


        return response()->json($produk);
    }


        public function destroy($id)
    {

        $produk = Produk::find($id);
          if(!$produk){
          return response()->json(['message' => 'Halaman Tidak ditemukan!'],404);
        }

        $produk->delete();

        return response()->json(['message'=> 'Produk Sudah Terhapus']);
    }

    //
}
