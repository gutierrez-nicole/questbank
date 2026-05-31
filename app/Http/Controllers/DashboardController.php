<?php

namespace App\Http\Controllers;

use App\Models\Examination;
use App\Models\ExaminationResult;
use App\Models\Instructor;
use App\Models\Student;
use App\Models\Subject;
use App\Models\User;
use App\Models\UserLog;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $user = request()->user();

        if ($user->isRole('admin')) {
            return view('dashboard.admin', [
                'totalStudents' => Student::count(),
                'totalInstructors' => Instructor::count(),
                'totalSubjects' => Subject::count(),
                'totalExaminations' => Examination::count(),
                'totalAccounts' => User::count(),
                'activities' => UserLog::with('user')->latest()->limit(8)->get(),
            ]);
        }

        if ($user->isRole('instructor')) {
            $instructor = $user->instructor;

            return view('dashboard.instructor', [
                'totalSubjects' => $instructor ? $instructor->subjects()->count() : Subject::count(),
                'totalExams' => Examination::where('created_by', $user->id)->count(),
                'totalStudents' => Student::count(),
                'activities' => UserLog::with('user')->latest()->limit(8)->get(),
            ]);
        }

        $student = $user->student;

        return view('dashboard.student', [
            'availableExams' => Examination::where('status', 'published')->count(),
            'completedExams' => $student ? $student->results()->count() : 0,
            'recentScores' => $student ? $student->results()->with('examination')->latest()->limit(5)->get() : collect(),
            'upcomingExams' => Examination::with('subject')->where('status', 'published')->whereNotNull('scheduled_at')->orderBy('scheduled_at')->limit(5)->get(),
        ]);
    }
}
