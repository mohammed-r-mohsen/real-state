<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdvertisementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advertisements', function (Blueprint $table) {
            $table->id();
            $table->string('project_title')->nullable();
            $table->string('image');
            $table->string('thumbnail')->nullable();
            $table->string('video')->nullable();
            $table->text('title');
            $table->text('title_original');
            $table->string('slug');
            $table->longtext('desc');
            $table->longtext('desc_original');
            $table->string('currency');
            $table->float('price');
            $table->float('lat')->default(0);
            $table->float('lng')->default(0);
            $table->string('whatsapp');
            $table->float('area');
            $table->string('appart_model');
            $table->integer('floor_count')->nullable();
            $table->string('building_age')->nullable();
            $table->integer('bathroom')->nullable();
            $table->boolean('balacony')->default(false);
            $table->boolean('furnished')->default(false);
            $table->boolean('available_for_loan')->default(false);
            $table->string('address');
            $table->unSignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unSignedBigInteger('order_id');
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
            $table->unSignedBigInteger('state_id');
            $table->foreign('state_id')->references('id')->on('states')->onDelete('cascade');
            $table->unSignedBigInteger('city_id');
            $table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade');
            $table->unSignedBigInteger('region_id');
            $table->foreign('region_id')->references('id')->on('regions')->onDelete('cascade');
            $table->unSignedBigInteger('neighbor_id');
            $table->foreign('neighbor_id')->references('id')->on('neighbors')->onDelete('cascade');
            $table->unSignedBigInteger('category_id');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->unSignedBigInteger('admin_id')->nullable();
            $table->foreign('admin_id')->references('id')->on('admins')->onDelete('cascade');
            $table->unSignedBigInteger('heating_id')->nullable();
            $table->foreign('heating_id')->references('id')->on('heatings')->onDelete('cascade');
            $table->unSignedBigInteger('title_deed_id')->nullable();
            $table->foreign('title_deed_id')->references('id')->on('title_deeds')->onDelete('cascade');
            $table->unSignedBigInteger('floor_number_id')->nullable();
            $table->foreign('floor_number_id')->references('id')->on('floor_numbers')->onDelete('cascade');
            $table->string('status')->default('pending');
            $table->string('shown')->default('shown');
            $table->string('type');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('advertisements');
    }
}
