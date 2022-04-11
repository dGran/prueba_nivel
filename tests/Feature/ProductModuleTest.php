<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductModuleTest extends TestCase
{
    // use RefreshDatabase;

    /** @test */
    function it_loads_the_products_list_page()
    {
        $this->get('/products')
            ->assertStatus(200);
    }

    // /** @test */
    // function it_loads_the_products_detail_page()
    // {
    //     $this->get('/products/AL-109894')
    //         ->assertStatus(200);
    // }
}
