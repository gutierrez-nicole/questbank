<?php

namespace App\Http\Controllers;

use App\Models\AcademicPerformanceRecord;
use Illuminate\Support\Facades\DB;

class PerformanceReportController extends Controller
{
    public function index()
    {
        $query = AcademicPerformanceRecord::query()
            ->join('subjects', 'academic_performance_records.subject_id', '=', 'subjects.id')
            ->select(
                'subjects.id',
                'subjects.code',
                'subjects.name',
                DB::raw('ROUND(AVG(academic_performance_records.percentage), 2) as average_percentage'),
                DB::raw('COUNT(*) as records_count')
            )
            ->where('subjects.program', 'Civil Engineering')
            ->groupBy('subjects.id', 'subjects.code', 'subjects.name')
            ->orderByDesc('average_percentage');

        if (request()->user()->isRole('student')) {
            $query->where('academic_performance_records.student_id', request()->user()->student?->id);
        }

        $subjectPerformance = $query->get();

        return view('reports.performance', [
            'subjectPerformance' => $subjectPerformance,
            'strengths' => $subjectPerformance->where('average_percentage', '>=', 85),
            'weaknesses' => $subjectPerformance->where('average_percentage', '<', 75),
        ]);
    }
}
