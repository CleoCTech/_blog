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
        Schema::create('adverts', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique();
            $table->string("title");
            $table->string("link")->nullable();
            $table->string("description");
            $table->string("image_url");
            $table->string("views")->nullable();
            $table->integer("status")->default(1);
            $table->integer("sequence")->nullable();
            $table->timestamp("publish_time")->nullable();
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->timestamps();
        });

        DB::table('adverts')->insert(
            [
                [
                    'uuid' => (string) Str::uuid(),
                    'title' => 'Wenla Systems',
                    'description' => 'Streamline Your Business with Our Revolutionary Software Solutions - Boost Productivity, Save Time, and Achieve Success!',
                    'link' => 'https://wenlasystems.com/',
                    'image_url' => 'https://images.unsplash.com/photo-1634017839464-5c339ebe3cb4?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=3000&q=80',
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
        Schema::dropIfExists('adverts');
    }
};
