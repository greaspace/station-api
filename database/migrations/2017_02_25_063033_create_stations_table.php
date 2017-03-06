<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 32);
            $table->string('owner', 32);
            $table->string('owner_mobile', 16);
            $table->string('logo')->nullable();
            $table->string('banner')->nullable();
            $table->string('phone');
            $table->text('address');
            $table->text('description')->nullable();

            $table->enum('status', [-1, 0, 1])->default(1)->commit('-1:禁用,0:关店,1:营业');
            $table->enum('certified', [0, 1, 2])->default(0)->commit('0:未认证,1:店主认证,2:企业认证');
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
        Schema::dropIfExists('stations');
    }
}
