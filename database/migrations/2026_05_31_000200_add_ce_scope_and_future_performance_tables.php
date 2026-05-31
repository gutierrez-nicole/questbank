<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('students', function (Blueprint $table) {
            $table->string('program')->default('Civil Engineering')->after('email');
        });

        Schema::table('subjects', function (Blueprint $table) {
            $table->string('program')->default('Civil Engineering')->after('name');
        });

        Schema::table('examinations', function (Blueprint $table) {
            $table->string('program')->default('Civil Engineering')->after('title');
        });

        if (DB::getDriverName() === 'mysql') {
            DB::statement("ALTER TABLE questions MODIFY type ENUM('multiple_choice', 'true_false', 'identification', 'matching_type') NOT NULL");
        }

        DB::table('questions')->where('type', 'identification')->update(['type' => 'matching_type']);

        if (DB::getDriverName() === 'mysql') {
            DB::statement("ALTER TABLE questions MODIFY type ENUM('multiple_choice', 'true_false', 'matching_type') NOT NULL");
        }

        Schema::create('academic_performance_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained()->cascadeOnDelete();
            $table->foreignId('subject_id')->constrained()->cascadeOnDelete();
            $table->foreignId('examination_result_id')->nullable()->constrained()->nullOnDelete();
            $table->enum('assessment_type', ['examination', 'quiz', 'activity', 'overall'])->default('examination');
            $table->decimal('score', 8, 2)->default(0);
            $table->decimal('total_points', 8, 2)->default(0);
            $table->decimal('percentage', 5, 2)->default(0);
            $table->date('recorded_on')->nullable();
            $table->timestamps();
        });

        Schema::create('prediction_snapshots', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained()->cascadeOnDelete();
            $table->foreignId('subject_id')->nullable()->constrained()->nullOnDelete();
            $table->enum('prediction_type', ['pass_subject', 'academic_achiever', 'at_risk', 'ranking']);
            $table->decimal('confidence_score', 5, 2)->nullable();
            $table->string('predicted_outcome')->nullable();
            $table->json('input_summary')->nullable();
            $table->string('model_version')->nullable();
            $table->timestamp('generated_at')->nullable();
            $table->timestamps();
        });

        Schema::create('learning_recommendations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained()->cascadeOnDelete();
            $table->foreignId('subject_id')->nullable()->constrained()->nullOnDelete();
            $table->string('category')->nullable();
            $table->text('recommendation')->nullable();
            $table->boolean('is_ai_generated')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('learning_recommendations');
        Schema::dropIfExists('prediction_snapshots');
        Schema::dropIfExists('academic_performance_records');

        if (DB::getDriverName() === 'mysql') {
            DB::statement("ALTER TABLE questions MODIFY type ENUM('multiple_choice', 'true_false', 'identification', 'matching_type') NOT NULL");
        }

        DB::table('questions')->where('type', 'matching_type')->update(['type' => 'identification']);

        if (DB::getDriverName() === 'mysql') {
            DB::statement("ALTER TABLE questions MODIFY type ENUM('multiple_choice', 'true_false', 'identification') NOT NULL");
        }

        Schema::table('examinations', function (Blueprint $table) {
            $table->dropColumn('program');
        });

        Schema::table('subjects', function (Blueprint $table) {
            $table->dropColumn('program');
        });

        Schema::table('students', function (Blueprint $table) {
            $table->dropColumn('program');
        });
    }
};
