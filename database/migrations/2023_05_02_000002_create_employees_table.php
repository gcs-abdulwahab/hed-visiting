<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('employee_code')->unique();
            $table->string('name');
            $table->string('father_name');
            $table->string('bank_account_number');
            $table->string('designation');
            $table->enum('employee_type', ['teaching', 'non_teaching']);
            $table->foreignId('department_id')->constrained()->onDelete('cascade');
            $table->decimal('inter_rate', 10, 2)->nullable();
            $table->decimal('bs_rate', 10, 2)->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('employees');
    }
}; 