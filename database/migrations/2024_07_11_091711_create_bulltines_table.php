<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bulltines', function (Blueprint $table) {
            $table->id();
            $table->datetime('date')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->float('salaire_brut')->default(0);
            $table->float('total_deduction')->default(0);
            $table->float('salaire_net')->default(0);
            $table->unsignedBigInteger('salarie_id');
            $table->foreign('salarie_id')->references('id')->on('salaries')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bulltines');
    }
};
