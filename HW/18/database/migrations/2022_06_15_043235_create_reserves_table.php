<?php

use App\Models\Station;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reserves', function (Blueprint $table) {
            $table->id();
            $table->string('track_code');
            $table->integer('price');
            $table->string('service');
            $table->foreignIdFor(User::class);
            $table->foreignIdFor(Station::class);
            $table->string('day');
            $table->string('open_time');
            $table->string('exit_time');
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
        Schema::dropIfExists('reserves');
    }
};
