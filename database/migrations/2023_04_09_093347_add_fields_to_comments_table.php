<?php

use App\Models\Post\Comment;
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
        Schema::table('comments', function (Blueprint $table) {
            $table->foreignId('post_id')->after('uuid')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->nullable()->after('post_id')->constrained()->onDelete('cascade');
            $table->string('name')->nullable()->after('user_id');
            $table->string('email')->after('name');
        });
        $comments = [
            ['uuid' => (string) Str::uuid(),'content' => 'This is the first comment on the first post.', 'user_id' => 1, 'email' =>'admin@wenlasystems.com', 'post_id' => 3, 'visibility'=>1, 'status'=>1],
            [ 'uuid' => (string) Str::uuid(), 'content' => 'This is the second comment on the first post.', 'user_id' => 4, 'email' =>'cleoctech@gmail.com', 'post_id' => 3, 'visibility'=>1, 'status'=>1],
            [ 'uuid' => (string) Str::uuid(), 'content' => 'This is the first comment on the second post.', 'user_id' => 1, 'email' =>'admin@wenlasystems.com', 'post_id' => 6,'visibility'=>1, 'status'=>1],
        ];
        
        Comment::insert($comments);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('comments', function (Blueprint $table) {
            $table->dropColumn('user_id');
            $table->dropColumn('name');
            $table->dropColumn('email');
        });
    }
};
