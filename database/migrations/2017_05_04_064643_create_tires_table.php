<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTiresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tires', function (Blueprint $table) {
            $table->increments('id');
            $table->string('season',1)->nullable();           //Сезон
            $table->string('code77',15)->unique();           //Номенклатура.Код77
            $table->string('article',15)->nullable();          //Номенклатура.Артикул
            $table->string('name',100)->nullable();             //Номенклатура.Наименование
            $table->string('brand',50)->nullable();            //Номенклатура.Бренд
            $table->string('model',50)->nullable();            //Номенклатура.Общ. Модель
            $table->string('dia',5)->nullable();              //Номенклатура.Шины Диаметр
            $table->string('width',5)->nullable();            //Номенклатура.Шины Ширина
            $table->string('section',20)->nullable();          //Номенклатура.Шины Профиль
            $table->string('speed_k',1)->nullable();          //Номенклатура.Шины Коэффициент скороости
            $table->string('load_k',10)->nullable();           //Номенклатура.Шины Коэффициент нагрузки
            $table->boolean('discount')->default(false);         //Уценка
            $table->decimal('price_b2b')->nullable();        //Цена B2B
            $table->decimal('retail_price')->nullable();     //Розничная цена
            $table->decimal('min_price')->nullable();        //Рекомендованная минимальная цена интернет-магазинов.
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tires');
    }
}
