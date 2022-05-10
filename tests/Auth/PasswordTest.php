<?php

require_once dirname(__DIR__, 2) . '/vendor/solital/core/src/Resource/Helpers/security.php';

use PHPUnit\Framework\TestCase;
use Solital\Core\Auth\Password;

class PasswordTest extends TestCase
{
    public function testPassword()
    {
        $pass = new Password();
        $hash = $pass->create('solital');
        $this->assertIsString($hash);
    }

    public function testPasswordVerify()
    {
        $pass = new Password();
        $hash = $pass->create('solital');
        $res = $pass->verify('solital', $hash);
        $this->assertTrue($res);
    }

    public function testNeedsHash()
    {
        $pass = new Password();
        $res = $pass->needsRehash('solital', '$argon2i$v=19$m=65536,t=4,p=1$S0J6dTRQLi9JNlc1MnRwVA$QIMBViFqDQnC0RAbVojO/iCxZnsEaLeBFhFIYSwrvps');
        $this->assertIsString($res);
    }

    public function testNoNeedsHash()
    {
        $pass = new Password();
        $res = $pass->needsRehash('solital', '$2y$10$fV.mcihFuJL3wLuTmXShPO0vrKB6GY9/ykMmUHif.RGJp.sv9SkKC');
        $this->assertFalse($res);
    }

    public function testHelpers()
    {
        $hash = pass_hash('solital');
        $res = pass_verify('solital', $hash);
        $this->assertTrue($res);
    }
}
