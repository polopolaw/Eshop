<?php

use App\Option;
use App\OptionValue;
use Domain\Catalog\Models\Product;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('option_values', static function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Option::class)
                ->constrained()
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->string('value');
            $table->timestamps();
        });

        Schema::create('option_value_product', static function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(Product::class)
                ->constrained()
                ->cascadeOnDelete()
                ->cascadeOnUpdate();

            $table->foreignIdFor(OptionValue::class)
                ->constrained()
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
        });
    }

    public function down(): void
    {
        if (app()->isLocal()) {
            Schema::dropIfExists('option_values');
            Schema::dropIfExists('option_value_product');
        }
    }
};
