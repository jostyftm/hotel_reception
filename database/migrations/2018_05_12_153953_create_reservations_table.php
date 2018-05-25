<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->bigIncrements('id');

            // Relacion con la habitación
            $table->unsignedBigInteger('room_id');
            $table->foreign('room_id')
            ->references('id')
            ->on('rooms')
            ->onDelete('cascade');

            // Relacion con el cliente
            $table->unsignedBigInteger('client_id');
            $table->foreign('client_id')
            ->references('id')
            ->on('users')
            ->onDelete('cascade');

            $table->enum('state', ['busy', 'no_busy', 'pending', 'canceled'])->default('busy');
            $table->double('price')->default(0);
            $table->timestamp('date_entry')->nullable();
            $table->timestamp('date_exit')->nullable();

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
        Schema::dropIfExists('reservations');
    }
}
