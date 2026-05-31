<?php

namespace App\Http\Controllers;

use App\Models\Instructor;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SubjectController extends Controller
{
    public function index()
    {
        return view('subjects.index', ['subjects' => Subject::with('instructor')->latest()->paginate(10)]);
    }

    public function create()
    {
        return view('subjects.form', ['subject' => new Subject(), 'instructors' => Instructor::orderBy('full_name')->get()]);
    }

    public function store(Request $request)
    {
        Subject::create($this->validated($request));

        return redirect()->route('subjects.index')->with('status', 'Subject saved.');
    }

    public function edit(Subject $subject)
    {
        return view('subjects.form', ['subject' => $subject, 'instructors' => Instructor::orderBy('full_name')->get()]);
    }

    public function update(Request $request, Subject $subject)
    {
        $subject->update($this->validated($request, $subject));

        return redirect()->route('subjects.index')->with('status', 'Subject updated.');
    }

    public function destroy(Subject $subject)
    {
        $subject->delete();

        return redirect()->route('subjects.index')->with('status', 'Subject deleted.');
    }

    private function validated(Request $request, ?Subject $subject = null): array
    {
        return $request->validate([
            'instructor_id' => ['nullable', Rule::exists('instructors', 'id')],
            'code' => ['required', 'max:50', Rule::unique('subjects')->ignore($subject)],
            'name' => ['required', 'max:255'],
            'program' => ['required', 'in:Civil Engineering'],
            'description' => ['nullable'],
            'units' => ['required', 'integer', 'min:1', 'max:6'],
        ]);
    }
}
