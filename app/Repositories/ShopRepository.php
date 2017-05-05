<?php

namespace App\Repositories;

use App\Models\Shop;

class ShopRepository
{
    const MODEL = Shop::class;

    private function getByCol($col)
    {
        return Shop::where('col', $col)->first();
    }

    static public function getIdByCol($col)
    {
        return Shop::where('col',$col)->value('id');
    }


    public function create(array $data)
    {
        $shop_ids = array();
        foreach ($data as $col => $name) {
            $shop = $this->getByCol($col);
            if (is_null($shop)) {
                $shop = self::MODEL;
                $shop = new $shop;
            }
            $shop->col = $col;
            $shop->name = $name;
            $shop->save();
            $shop_ids[$col] = $shop->id;
        }
        return $shop_ids;
    }

}
