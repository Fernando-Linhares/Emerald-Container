<?php

namespace Tests\Examples;


class Application implements ApplicationInterface
{
    public function implemented():bool
    {
        return true;
    }
}