<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use \App\Option;

class OptionTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }
    public function testAllViaApi(){
        $options = factory(Option::class, 3)->create();
        $data = $this->get('/api/options');
//        print_r($data);
        $data->assertOk();
        $data->assertJsonCount(3);
    }

    public function testAllViaWeb(){
        $options = factory(Option::class, 3)->create();
        $data = $this->get('/options');
//        print_r($data);
        $data->assertOk();
        $data->assertJsonCount(3);
    }

}
