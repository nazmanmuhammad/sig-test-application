<?php

namespace App\Console\Commands;

use App\Models\Product;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class ImportProductsFromApi extends Command
{
    // Nama dan signature command
    protected $signature = 'import:products-from-api';

    // Deskripsi command
    protected $description = 'Fetch products data from API and store it in the database';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        // Menampilkan pesan sebelum mengambil data
        $this->info('Fetching data from API...');

        // Mengambil data dari API
        $response = Http::get("https://bsby.siglab.co.id/api/test-programmer", [
            'email' => 'nazman.nadev@gmail.com'
        ]);

        // Mengecek jika API memberikan response yang valid
        if ($response->failed()) {
            $this->error('Failed to fetch data from API.');
            return;
        }

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

        // Memberikan informasi bahwa data telah berhasil diimpor
        $this->info('Products have been imported successfully!');
    }
}
