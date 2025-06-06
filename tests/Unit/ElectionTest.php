<?php

namespace Tests\Unit;

use App\Utils\Election;
use PHPUnit\Framework\TestCase;

class ElectionTest extends TestCase
{
    public function test_get_percent_valid_votes(): void
    {
        $election = new Election(1000, 800, 100, 100);

        $this->assertEquals(80.0, $election->getPercentValidVotes());
    }

    public function test_get_percent_invalid_votes(): void
    {
        $election = new Election(1000, 800, 100, 100);

        $this->assertEquals(10.0, $election->getPercentInvalidVotes());
    }

    public function test_get_percent_blank_votes(): void
    {
        $election = new Election(1000, 800, 100, 100);

        $this->assertEquals(10.0, $election->getPercentBlankVotes());
    }
}
