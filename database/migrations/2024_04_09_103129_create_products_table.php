<?php

declare(strict_types=1);

use Domain\Brand\Models\Brand;
use Domain\Catalog\Models\Category\Category;
use Domain\Catalog\Models\Product\Product;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('title');

            $table->string('slug')
                ->unique();

            $table->string('thumbnail')
                ->nullable();

            $table->unsignedInteger('price')
                ->default(0);

            $table->foreignIdFor(Brand::class)
                ->nullable()
                ->constrained()
                ->cascadeOnDelete()
                ->nullOnDelete();

            $table->timestamps();
        });

        Schema::create('category_product', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(Product::class)
                ->constrained()
                ->cascadeOnDelete()
                ->cascadeOnUpdate();

            $table->foreignIdFor(Category::class)
                ->constrained()
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
        });
    }

    public function down(): void
    {
        if (app()->isLocal()) {
            Schema::dropIfExists('category_product');
            Schema::dropIfExists('products');
        }
    }
};
