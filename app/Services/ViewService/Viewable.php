<?php

namespace App\Services\ViewService;

interface Viewable
{
    public function incrementViewStat(ViewType $type): void;
}
