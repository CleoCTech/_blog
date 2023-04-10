<?php

use App\Models\Post\Reply;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
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
        Schema::create('replies', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique();
            $table->text('content');
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('comment_id')->constrained()->onDelete('cascade');
            $table->foreignId('reply_to_id')->nullable()->constrained('replies')->onDelete('cascade');
            $table->string('name')->nullable();
            $table->string('email');
            $table->integer('views')->default(0);
            $table->integer('visibility')->default(1);
            $table->integer("status")->default(1);
            $table->datetime("publish_time")->nullable();
            $table->integer("sequence")->nullable();
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->timestamps();
        });
        $replies = [
            [ 'uuid' => (string) Str::uuid(),'content' => 'This is a reply to the first comment on the first post.', 'user_id' => 3, 'email' =>'info@dailynotifications.com', 'comment_id' => 1, 'reply_to_id' => null],
            [ 'uuid' => (string) Str::uuid(),'content' => 'This is a reply to the second comment on the first post.', 'user_id' => 1, 'email' =>'admin@wenlasystems.com', 'comment_id' => 2, 'reply_to_id' => null],
            [ 'uuid' => (string) Str::uuid(),'content' => 'This is a reply to the first reply on the first comment on the first post.', 'user_id' => 2, 'email' =>'test1@gmail.com',  'comment_id' => 1, 'reply_to_id' => 1],
            [ 'uuid' => (string) Str::uuid(),'content' => 'This is a reply to the second reply on the first comment on the first post.', 'user_id' => 3, 'email' =>'info@dailynotifications.com', 'comment_id' => 1, 'reply_to_id' => 1],
            [ 'uuid' => (string) Str::uuid(),'content' => 'This is a reply to the first comment on the second post.', 'user_id' => 2, 'email' =>'test1@gmail.com', 'comment_id' => 3, 'reply_to_id' => null],
        ];
        
        Reply::insert($replies);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('replies');
    }
};
