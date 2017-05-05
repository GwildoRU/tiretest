<?php

namespace App\Repositories;

use App\Models\Tire;
use DB;

class TireRepository
{
    const MODEL = Tire::class;

    private function getByCode77($code77)
    {
        return Tire::where('code77', $code77)->first();
    }

    public function getTires($name = null, $type = 'begin')
    {
        if (is_null($name)) {
            return Tire::paginate(15);
        }
        else {
            $name = $name.'%';
            if ($type === 'like') {$name = '%'.$name;}
            return Tire::where('name','like',$name)->paginate(15);
        }
    }


    /**
     * загрузка остатков в магазинах средствами MySQL
     *  требует настроек, например:
     *  1) secure-file-priv = "" в my.ini MySQL сервера
     *  2) 'mysql' => [  'options'    => [PDO::MYSQL_ATTR_LOCAL_INFILE=>true], в config/database.php
     */
    public function insertCount()
    {
        DB::table('shop_tire')->delete();
        $csv = storage_path('count.csv');
        $query = sprintf("LOAD DATA INFILE '%s' INTO TABLE `shop_tire` FIELDS TERMINATED BY ',' (
            `shop_id`,
            `tire_id`,
            `tires_count`)", addslashes($csv));

        DB::connection()->getpdo()->exec($query);
    }

    public function create(array $data)
    {
        $tire = $this->getByCode77($data[1]);
        if (is_null($tire)) {
            $tire = self::MODEL;
            $tire = new $tire;
        }
        foreach (config('pricelists.pricelist1.cols') as $key => $val) {
            if ($val === 13) {$data[$val] = (bool)$data[$val];}
            $tire[$key] = $data[$val];
        }
        $tire->save();
        return $tire->id;
    }

}
