<?php

namespace Tests\Feature;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductControllerTest extends TestCase
{
    use RefreshDatabase;


    public function test_guest_users_can_index_products()
    {
        $product1 = Product::create([
            'name' => 'Producte 1',
            'description' => 'Bla bla bla 1',
            'image' => 'http://lorempixel.com/400/200/food/1/',
            'price' => '50',
        ]);

        $product2 = Product::create([
            'name' => 'Producte 2',
            'description' => 'Bla bla bla 2',
            'image' => 'http://lorempixel.com/400/200/sports/5/',
            'price' => '40',
        ]);

        $product3 = Product::create([
            'name' => 'Producte 3',
            'description' => 'Bla bla bla 3',
            'image' => 'http://lorempixel.com/400/200/food/2',
            'price' => '30',
        ]);

        $products = [ $product1,$product2,$product3];

        $response = $this->get('/products');

        $response->assertStatus(200);
        $response->assertViewIs('products.index');

        foreach ($products as $product) {
            $response->assertSeeText($product->name);
            $response->assertSeeText($product->description);
            $response->assertSeeText($product->price);
            $response->assertSee($product->image,false);
        }

    }

    public function test_guest_users_can_show_a_product()
    {
        $product = Product::create([
            'name' => 'Producte 1',
            'description' => 'Bla bla bla 1',
            'image' => 'http://lorempixel.com/400/200/food/1/',
            'price' => '50',
        ]);

        $response = $this->get('/products/' .  $product ->id);

        $response->assertStatus(200);
        $response->assertViewIs('products.show');

        $response->assertSeeText($product->name);
        $response->assertSeeText($product->description);
        $response->assertSeeText($product->price);
        $response->assertSee($product->image,false);
    }
}
