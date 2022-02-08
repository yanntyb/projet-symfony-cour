<?php

namespace App\Service;

use App\Interface\UniqTypeGeneratorInterface;
use Exception;

class TokenGeneratorService implements UniqTypeGeneratorInterface
{

    /**
     * @throws Exception
     */
    public function generate(): string
    {
        return bin2hex(random_bytes(20));
    }
}