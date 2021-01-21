<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\ProductPurchase;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PurchaseController extends Controller
{
    public function index()
    {
        return view('purchase.index', [
            'transactions' => Transaction::all()
        ]);
    }

    public function create()
    {
        return view('purchase.create', [
            'products' => Product::all()
        ]);
    }

    public function store()
    {
        $counter = 0;
        $total = 0;
        foreach(request()->input() as $key=> $value){
            
            if(strstr($key,'product')){
            $counter = $counter+1;
            }
        }
        
        if($counter > 0){
            for($i=1; $i<=$counter; $i++){
                $total = $total + (request('price_'.$i) * request('qty_'.$i));
            }
        }

        $transaction = Transaction::create([
            'total_harga' => $total
        ]);

        if($counter > 0){
            for($i=1; $i<=$counter; $i++){
                $product = Product::where('id', request('product_'.$i))->first();
                // dd($product);
                ProductPurchase::create([
                    "transaksi_pembelian_id" => $transaction->id,
                    "master_barang_id" => $product->id,
                    "jumlah" => request('qty_'.$i),
                    "harga_satuan" => $product->harga_satuan
                ]);
            }
        }

        return redirect('purchase');
    }

    public function show($id)
    {
        $transactions = DB::table('products_transactions')
                        ->where('transaksi_pembelian_id', $id)
                        ->join('transactions', 'products_transactions.transaksi_pembelian_id', '=', 'transactions.id')
                        ->join('products', 'products_transactions.master_barang_id', '=', 'products.id')
                        ->select('products_transactions.*', 'transactions.total_harga as total', 'products.nama_barang as barang')
                        ->get();
        $tran = Transaction::where('id', $id)->first();

        return view('purchase.show', [
            'transactions' => $transactions,
            'tran' => $tran,
        ]);
    }

}
