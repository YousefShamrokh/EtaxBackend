<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
       Schema::create('books', function (Blueprint $table) {
        $table->softDeletes();
        $table->id();
        $table->string('name');
        $table->string('publisher_name');
        $table->date('publish_date');
        $table->timestamps();
        $table->foreignId('added_by')->constrained('users','id');
       });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
