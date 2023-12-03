<?php

namespace App;

use App\Entity\Catalog\Product;
use App\Factory\Catalog\CategoryFactory;

class Klosterke
{
    public const TYPE_DEFAULT = 'normal';
    public const TYPE_REDWINE = 'Rode Wijn';
    public const TYPE_WHITEWINE = 'Witte Wijn';
    public const TYPE_BBQ = 'BBQ';
    public const TYPE_ABBYBEER = 'Kloosterbier';

    public static function getProduct($categoryName, $productName, $quality, $daysToSell) {
        $product = new Product;
        $category = CategoryFactory::create($categoryName);

        $product->setCategory($category);
        $product->setName($productName);
        $product->setQuality($quality);
        $product->setDaysToSell($daysToSell);

        return $product;
    }
}
