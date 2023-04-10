<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;


return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique();
            $table->string("name");
            $table->string("link");
            $table->string("email");
            $table->integer("status")->default(1);
            $table->integer("sequence")->nullable();
            $table->timestamp("publish_time")->nullable();
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->timestamps();
        });

        DB::table('products')->insert(
            [
                [
                    'uuid' => (string) Str::uuid(),
                    'name' => 'Wenla Systems',
                    'email' => 'info@wenlasystems.com',
                    'link' => 'https://wenlasystems.com/',
                    'status' => 2,
                    'created_by' => config('app.developer.DEV_EMAIL'),
                    'updated_by' => config('app.developer.DEV_EMAIL'),
                ], 
            ]
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
