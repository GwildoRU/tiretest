<?php

namespace App\Services;

use App\Repositories\TireRepository;
use App\Repositories\ShopRepository;
use File;
use PHPExcel_Cell;
use PHPExcel_IOFactory;

class PricelistService
{

    private $trep;
    private $shrep;

    /**
     * PricelistService constructor.
     * @param $trep
     */
    public function __construct(TireRepository $trep, ShopRepository $shrep)
    {
        $this->trep = $trep;
        $this->shrep = $shrep;
    }


    public function upload($file)
    {
        $objPHPExcel = PHPExcel_IOFactory::load(storage_path('upload/'.$file));
        foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) {
            $count_data = array();
            $highestRow = $worksheet->getHighestRow();
            $highestColumn = $worksheet->getHighestColumn();
            $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);
            $begDataRow = config('pricelists.pricelist1.begin_data_row_n');
            $titleRow = config('pricelists.pricelist1.titles_row_n');
            $begShopCol = config('pricelists.pricelist1.begin_shop_col_n');
            for ($row = 1; $row < $highestRow; ++ $row) {
                if ($row === $titleRow) { // грузим магазины
                    $row_data = array();
                    for ($col = $begShopCol; $col < $highestColumnIndex; ++ $col) {
                        $cell = $worksheet->getCellByColumnAndRow($col, $row);
                        $row_data[$col] = $cell->getValue();
                    }
                    $shop_ids = $this->shrep->create($row_data);
                }

                if ($row >= $begDataRow) { // грузим шины
                    $row_data = array();
                    for ($col = 0; $col < $highestColumnIndex; ++ $col) {
                        $cell = $worksheet->getCellByColumnAndRow($col, $row);
                        array_push($row_data,$cell->getValue());
                    }
                    $tire_id = $this->trep->create($row_data);

                    // готовим массив остатков в магазинах
                    $begShopCol = config('pricelists.pricelist1.begin_shop_col_n');
                    foreach ($row_data as $col => $val) {
                        if (($col >= $begShopCol)&&(!is_null($val))) {
                            $shop_id = $shop_ids[$col];
                            if (!is_null($shop_id)){
//                                array_push($count_data,$shop_id.','.$tire_id.','.$val.PHP_EOL);
                                array_push($count_data,'0,'.$shop_id.','.$tire_id.','.$val.PHP_EOL);
                            }
                        }
                    }
                }
            }
            File::put(storage_path('count.csv'), $count_data); // сохраняем остатки в файл
//            $this->trep->insertCount(); // загружаем файл средствами MySQL
        }
    }
}


