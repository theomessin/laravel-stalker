<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStalkerEntriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stalker_entries', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->nullableMorphs('stalkable');
            $table->string('url');
            $table->string('method');
            $table->ipAddress('ip_address');
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
        Schema::dropIfExists('stalker_entries');
    }
}
