<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
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
        Schema::create('company_information', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique();
            $table->string("company_name");
            $table->string("short_name")->nullable();
            $table->string("welcome_title")->nullable();
            $table->text("welcome_message", 1000)->nullable();
            $table->date("establishment_date")->nullable();
            $table->text("history",3000)->nullable();
            $table->text("vision",3000)->nullable();
            $table->text("mission",3000)->nullable();
            $table->string('slogan', 500)->nullable();
            $table->text("core_values", 3000);
            $table->text("quality", 3000);
            $table->string("location");
            $table->string("about_short")->nullable();
            $table->integer("total_people_helped")->default(0);
            $table->text("about",3000)->nullable();
            $table->string("about_newsletter")->nullable();
            $table->string("emails");
            $table->string("phone_numbers");
            $table->string("address")->nullable();
            $table->string("manager_name")->nullable();
            $table->string("manager_custom_title")->nullable();
            $table->string("logo")->nullable();
            $table->integer("status")->default(2);
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->timestamps();
        });

        DB::table('company_information')->insert(
            [
                [
                    'uuid' => (string) Str::uuid(),
                    'company_name' => 'Wenla Systems & Solutions Ltd.',
                    'welcome_title' => 'Welcome',
                    'welcome_message' => "Which them don't replenish. Under herb spirit you're sea face that air image.",
                    'history' => 'Our journey started....',
                    'vision' => 'To become the provider of choice in data analytics across the globe.',
                    'mission' => 'To provide the best research and analytics consultancy to businesses and organizations and help them gain competitive advantage through insights rooted in data.',
                    'core_values' => 'To become the provider of choice in data analytics across the globe.',
                    'quality' => 'Our principles are anchored on the quality of services we offer. We focus on reliability, confidentiality, accuracy, consistency and completeness. We offer customized solutions to the client needs and help them design data-driven models to support both routine and strategic business decisions.',
                    'location' => '00 Kimathi Street, Nairobi,Kenya',
                    'emails' => 'info@wenlasystems.com',
                    'phone_numbers' => "0727057310 or 0751019142",
                    'address' => "661-00300 Nairobi",
                    'manager_name' => "Mr.Fix IT",
                    'manager_custom_title' => "Senior Marketing Specialist, Unvab Inc.",
                    
                ]
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
        Schema::dropIfExists('company_information');
    }
};
