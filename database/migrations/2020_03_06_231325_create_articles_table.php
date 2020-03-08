<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('ShortDesc');
            $table->text('desc');
            $table->double('price');
            $table->double('discountFromPrice');
            $table->bigInteger('currency');
            $table->bigInteger('tax');
            $table->bigInteger('were');
            $table->bigInteger('votes_like');
            $table->bigInteger('votes_unlike');
            $table->string('image');
            
            $table->enum('status', ['hide', 'show','ontop','ads' ]);
            $table->integer('OnTopNumber');
            /// json Tags ....  $table->text('tags');
           /// json New prop ....  $table->text('prop');
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
        //
        Schema::dropIfExists('failed_jobs');
    }
}
