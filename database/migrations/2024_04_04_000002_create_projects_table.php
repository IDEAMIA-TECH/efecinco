<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description');
            $table->text('content');
            $table->string('client_name');
            $table->string('client_logo')->nullable();
            $table->date('project_date');
            $table->foreignId('service_id')->constrained()->onDelete('cascade');
            $table->enum('status', ['completed', 'in_progress'])->default('completed');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('projects');
    }
}; 