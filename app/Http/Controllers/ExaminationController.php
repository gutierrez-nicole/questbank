<?php

namespace App\Http\Controllers;

use App\Models\Examination;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ExaminationController extends Controller
{
    public function index()
    {
        return view('examinations.index', ['examinations' => Examination::with('subject')->latest()->paginate(10)]);
    }

    public function create()
    {
        return view('examinations.form', ['examination' => new Examination(), 'subjects' => Subject::orderBy('name')->get()]);
    }

    public function store(Request $request)
    {
        Examination::create($this->validated($request) + ['created_by' => $request->user()->id]);

        return redirect()->route('examinations.index')->with('status', 'Examination saved.');
    }

    public function show(Examination $examination)
    {
        return view('examinations.show', ['examination' => $examination->load('subject', 'questions')]);
    }

    public function edit(Examination $examination)
    {
        return view('examinations.form', ['examination' => $examination, 'subjects' => Subject::orderBy('name')->get()]);
    }

    public function update(Request $request, Examination $examination)
    {
        $examination->update($this->validated($request));

        return redirect()->route('examinations.index')->with('status', 'Examination updated.');
    }

    public function destroy(Examination $examination)
    {
        $examination->delete();

        return redirect()->route('examinations.index')->with('status', 'Examination deleted.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'subject_id' => ['required', Rule::exists('subjects', 'id')],
            'title' => ['required', 'max:255'],
            'program' => ['required', 'in:Civil Engineering'],
            'description' => ['nullable'],
            'duration_minutes' => ['required', 'integer', 'min:1'],
            'scheduled_at' => ['nullable', 'date'],
            'passing_score' => ['required', 'integer', 'min:0', 'max:100'],
            'status' => ['required', Rule::in(['draft', 'published', 'closed'])],
        ]);
    }
}
