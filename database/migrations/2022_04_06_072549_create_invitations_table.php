<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvitationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invitations', function (Blueprint $table) {
            $table->id();
            $table->string('surname')->nullable();
            $table->string('display_name')->nullable();
            $table->string('type')->nullable();
            $table->string('plus_one')->nullable();
            $table->integer('guests')->nullable();
            $table->text('notes')->nullable();
            $table->string('pin')->nullable();
            $table->string('confirmation')->nullable();
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
        Schema::dropIfExists('invitations');
    }
}