<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('name');
            $table->string('type')->nullable();
            $table->string('google_verified')->default('No');
            $table->string('social_verified')->default('No');
            $table->string('try_managed')->default('No');
            $table->string('try_branding')->default('No');
            $table->string('admins')->nullable();
            $table->string('parent_committee')->default('No');
            $table->string('nqs')->default('No');
            $table->integer('capacity')->nullable();
            $table->integer('current_capacity')->nullable();
            $table->integer('lga_id')->nullable();
            $table->integer('page_views')->nullable();
            $table->integer('post_engagements')->nullable();
            $table->integer('followers')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pages');
    }
}
