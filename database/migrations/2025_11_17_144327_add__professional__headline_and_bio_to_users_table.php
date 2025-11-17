<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('professional_headline')->nullable()->after('remember_token');
            $table->text('bio')->nullable()->after('professional_headline');
            $table->integer('experience')->nullable()->after('bio');
            $table->integer('projects_made')->nullable()->after('experience');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['professional_headline','bio','experience','projects_made']);
        });
    }
};
