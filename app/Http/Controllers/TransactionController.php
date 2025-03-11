<?php

namespace App\Http\Controllers;

use App\Http\Requests\TransactionRequest;
use App\Models\Discount;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::with('details.product')->latest()->get();
        return view('transactions.index', compact('transactions'));
    }

    public function create()
    {
        return view('transactions.create', [
            'products' => Product::orderBy('id', 'desc')->get(),
            'users' => User::all(),
        ]);
    }

    public function store(TransactionRequest $request)
    {
        // dd($request->all());

        DB::beginTransaction();
        try {
            $invoice = 'INV-' . Str::upper(Str::random(10));

            $totalQuantity = 0;
            $totalPrice = 0;
            $details = [];

            foreach ($request->products as $productData) {
                $product = Product::findOrFail($productData['product_id']);

                if ($product->stock < $productData['quantity']) {
                    DB::rollBack();
                    return back()->with('error', "Jumlah produk '{$product->name}' tidak mencukupi.")->withInput();
                }

                $subtotal = $product->price * $productData['quantity'];
                $totalQuantity += $productData['quantity'];
                $totalPrice += $subtotal;

                $details[] = new TransactionDetail([
                    'product_id' => $product->id,
                    'quantity' => $productData['quantity'],
                    'price' => $product->price,
                    'subtotal_price' => $subtotal,
                ]);

                $product->decrement('stock', $productData['quantity']);
            }

            $totalPriceDiscount = $totalPrice;
            $discount = $request->discount_amount;

            if ($discount) {
                $totalPriceDiscount = $totalPrice - $discount;
            }

            $transaction = Transaction::create([
                'user_id' => $request->user_id,
                'invoice' => $invoice,
                'discount' => $discount,
                'total_quantity' => $totalQuantity,
                'subtotal_price' => $totalPrice,
                'total_price' => $totalPriceDiscount,
            ]);

            $transaction->details()->saveMany($details);

            DB::commit();
            return redirect()->route('transactions.index')->with('success', 'Transaksi berhasil dibuat.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal menyimpan transaksi.')->withInput();
        }
    }

    public function show(Transaction $transaction)
    {
        return view('transactions.show', compact('transaction'));
    }

    public function destroy(Transaction $transaction)
    {
        DB::beginTransaction();
        try {
            $details = $transaction->details;

            foreach ($details as $detail) {
                $product = $detail->product;
                if ($product) {
                    $product->increment('stock', $detail->quantity);
                }
            }

            $transaction->details()->delete();
            $transaction->delete();

            DB::commit();
            return redirect()->route('transactions.index')->with('success', 'Transaksi berhasil dihapus dan stok produk dikembalikan.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal menghapus transaksi.');
        }
    }

    public function checkDiscount(Request $request)
    {
        $request->validate([
            'discount' => 'required|string'
        ]);

        $discount = Discount::where('code', $request->discount)->first();

        if (!$discount) {
            return response()->json([
                'success' => false,
                'message' => "Kode diskon tidak ditemukan."
            ], 404);
        }

        $now = Carbon::now();
        if ($discount->valid_from && $discount->valid_from->gt($now)) {
            return response()->json([
                'success' => false,
                'message' => "Kode diskon belum berlaku."
            ], 400);
        }

        if ($discount->valid_until && $discount->valid_until->lt($now)) {
            return response()->json([
                'success' => false,
                'message' => "Kode diskon telah kedaluwarsa."
            ], 400);
        }

        return response()->json([
            'success' => true,
            'message' => "Kode diskon berlaku",
            'data' => [
                'name' => $discount->name,
                'type' => $discount->type,
                'value' => $discount->value,
                'min_purchase' => $discount->min_purchase,
                'valid_from' => $discount->valid_from,
                'valid_until' => $discount->valid_until
            ]
        ]);
    }
}
