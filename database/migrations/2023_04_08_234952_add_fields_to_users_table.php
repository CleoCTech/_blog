<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
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
        Schema::table('users', function (Blueprint $table) {
            $table->integer("status")->default(1)->after('profile_photo_path');
            $table->integer("sequence")->nullable()->after('status');
            $table->string('created_by')->nullable()->after('sequence');
            $table->string('updated_by')->nullable()->after('created_by');
        });
        DB::table('users')->insert(
            [
                [
                    'uuid' => (string) Str::uuid(),
                    'name' => config('app.company.COMPANY_USER'),
                    'email' => config('app.company.COMPANY_EMAIL'),
                    // 'password' => '$2y$10$ItQn5QHFFgMBDLSw.fKWrO57iAflsFTUo2PRNuNFdrMnQhb7jFiwy',
                    'password' =>  Hash::make(config('app.company.COMPANY_PASS')),
                    'user_category' => 100,
                    'status' => 2,
                    'created_by' => config('app.company.COMPANY_EMAIL'),
                    'updated_by' => config('app.company.COMPANY_EMAIL'),
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
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('status');
            $table->dropColumn('sequence');
            $table->dropColumn('created_by');
            $table->dropColumn('updated_by');
        });
    }
};
