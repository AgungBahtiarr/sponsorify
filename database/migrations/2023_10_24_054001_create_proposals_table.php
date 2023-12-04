<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('proposals', function (Blueprint $table) {
            $table->id();
            $table->string('proposal')->nullable(false);
            $table->text('message')->default('')->nullable(true);
            $table->unsignedBigInteger('id_sponsorship')->nullable(false);
            $table->unsignedBigInteger('id_event')->nullable(false);
            $table->unsignedBigInteger('id_users')->nullable(false);
            $table->unsignedBigInteger('id_status')->default(1)->nullable(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proposals');
    }
};
