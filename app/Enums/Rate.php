<?php

namespace App\Enums;

enum Rate: int
{
    case Like = 1;
    case Dislike = -1;
    case Neutral = 0;
}
