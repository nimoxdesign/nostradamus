<?php

namespace App\Factory\Catalog;

use App\Klosterke;
use App\Entity\EntityInterface;
use App\Entity\Catalog\Category;
use App\Decorator\Catalog\Category\AbbyBeerDecorator;
use App\Decorator\Catalog\Category\BbqDecorator;
use App\Decorator\Catalog\Category\RedWineDecorator;
use App\Decorator\Catalog\Category\WhiteWineDecorator;

class CategoryFactory
{
    /**
     * Product quality will decline differently based on category type
     * Factory will return a Category Entity or a decorated Category Entity
     */
    public static function create(string $name): EntityInterface
    {
        $category = new Category;

        switch ($name) {
            case Klosterke::TYPE_REDWINE:
                $category = new RedWineDecorator($category);
                break;
            case Klosterke::TYPE_WHITEWINE:
                $category = new WhiteWineDecorator($category);
                break;
            case Klosterke::TYPE_BBQ;
                $category = new BbqDecorator($category);
                break;
            case Klosterke::TYPE_ABBYBEER:
                $category = new AbbyBeerDecorator($category);
                break;
            default:
                // no decoration
        }

        $category->setName($name);

        return $category;
    }
}
