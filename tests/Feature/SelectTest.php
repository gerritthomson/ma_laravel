<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use \App\Option;
use \App\Select;

class SelectTest extends TestCase
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

    /**
     * Use the factories to creatred temporary data.
     * Prove that using a one to many assignment operation assigns foreign key and saves.
     */
    public function testSameSelect(){
        /** @var  $selects */
        $selects = factory(Select::class, 3)
            ->create()
            ->each(function ($select) {
                $options = factory(Option::class,5)->make()->each(function($option) use($select) {
                    $select->options()->save($option);
                });
            });
        foreach($selects as $select){
            $uri = '/api/selectwithoptions/'.$select->id;
//            var_dump($uri);
            $data = $this->get($uri);
            $data->assertOk();
//            print_r($data);
//            $this->assertCount(1, $data->dump());

        }

    }

}
