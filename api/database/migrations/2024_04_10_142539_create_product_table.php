<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('product', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255)->unique()->nullable(false);
            $table->decimal('net_price', 10, 2)->nullable(false);
            $table->decimal('gross_price', 10, 2)->nullable(false);
            $table->text('description')->nullable(true);
            $table->timestampTz('created_at')->nullable(false);
            $table->timestampTz('updated_at')->nullable(true);
        });

        DB::statement('CREATE INDEX idx_product_name ON product USING GIN (name gin_trgm_ops);');
        DB::statement('CREATE INDEX idx_product_description ON product USING GIN (description gin_trgm_ops);');
        DB::statement('CREATE INDEX idx_product_net_price ON product ("net_price");');
        DB::statement('CREATE INDEX idx_product_gross_price ON product ("gross_price");');
        DB::statement('CREATE INDEX idx_product_created_at ON product ("created_at");');
        DB::statement('CREATE INDEX idx_product_updated_at ON product ("updated_at");');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product');
    }
};
