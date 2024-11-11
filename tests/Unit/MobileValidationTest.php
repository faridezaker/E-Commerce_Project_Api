<?php

namespace Tests\Unit;

use App\Rules\ValidMobile;
use PHPUnit\Framework\TestCase;

class MobileValidationTest extends TestCase
{
    /**
     * @return void
     */
    public function test_mobile_can_not_be_less_than_9_character()
    {
        $result = (new ValidMobile())->passes('', '93696936');
        $this->assertFalse($result);
    }

    public function test_mobile_can_be_not_more_than_10_character()
    {
        $result = (new ValidMobile())->passes('', '93696936360');
        $this->assertFalse($result);
    }

    public function test_mobile_should_be_start_9_character()
    {
        $result = (new ValidMobile())->passes('', '83696936360');
        $this->assertFalse($result);
    }
}
