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
        Schema::create('qoutes', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique();
            $table->string('author');
            $table->text('quote');
            $table->integer("status")->default(1);
            $table->integer("sequence")->nullable();
            $table->timestamp("publish_time")->nullable();
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->timestamps();
        });

        DB::table('qoutes')->insert(
            [
                [
                    'uuid' => (string) Str::uuid(),
                    'author' => 'Cleo',
                    'quote' => 'Fire cannot burn itself',
                    'status' => 2,
                    'created_by' => config('app.developer.DEV_EMAIL'),
                    'updated_by' => config('app.developer.DEV_EMAIL'),
                ], 
                [
                    'uuid' => (string) Str::uuid(),
                    'author' => 'Mahatma Gandhi',
                    'quote' => 'Be the change you wish to see in the world',
                    'status' => 2,
                    'created_by' => config('app.developer.DEV_EMAIL'),
                    'updated_by' => config('app.developer.DEV_EMAIL'),
                ], 
                [
                    'uuid' => (string) Str::uuid(),
                    'author' => 'Steve Jobs',
                    'quote' => 'The only way to do great work is to love what you do.',
                    'status' => 2,
                    'created_by' => config('app.developer.DEV_EMAIL'),
                    'updated_by' => config('app.developer.DEV_EMAIL'),
                ], 
                [
                    'uuid' => (string) Str::uuid(),
                    'author' => 'African proverb',
                    'quote' => 'If you want to go fast, go alone. If you want to go far, go together.',
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
        Schema::dropIfExists('qoutes');
    }
};
