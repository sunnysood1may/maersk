<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
			$table->bigInteger('department_id')->default('0');
			$table->string('name',250)->nullable();
			$table->string('salary',250)->nullable();
            $table->timestamps();
			$table->foreign('department_id')->references('id')->on('department');
        });
		Schema::enableForeignKeyConstraints();
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employees');
		Schema::disableForeignKeyConstraints();
    }
}
