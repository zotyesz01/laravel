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
        Schema::create('category', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255)->unique()->nullable(false);
            $table->text('description')->nullable(true);
            $table->timestampTz('created_at')->nullable(false);
            $table->timestampTz('updated_at')->nullable(true);
        });

        DB::statement('CREATE INDEX idx_category_name ON category USING GIN (name gin_trgm_ops);');
        DB::statement('CREATE INDEX idx_category_description ON category USING GIN (description gin_trgm_ops);');
        DB::statement('CREATE INDEX idx_category_created_at ON category ("created_at");');
        DB::statement('CREATE INDEX idx_category_updated_at ON category ("updated_at");');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('category');
    }
};
