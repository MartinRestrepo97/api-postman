<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_database_agricultor_count(): void
    {
        $count = \App\Models\Agricultor::count();
        $this->assertIsInt($count);
        $this->assertGreaterThanOrEqual(0, $count);
    }
}
