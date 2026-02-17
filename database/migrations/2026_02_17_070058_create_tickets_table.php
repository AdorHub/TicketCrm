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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
			$table->integer('customer_id')->unsigned();
			$table->string('subject');
			$table->string('text');
			$table->enum('status', ['new', 'processing', 'processed'])->default('new');
			$table->timestamp('response_date')->nullable();
            $table->timestamps();

			$table->foreign('customer_id')->references('id')->on('customers');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
