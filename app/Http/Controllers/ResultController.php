<?php

namespace App\Http\Controllers;

use App\Models\Examination;
use App\Models\ExaminationResult;
use App\Models\AcademicPerformanceRecord;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ResultController extends Controller
{
    public function index()
    {
        $query = ExaminationResult::with('examination.subject', 'student')->latest();

        if (request()->user()->isRole('student')) {
            $query->where('student_id', request()->user()->student?->id);
        }

        return view('results.index', ['results' => $query->paginate(10)]);
    }

    public function create()
    {
        return view('results.form', [
            'result' => new ExaminationResult(),
            'students' => Student::orderBy('full_name')->get(),
            'examinations' => Examination::orderBy('title')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $result = ExaminationResult::create($this->validated($request));
        $this->syncPerformanceRecord($result);

        return redirect()->route('results.index')->with('status', 'Result saved.');
    }

    public function show(ExaminationResult $result)
    {
        abort_if(request()->user()->isRole('student') && $result->student_id !== request()->user()->student?->id, 403);

        return view('results.show', ['result' => $result->load('examination.subject', 'student')]);
    }

    public function edit(ExaminationResult $result)
    {
        return view('results.form', [
            'result' => $result,
            'students' => Student::orderBy('full_name')->get(),
            'examinations' => Examination::orderBy('title')->get(),
        ]);
    }

    public function update(Request $request, ExaminationResult $result)
    {
        $result->update($this->validated($request));
        $this->syncPerformanceRecord($result);

        return redirect()->route('results.index')->with('status', 'Result updated.');
    }

    public function destroy(ExaminationResult $result)
    {
        $result->delete();

        return redirect()->route('results.index')->with('status', 'Result deleted.');
    }

    private function validated(Request $request): array
    {
        $data = $request->validate([
            'student_id' => ['required', Rule::exists('students', 'id')],
            'examination_id' => ['required', Rule::exists('examinations', 'id')],
            'score' => ['required', 'integer', 'min:0'],
            'total_points' => ['required', 'integer', 'min:1'],
            'status' => ['required', Rule::in(['in_progress', 'submitted', 'checked'])],
        ]);

        $data['percentage'] = round(($data['score'] / max($data['total_points'], 1)) * 100, 2);
        $data['submitted_at'] = now();

        return $data;
    }

    private function syncPerformanceRecord(ExaminationResult $result): void
    {
        $result->load('examination.subject');

        AcademicPerformanceRecord::updateOrCreate(
            ['examination_result_id' => $result->id],
            [
                'student_id' => $result->student_id,
                'subject_id' => $result->examination->subject_id,
                'assessment_type' => 'examination',
                'score' => $result->score,
                'total_points' => $result->total_points,
                'percentage' => $result->percentage,
                'recorded_on' => $result->submitted_at?->toDateString() ?? now()->toDateString(),
            ]
        );
    }
}
