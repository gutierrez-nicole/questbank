<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasColumn('students', 'program')) {
            Schema::table('students', function (Blueprint $table) {
                $table->string('program')->default('Bachelor of Science in Civil Engineering (BSCE)')->after('email');
            });
        }

        if (! Schema::hasColumn('instructors', 'position')) {
            Schema::table('instructors', function (Blueprint $table) {
                $table->string('position')->nullable()->after('department');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('students', 'program')) {
            Schema::table('students', function (Blueprint $table) {
                $table->dropColumn('program');
            });
        }

        if (Schema::hasColumn('instructors', 'position')) {
            Schema::table('instructors', function (Blueprint $table) {
                $table->dropColumn('position');
            });
        }
    }
};
