<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLectureRecordsTable extends Migration
{
    public function up()
    {
        Schema::create('lecture_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained()->onDelete('cascade');
            $table->foreignId('monthly_billing_id')->constrained()->onDelete('cascade');
            $table->enum('lecture_type', ['inter', 'bs']);
            $table->integer('lecture_count');
            $table->decimal('amount', 10, 2);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('lecture_records');
    }
}
