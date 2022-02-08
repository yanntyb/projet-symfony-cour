<?php

namespace App\Service;

use App\Interface\UniqTypeGeneratorInterface;

class StringGeneratorService implements UniqTypeGeneratorInterface
{
    public function generate(): string|int
    {
        return uniqid();
    }
}