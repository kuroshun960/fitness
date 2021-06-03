<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

use App\Models\User;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */


     
    //テストコードサンプル

    public function test_add()
    {
        $sample = new User;
        $sum = $sample->add(5, 3);
        $this->assertEquals(8, $sum);
    }

}
