<?php

namespace App\Interface;

interface UniqTypeGeneratorInterface
{

    /**
     * Generate uniq string or int
     * @return string|int
     */
    public function generate(): string|int;
}