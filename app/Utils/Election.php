<?php

namespace App\Utils;

use DivisionByZeroError;
use Illuminate\Support\Facades\Log;

class Election
{
    protected $totalNumberVoters;
    protected $validVotes;
    protected $blankVotes;
    protected $invalidVotes;

    public function __construct(int $totalNumberVoters, int $validVotes, int $blankVotes, int $invalidVotes)
    {
        $this->totalNumberVoters = $totalNumberVoters;
        $this->validVotes = $validVotes;
        $this->blankVotes = $blankVotes;
        $this->invalidVotes = $invalidVotes;
    }

    private function calculatePercentage(int $value): float
    {
        try {
            return ($value / $this->totalNumberVoters) * 100;
        } catch (DivisionByZeroError $e) {
            Log::error("division by zero ".$e->getMessage());
            return 0.0;
        }
    }

    public function getPercentValidVotes(): float
    {
        $percent = $this->calculatePercentage($this->validVotes);
        return $percent;
    }
    public function getPercentInvalidVotes(): float
    {
        $percent = $this->calculatePercentage($this->invalidVotes);
        return $percent;
    }
    public function getPercentBlankVotes(): float
    {
        $percent = $this->calculatePercentage($this->blankVotes);
        return $percent;
    }
}
