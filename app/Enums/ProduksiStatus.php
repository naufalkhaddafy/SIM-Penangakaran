<?php

namespace App\Enums;

enum ProduksiStatus:string {

    case Inkubator = 'inkubator';
    case Hidup = 'hidup';
    case Mati = 'mati';
    case Dijual = 'dijual';
    case Terjual = 'terjual';
    case Indukan = 'indukan';

}
