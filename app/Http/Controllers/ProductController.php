<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\UnitRumah;

class ProductController extends Controller
{
    Public Function CreateUnit(Request $request){
        DB::beginTransaction(); //Supaya bisa melakukan banyak transaksi ke dalam databasenya - Melisa.A-JC2.

        try {
            //Validasi properti - Melisa.A-JC2.
            $this->validate($request, [
                'nomor_rumah' => 'required',
                'harga' => 'required',
                'luas_tanah' => 'required',
                'luas_bangunan' => 'required'
            ]);
            
            //Variable input request - Melisa.A-JC2.
            $addKavling = $request->input('kavling');
            $addBlock = $request->input('blok');
            $addNo = $request->input('no_rumah');
            $addPrice = $request->input('harga_rumah');
            $addGroundSize = $request->input('luas_tanah');
            $addPropertySize = $request->input('luas_bangunan');

            //Variable atas dimasukkan ke database - Melisa.A-JC2.
            $product = new Unit;
            $product->kavling = $addKavling;
            $product->blok = $addBlock;
            $product->nomor_rumah = $addNo;
            $product->harga = $addPrice;
            $product->luas_tanah = $addGroundSize;
            $product->luas_bangunan = $addPropertySize;
            $product->save();


            // Menampilkan data yang sudah disave - Melisa.A-JC2.
            $newProduct = Unit::get();

            // DB Commit untuk memasukan data yang berhasil masuk - Melisa.A-JC2.
            DB::commit();
            return response()->json($newProduct, 200);
        }

        catch (\Exception $e) {
            DB::rollBack(); // Untuk melihat data yang gagal masuk ke database - Melisa.A-JC2.
            return response()->json(["message" => $e->getMessage()], 500);
        }


    }

    Public Function DeleteUnit (Request $request){

        DB::beginTransaction();
        try {     
            // Deletion RAW QUERY - Melisa.A-JC2.
            $id = $request->input('id');
            $pList = DB::delete('delete from units where id = ?', [$id]);
            
            $newProduct = Unit::get();

            DB::commit();
            return response()->json($vendor, 200);
        }

        catch(\Exception $e) 
        {
            DB::rollBack();
            return response()->json(["message" => $e->getMessage()], 500);
        }

    }
}
