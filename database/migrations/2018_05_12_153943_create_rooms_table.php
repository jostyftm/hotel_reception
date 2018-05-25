<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->bigIncrements('id');

            // Relacion con el tipo de habitación
            $table->unsignedBigInteger('room_type_id');
            $table->foreign('room_type_id')
            ->references('id')
            ->on('room_types')
            ->onDelete('cascade');

            $table->string('name')->unique();
            $table->longText('description')->nullable();
            $table->enum('state', ['busy', 'no_busy', 'cleaning'])->default('no_busy');
            
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
        Schema::dropIfExists('rooms');
    }
}
