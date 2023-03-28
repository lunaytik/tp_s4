<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class AppExtension extends  AbstractExtension
{
    public function getFilters()
    {
        return [
            new TwigFilter('price', [$this, 'formatPrice']),
            new TwigFilter('stars', [$this, 'stars'], ['is_safe' => ['html']])
        ];
    }

    public function stars($note)
    {
        $html = '';
        for ($i = 0; $i < $note; $i++) {
            $html .= '<i class="fas fa-star"></i>'; //sous réserve que fontawesome soit chargé
        }
        for ($i = 0; $i < 5 - $note; $i++) {
            $html .= '<i class="far fa-star"></i>'; //sous réserve que fontawesome soit chargé
        }
        return $html;
    }

    public function formatPrice($number)
    {
        $price = number_format($number, 2);
        return $price . ' €';
    }
}