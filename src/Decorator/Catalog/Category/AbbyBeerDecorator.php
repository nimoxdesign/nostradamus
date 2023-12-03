<?php

namespace App\Decorator\Catalog\Category;

use App\Decorator\AbstractDecorator;
use App\Entity\EntityInterface;

class AbbyBeerDecorator extends AbstractDecorator implements EntityInterface
{
    public function getQualityDecline(int $daysToSell): int
    {
        if ($daysToSell > 0) {
            return -2;
        }

        return -4;
    }
}
