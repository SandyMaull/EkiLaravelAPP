<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNoteComesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('note_comes', function (Blueprint $table) {
            $table->id();
            $table->foreignId("item_id")->constrained("items");
            $table->foreignId("note_id")->constrained("notes");
            $table->boolean('verify');
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
        Schema::dropIfExists('note_comes');
    }
}
