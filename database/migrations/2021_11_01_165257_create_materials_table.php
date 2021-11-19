<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaterialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
   public function up()
    {
        Schema::create('materials', function (Blueprint $table) {
            $table->id();
            $table->text('subject');
            $table->longText('description');
            $table->text('url');
            $table->integer('type');
			$table->integer('level'); 
			$table->text('keywords')->nullable();
            $table->integer('rate')->default(0); 
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
        Schema::dropIfExists('materials');
    }
}
