<?php

namespace App;

enum ProductType: int
{
    case FOOD                       = 1;
    case PHARMACEUTICALS                    = 2;
    case GOVERNMENT                  = 3;
    case TRADITIONAL                = 4;
    case BEAUTY                    = 13;
    case MEDIA                   = 14;
    case K3L                        = 15;
    case ALKES                      = 16;
    case FEED  = 17;
    case OTHERS  = 18;
    case RESEARCH  = 19;
    case DIOXINE  = 20;

    public function alias(): string
    {
        return match ($this)
        {
            ProductType::FOOD                       => 'Food & Baverages',
            ProductType::PHARMACEUTICALS                    => 'Pharmaceuticals',
            ProductType::GOVERNMENT                  => 'Government',
            ProductType::TRADITIONAL                => 'Traditional Medicine & Suplement',
            ProductType::BEAUTY                    => 'Beauty, Cosmetics & Personal Care',
            ProductType::MEDIA                   => 'Media RTU',
            ProductType::K3L                        => 'K3L Products',
            ProductType::ALKES                      => 'ALKES & PKRT',
            ProductType::FEED  => 'Feed, Pesticides & PSAT',
            ProductType::OTHERS  => 'Others',
            ProductType::RESEARCH  => 'Research / Academic Purpose',
            ProductType::DIOXINE  => 'Dioxine Udara',
        };
    }
}
