<?php

declare(strict_types=1);

namespace Hyperplural\WarfaceSdk\Enum;

enum EntityList: string
{
    case ACHIEVEMENT = 'achievement';
    case CLAN        = 'clan';
    case GAME        = 'game';
    case RATING      = 'rating';
    case USER        = 'user';
}
