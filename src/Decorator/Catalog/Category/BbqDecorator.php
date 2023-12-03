<?php

namespace App\Decorator\Catalog\Category;

use App\Decorator\AbstractDecorator;
use App\Entity\EntityInterface;

class BbqDecorator extends AbstractDecorator implements EntityInterface
{
    public function getMaximumQualityThreshold()
    {
        return 80;
    }

    public function getQualityDecline(int $daysToSell): int
    {
        return 0;
    }
}
