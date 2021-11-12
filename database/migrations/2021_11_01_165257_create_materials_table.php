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
            $table->string('subject');
            $table->longText('description');
            $table->string('url');
            $table->string('type');
			$table->string('level'); 
			$table->string('keywords');
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
