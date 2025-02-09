<?php
declare(strict_types = 1);

namespace Api\Classes\Controller;

use Api\Classes\Model\Test;

class TestList {
    use Controller;

    public function getTests(): static
    {
        $this->ret = Test::where('enabled', true)
            ->get(['id', 'name'])
            ->toArray();

        return $this;
    }
}