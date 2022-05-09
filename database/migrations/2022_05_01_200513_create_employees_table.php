<?php

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
        Schema::create('employees', function (Blueprint $table) {
            $table->increments('empID');
            $table->string('full_name',30);
            $table->string('phone',30);
            $table->string('email',30);
            $table->string('accNo',30);
            $table->string('address',30);
            $table->integer('roleID',30);
            $table->string('base_salary',50);
            $table->string('password');
            $table->date('joinedDate');
            $table->date('status');
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
        Schema::dropIfExists('employees');
    }
};
