<?php

declare(strict_types=1);

namespace Hyperplural\WarfaceSdk\Api;

use Hyperplural\WarfaceSdk\Enum\EntityList;

class Achievement extends AbstractApi implements AchievementInterface
{
    public function catalog(): array
    {
        return $this->getByMethod(__FUNCTION__);
    }

    protected function entity(): EntityList
    {
        return EntityList::ACHIEVEMENT;
    }
}
