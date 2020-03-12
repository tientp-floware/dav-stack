<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressbooks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		$sql = realpath(__DIR__.'/../sql/mysql.addressbooks.sql');
		DB::unprepared(file_get_contents($sql));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
		Schema::dropIfExists('addressbookchanges');
		Schema::dropIfExists('cards');
		Schema::dropIfExists('addressbooks');

    }
}
