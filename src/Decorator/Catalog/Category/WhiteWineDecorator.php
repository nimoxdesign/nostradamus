<?php

namespace App\Decorator\Catalog\Category;

use App\Decorator\AbstractDecorator;
use App\Entity\EntityInterface;

class WhiteWineDecorator extends AbstractDecorator implements EntityInterface
{
    public function getQualityDecline(int $daysToSell): int
    {
        if ($daysToSell < 0) {
            return -999; // need to force quality to 0
        }

        $decline = 1;

        if ($daysToSell < 10) {
            $decline++;
        }

        if ($daysToSell < 5) {
            $decline++;
        }

        return $decline;
    }
}
