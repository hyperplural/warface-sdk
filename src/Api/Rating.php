<?php

declare(strict_types=1);

namespace Hyperplural\WarfaceSdk\Api;

use Hyperplural\WarfaceSdk\Enum\EntityList;
use Hyperplural\WarfaceSdk\Enum\GameClass;
use Hyperplural\WarfaceSdk\Enum\RatingLeague;

use function compact;

class Rating extends AbstractApi implements RatingInterface
{
    public function clan(): array
    {
        return $this->getByMethod(__FUNCTION__);
    }

    public function monthly(?string $clan = null, ?RatingLeague $league = null, int $page = 0): array
    {
        $league = ($league ?? RatingLeague::NONE)->value;

        return $this->getByMethod(__FUNCTION__, ['clan' => $clan, 'league' => $league, 'page' => $page]);
    }

    public function top100(?GameClass $class = null): array
    {
        $class = ($class ?? GameClass::NONE)->value;

        return $this->getByMethod(__FUNCTION__, ['class' => $class]);
    }

    protected function entity(): EntityList
    {
        return EntityList::RATING;
    }
}
