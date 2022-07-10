<?php

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
        Schema::create('automation_filters', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('automation_id');

            $table->string('form_class');
            $table->json('settings')->nullable();

            $table->string('name')->nullable();

            $table->boolean('is_active')->default(true);

            $table->foreign('automation_id')->references('id')->on('automations')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('automation_filters');
    }
};
