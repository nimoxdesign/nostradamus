<?php

namespace App\Entity\Catalog;

use App\Entity\EntityInterface;

class Category implements EntityInterface
{
    protected string $name;

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getMinumalQualityThreshold()
    {
        return 0;
    }

    public function getMaximumQualityThreshold()
    {
        return 50;
    }

    /**
     * Returns a real number to calculate decline with
     * Actual decline in quality is a negative number (e.g. -1, -2, -3)
     * Better quality is positive decline (e.g. 1, 2, 3)
     */
    public function getQualityDecline(int $daysToSell): int
    {
        // Decline quality by 1 if there are still days left to sell
        if ($daysToSell >= 0) {
            return -1;
        }

        // When there are no days left for selling, decline quality by 2
        return -2;
    }
}
