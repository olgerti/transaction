<?php

namespace Tests;

use PHPUnit\Framework\TestCase as BaseTestCase;

class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected $container;

    public function setUp() :void
    {
        parent::setUp();
        $this->container = $this->createApplication();
    }
}
