<?php

namespace App\Decorator\Catalog\Category;

use App\Decorator\AbstractDecorator;
use App\Entity\EntityInterface;

class RedWineDecorator extends AbstractDecorator implements EntityInterface
{
    public function getQualityDecline(int $daysToSell): int
    {
        // instead of decline, red wine will increase.
        // default rules for passed days to sell = -2, red wine has +2
        // default rules for left days to sell = -1, red wine has +1

        if ($daysToSell <= 0) {
            return 2;
        }

        return 1;
    }
}
