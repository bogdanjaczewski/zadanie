<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Product;

class ProductsTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_products_endpoint()
    {
        $response = $this->get('/api/product');

        $response->assertStatus(200);
    }
    
    
    public function test_product_endpoint()
    {
        $product = Product::inRandomOrder()->first();
        $response = $this->get('/api/product/'.$product->id);

        $response->assertStatus(200);
    }
}
