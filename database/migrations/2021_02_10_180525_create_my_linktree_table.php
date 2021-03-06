<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMyLinktreeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('my_linktrees', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('imagesTema_id');
            $table->string('links_font')->nullable();
            $table->string('links_color')->nullable();
            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            
            $table->foreign('imagesTema_id')
                ->references('id')->on('images_temas')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('my_linktree');
    }
}
