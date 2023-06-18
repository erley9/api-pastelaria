<?php

namespace Tests\Unit;
use App\Models\Product;
use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    public function testListAllProducts()
    {
        $user = User::factory()->create();

        Product::factory()->count(20)->create();

        $response = $this->actingAs($user)->json('GET', '/api/product');

        $response->assertOk();
        $response->assertJsonCount(20, 'products');
        $response->assertJson(['status' => true]);
        $response->assertJson(['message' => "Successfully"]);
    }

    public function testCreateProduct()
    {
        $user = User::factory()->create();

        $data = [
                    'name' => "New Product",
                    'price' => '15.00',
                    'photo' => UploadedFile::fake()->image('photo1.png'),
                ];

        $response = $this->actingAs($user)->json('POST', '/api/product',$data);

        $response->assertStatus(200);
        $response->assertJson(['status' => true]);
        $response->assertJson(['message' => "Product Created Successfully"]);
        $response->assertJson(['status' => true]);
        $response->assertJsonPath('product.name',$data["name"]);
        $response->assertJsonPath('product.price',$data["price"]);
        $this->assertDatabaseCount('products', 1);
    }


    public function testUpdateProduct()
    {
        $user = User::factory()->create();

        $produto = Product::find(1);

        dd($produto);

         $data = [
            'name' => "New Product2",
            'price' => '16.00',
            'photo' => UploadedFile::fake()->image('photo2.png'),
            '_method' => 'put'
         ];

        $response = $this->actingAs($user)->put('/api/product/1',$data);

        $response->assertStatus(200);
        $response->assertJson(['status' => true]);
        $response->assertJson(['message' => "Update Product Successfully"]);
        $response->assertJson(['status' => true]);
        $response->assertJsonPath('product.name',$data["name"]);
        $response->assertJsonPath('product.price',$data["price"]);

    }





    // public function testUpdateProduct()
    // {
    //     $response = $this->json('GET', '/api/products');
    //     $response->assertStatus(200);

    //     $product = $response->getData()[0];

    //     $user = factory(\App\User::class)->create();
    //     $update = $this->actingAs($user, 'api')->json('PATCH', '/api/products/'.$product->id,['name' => "Changed for test"]);
    //     $update->assertStatus(200);
    //     $update->assertJson(['message' => "Product Updated!"]);
    // }

    // public function testUploadImage()
    // {
    //         $response = $this->json('POST', '/api/upload-file', [
    //             'image' => UploadedFile::fake()->image('image.jpg')
    //         ]);
    //         $response->assertStatus(201);
    //         $this->assertNotNull($response->getData());
    // }

    // public function testDeleteProduct()
    // {
    //     $response = $this->json('GET', '/api/products');
    //     $response->assertStatus(200);

    //     $product = $response->getData()[0];

    //     $user = factory(\App\User::class)->create();
    //     $delete = $this->actingAs($user, 'api')->json('DELETE', '/api/products/'.$product->id);
    //     $delete->assertStatus(200);
    //     $delete->assertJson(['message' => "Product Deleted!"]);
    // }
}
