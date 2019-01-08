<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExpenseTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public function testUserCanAddExpense()
    {
        $company = factory(\App\Company::class)->create();
        $user = factory(\App\User::class)->create(['company_id' => $company->id]);
        $supplier = factory(\App\Supplier::class)->create(['user_id' => $user->id]);
        $product1 = \App\Product::create([
            'title' => 'urun1', 
            'sell_price' => '33', 
            'buy_price' => '22', 
            'tax' => '18', 
            'user_id' => $user->id
        ]);
        $product2 = \App\Product::create([
            'title' => 'urun2', 
            'sell_price' => '50', 
            'buy_price' => '30', 
            'tax' => '18', 
            'user_id' => $user->id
        ]);
        $this->actingAs($user);

        
        $this->post('/expenses', [
            'desc' => 'faturaAciklama1',
            'supplier' => $supplier->id,
            'expense_date' => $this->faker->dateTime($max = 'now', $timezone = null),
            'status' => 'not paid',
            'payment_date' => $this->faker->dateTime($max = 'now', $timezone = null),
            'title' => [$product1->id, $product2->id],
            'amount' => ['10', '30'],
            'price' => [$product1->sell_price, $product2->sell_price],
            'tax' => [$product1->tax, $product2->tax],
        ]);

        
        $this->assertDatabaseHas('expenses', [
            'description' => request('desc'),
            'supplier_id' => request('supplier'),
            'user_id' => $user->id,
            'expense_date' => request('expense_date'),
            'payment_date' => request('payment_date'),
            'status_id' => \App\Status::where('title', request('status'))->first()->id
        ]);

        for ($i=0; $i < count(request('title')) ; $i++)
        {
            $this->assertDatabaseHas('expense_products', [
                'price' => request('price')[$i],
                'amount' => request('amount')[$i],
                'tax' => request('tax')[$i],
                'product_id' => request('title')[$i],
                'user_id' => $user->id
            ]);
        }




    }
}
