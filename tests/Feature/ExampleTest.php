<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_callback_untuk_fowarder(){
        
        $data = array(
            "title" => "Hallo world"
        );
        $response = $this->post("/api/fowarder",$data);

        $response->assertStatus(200);
    }
}
