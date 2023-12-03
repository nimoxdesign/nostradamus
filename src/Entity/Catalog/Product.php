<?php

namespace App\Entity\Catalog;

use App\Entity\EntityInterface;

class Product implements EntityInterface
{
    protected EntityInterface $category;

    protected string $name;

    protected int $quality;

    protected int $daysToSell;

    public function getCategory(): ?EntityInterface
    {
        return $this->category;
    }

    public function setCategory(EntityInterface $category = null): void
    {
        $this->category = $category;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getQuality(): int
    {
        return $this->quality;
    }

    /**
     * Set quality score
     * Checks if there is a category having a min / max value set for quality
     * if not, will use any value given above 0
     */
    public function setQuality(int $quality): void
    {
        if ($this->getCategory()) {
            $minThreshold = $this->getCategory()->getMinumalQualityThreshold();
            $maxThreshold = $this->getCategory()->getMaximumQualityThreshold();

            if ($quality < $minThreshold) {
                $quality = $minThreshold;
            }

            if ($quality > $maxThreshold) {
                $quality = $maxThreshold;
            }
        }

        if ($quality < 0) {
            $quality = 0;
        }

        $this->quality = $quality;
    }

    /**
     * Updates quality by default values or based on value provided by category rules
     */
    public function updateQuality(): void
    {
        if (!$this->getCategory()) {
            // there are still days left to sell, decline of quality is -1
            if ($this->getDaysToSell() >= 0) {
                $decline = -1;
            } else { // past it's selling point, decline quality by 2
                $decline = -2;
            }
        } else {
            // category is going to decide the amount of decline
            $decline = $this->getCategory()->getQualityDecline($this->getDaysToSell());
        }

        $this->setQuality($this->getQuality() + $decline);
    }

    public function getDaysToSell(): int
    {
        return $this->daysToSell;
    }

    public function setDaysToSell(int $daysToSell): void
    {
        $this->daysToSell = $daysToSell;
    }

    public function decreaseDaysToSell(): void
    {
        // validate any decline in quality, if none, no need to decrease days to sell
        if ($this->getCategory()) {
            $decline = $this->getCategory()->getQualityDecline($this->getDaysToSell());

            if ($decline === 0) {
                return;
            }
        }

        $this->setDaysToSell($this->getDaysToSell() - 1);
    }

    public function tick(): void
    {
        $this->decreaseDaysToSell();
        $this->updateQuality();
    }
}
