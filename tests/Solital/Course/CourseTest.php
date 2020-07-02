<?php

use \PHPUnit\Framework\TestCase;

class CourseTest extends TestCase
{
    /** @test */
    public function courseTest()
    {
        $result = false;
        \Solital\Core\Course\Course::get('/', function () use ($result) {
            $result = true;
        });

        $this->assertTrue($result);
    }
}
