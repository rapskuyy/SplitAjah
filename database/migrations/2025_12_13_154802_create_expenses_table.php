<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
public function up(): void{
    Schema::create('expenses', function (Blueprint $table) {
        $table->id();
        $table->foreignId('group_id')->constrained()->onDelete('cascade');
        $table->string('description');
        $table->decimal('total_amount', 10, 2);
        $table->string('receipt_path')->nullable();
        $table->foreignId('created_by')->constrained('users');
        $table->timestamps();
        });
    }
};
