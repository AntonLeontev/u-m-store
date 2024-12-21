<?php

namespace Tests\Feature;

use App\Http\Livewire\CartComponent;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CartTest extends TestCase
{

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_setOrder()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
