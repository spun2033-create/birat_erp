<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->nullable();
            $table->date('date_ad');
            $table->string('date_bs')->nullable();
            $table->time('check_in')->nullable();
            $table->time('check_out')->nullable();
            $table->decimal('hours', 5, 2)->default(0);
            $table->string('status')->default('present');
            $table->text('remarks')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('attendances');
    }
};
