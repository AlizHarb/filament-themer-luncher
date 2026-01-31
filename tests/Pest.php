<?php

use AlizHarb\ThemerLuncher\Tests\TestCase;
use Livewire\Livewire;

function livewire(string $component, array $params = [])
{
    return Livewire::test($component, $params);
}

uses(TestCase::class)->in(__DIR__);
