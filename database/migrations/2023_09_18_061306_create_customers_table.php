<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
        // Имя Поставшика	Специальность	Имя Клиента	Время Приема
            $table->id();
            $table->unsignedBigInteger('supplier_id');
            $table->string('supplier_name');
            $table->string('speciality');
            $table->string('customer_name');
            $table->string('email');
            $table->string('number');
            $table->string('comment');
            $table->timestamp('time');
            $table->timestamps();
            $table->foreign('supplier_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers');
    }
};
