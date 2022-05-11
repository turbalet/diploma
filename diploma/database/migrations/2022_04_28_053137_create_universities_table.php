<?php

use App\Models\Category;
use App\Models\Language;
use App\Models\Region;
use App\Models\Type;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('universities', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->string('website')->nullable();
            $table->string('phone_number');
            $table->string('instagram')->nullable();
            $table->foreignIdFor(Region::class)->constrained();
            $table->foreignIdFor(Category::class)->constrained();
            $table->foreignIdFor(Type::class)->constrained();
            $table->foreignIdFor(Language::class)->constrained();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('universities');
    }
};
