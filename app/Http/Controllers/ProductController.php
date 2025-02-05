<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $response = Http::get("https://bsby.siglab.co.id/api/test-programmer", [
            'email' => 'nazman.nadev@gmail.com'
        ]);
        
        $data = $response->json();

        $products = collect($data['results'] ?? [])->map(fn($item) => (object) $item);

        // Filter berdasarkan status
        if ($request->has('status')) {
            $status = intval($request->input('status'));
            $products = $products->filter(fn($product) => intval($product->status) === $status);
        }

        if ($request->has('type') && $request->input('type') !== '') {
            $type = (int) $request->input('type');
            $products = $products->filter(function($product) use ($type) {
                return $product->type == $type;
            });
        }
        
        if ($request->has('attachment') && $request->input('attachment') !== '') {
            $attachment = (int) $request->input('attachment');
            $products = $products->filter(function($product) use ($attachment) {
                return $product->attachment == $attachment;
            });
        }
        
        if ($request->has('discount') && $request->input('discount') !== '') {
            $discount = (int) $request->input('discount');
            if ($discount == 1) {
                $products = $products->filter(function($product) {
                    return $product->discount > 0;
                });
            } else {
                $products = $products->filter(function($product) {
                    return $product->discount == 0;
                });
            }
        }

        return view('product.product-from-api', compact('products'));
    }

    public function indexFromDb(Request $request)
    {
        $products = Product::when($request->discount, function ($query) use ($request) {
            $discount = (int) $request->input('discount');
            return $query->where(function ($q) use ($discount) {
                if ($discount === 1) {
                    $q->where('discount', '>', 0); 
                } elseif ($discount === 0) {
                    $q->where('discount', 0); 
                }
            });
        })
        ->when($request->status === '1', function($q) use($request) {
            $q->where('status', (int)$request->status);
        })
        ->when($request->status === '0', function($q) use($request) {
            $q->where('status', (int)$request->status);
        })
        ->when($request->attachment === '1', function($q) use($request) {
            $q->where('attachment', (int)$request->attachment);
        })
        ->when($request->attachment === '0', function($q) use($request) {
            $q->where('attachment', (int)$request->attachment);
        })
        ->when($request->type, function($q) use($request) {
            $q->where('type', (int)$request->type);
        })
        
        ->get();

        return view('product.product-from-database', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }

    public function fetcDataFromApi()
    {
        $response = Http::get("https://bsby.siglab.co.id/api/test-programmer", [
            'email' => 'nazman.nadev@gmail.com'
        ]);

        // Mendapatkan data dalam format JSON
        $data = $response->json();

        // Mengolah hasil dari API menjadi collection
        $products = collect($data['results'])->map(fn($item) => (object) $item);

        // Menyimpan data produk ke dalam database
        foreach ($products as $product) {
            Product::create([
                'type' => $product->type,
                'name' => $product->name,
                'status' => $product->status,
                'price' => $product->price,
                'discount' => $product->discount,
                'attachment' => $product->attachment,
            ]);
        }
        
        alert()->success('Success','Fetch data from API Success.');
        return redirect()->route('product');
    }
}
