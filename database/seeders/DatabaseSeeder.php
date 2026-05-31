<?php

namespace Database\Seeders;

use App\Models\Examination;
use App\Models\ExaminationResult;
use App\Models\Instructor;
use App\Models\AcademicPerformanceRecord;
use App\Models\Question;
use App\Models\Role;
use App\Models\Student;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $adminRole = Role::firstOrCreate(['name' => 'admin'], ['display_name' => 'Admin']);
        $instructorRole = Role::firstOrCreate(['name' => 'instructor'], ['display_name' => 'Instructor']);
        $studentRole = Role::firstOrCreate(['name' => 'student'], ['display_name' => 'Student']);

        User::firstOrCreate(['email' => 'admin@questbank.test'], [
            'role_id' => $adminRole->id,
            'name' => 'QuestBank Administrator',
            'username' => 'admin',
            'password' => 'password',
            'is_active' => true,
        ]);

        $instructorUser = User::firstOrCreate(['email' => 'instructor@questbank.test'], [
            'role_id' => $instructorRole->id,
            'name' => 'Engr. Maria Santos',
            'username' => 'instructor',
            'password' => 'password',
            'is_active' => true,
        ]);

        $studentUser = User::firstOrCreate(['email' => 'student@questbank.test'], [
            'role_id' => $studentRole->id,
            'name' => 'Juan Dela Cruz',
            'username' => 'student',
            'password' => 'password',
            'is_active' => true,
        ]);

        $instructor = Instructor::firstOrCreate(['employee_number' => 'INS-00001'], [
            'user_id' => $instructorUser->id,
            'full_name' => $instructorUser->name,
            'email' => $instructorUser->email,
            'department' => 'Civil Engineering',
        ]);

        $student = Student::firstOrCreate(['student_number' => 'STU-00001'], [
            'user_id' => $studentUser->id,
            'full_name' => $studentUser->name,
            'email' => $studentUser->email,
            'program' => 'Civil Engineering',
            'year_level' => '3rd Year',
            'section' => 'CE-3A',
        ]);

        foreach ([
            ['CEMATH', 'Engineering Mathematics'],
            ['CESTRUCT', 'Structural Analysis'],
            ['CEHYDRO', 'Hydraulics'],
            ['CESURV', 'Surveying'],
            ['CEMGMT', 'Construction Management'],
        ] as [$code, $name]) {
            $subject = Subject::firstOrCreate(['code' => $code], [
                'name' => $name,
                'program' => 'Civil Engineering',
                'instructor_id' => $instructor->id,
                'units' => 3,
            ]);

            $exam = Examination::firstOrCreate(['title' => "{$name} Preliminary Exam"], [
                'subject_id' => $subject->id,
                'created_by' => $instructorUser->id,
                'program' => 'Civil Engineering',
                'duration_minutes' => 60,
                'scheduled_at' => now()->addWeek(),
                'passing_score' => 75,
                'status' => 'published',
            ]);

            Question::firstOrCreate([
                'examination_id' => $exam->id,
                'question_text' => "Match key {$name} terms with their descriptions.",
            ], [
                'type' => 'matching_type',
                'options' => ['Load | Force applied to a structure', 'Span | Distance between supports'],
                'correct_answer' => 'Load=Force applied to a structure; Span=Distance between supports',
                'points' => 5,
            ]);

            $score = $code === 'CEHYDRO' ? 68 : 88;
            $result = ExaminationResult::firstOrCreate([
                'student_id' => $student->id,
                'examination_id' => $exam->id,
            ], [
                'score' => $score,
                'total_points' => 100,
                'percentage' => $score,
                'status' => 'checked',
                'submitted_at' => now(),
            ]);

            AcademicPerformanceRecord::updateOrCreate(
                ['examination_result_id' => $result->id],
                [
                    'student_id' => $student->id,
                    'subject_id' => $subject->id,
                    'assessment_type' => 'examination',
                    'score' => $result->score,
                    'total_points' => $result->total_points,
                    'percentage' => $result->percentage,
                    'recorded_on' => now()->toDateString(),
                ]
            );
        }
    }
}
