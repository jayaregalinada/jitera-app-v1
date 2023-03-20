<?php

declare(strict_types=1);

use App\Models\Address;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create(Address::TABLE_NAME, static function (Blueprint $table) {
            $table->id();
            $table->string('street');
            $table->string('suite')->nullable();
            $table->string('city');
            $table->string('zipcode');
            $table->float('latitude');
            $table->float('longitude');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(Address::TABLE_NAME);
    }
};
