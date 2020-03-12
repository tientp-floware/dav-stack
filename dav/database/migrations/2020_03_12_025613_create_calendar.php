<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCalendar extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $sql = realpath(__DIR__.'/../sql/mysql.calendars.sql');
        
		DB::unprepared(file_get_contents($sql));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('schedulingobjects');
		Schema::dropIfExists('calendarsubscriptions');
		Schema::dropIfExists('calendarchanges');
		Schema::dropIfExists('calendarinstances');
		Schema::dropIfExists('calendars');
		Schema::dropIfExists('calendarobjects');
    }
}
