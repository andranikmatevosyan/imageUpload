<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('images', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable(false)->unique();
            $table->string('slug')->nullable(false)->unique();
            $table->enum('extension', ['jpg','png','jpeg','gif','svg'])->nullable(false);
            $table->string('short_path')->nullable(false)->unique();
            $table->string('full_path')->nullable(false)->unique();
            $table->text('original_url')->nullable(false);
            $table->integer('life_time')->nullable(true)->default(null);
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
        Schema::dropIfExists('images');
    }
}
