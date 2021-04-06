<?php

namespace grigor\blog\module\post\api\dto;

class CategoriesDto
{
    public string $main;
    public array $others = [];

    /**
     * CategoriesDto constructor.
     * @param string $main
     * @param array $others
     */
    public function __construct(string $main, array $others = [])
    {
        $this->main = $main;
        $this->others = $others;
    }

}