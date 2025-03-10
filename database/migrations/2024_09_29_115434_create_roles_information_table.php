<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('roles_information', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->text('expectations');
            $table->text('overview')->nullable();
            $table->foreignId('company_id')->constrained('company')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('roles_information');
    }
}; 