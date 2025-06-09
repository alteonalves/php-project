<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create(
            'vehicles',
            function (Blueprint $table) {
                $table->id();
                $table->string('vehicle', 50);
                $table->string('brand', 40);
                $table->integer('year');
                $table->text('description')->nullable(true);
                $table->boolean('sold')->default(false);
                // Unique constraint across vehicle, brand, and model
                $table->unique(
                    ['vehicle', 'brand', 'year'],
                    'vehicle_brand_year_unique'
                );
                $table->timestamps();
            }
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
