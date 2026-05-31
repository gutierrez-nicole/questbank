<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $students = Student::query()
            ->when($request->search, fn ($query, $search) => $query->where('full_name', 'like', "%{$search}%")->orWhere('student_number', 'like', "%{$search}%"))
            ->latest()
            ->paginate(10);

        return view('students.index', compact('students'));
    }

    public function create()
    {
        return view('students.form', ['student' => new Student(), 'users' => User::whereHas('role', fn ($q) => $q->where('name', 'student'))->get()]);
    }

    public function store(Request $request)
    {
        Student::create($this->validated($request));

        return redirect()->route('students.index')->with('status', 'Student saved.');
    }

    public function show(Student $student)
    {
        return view('students.show', compact('student'));
    }

    public function edit(Student $student)
    {
        return view('students.form', ['student' => $student, 'users' => User::whereHas('role', fn ($q) => $q->where('name', 'student'))->get()]);
    }

    public function update(Request $request, Student $student)
    {
        $student->update($this->validated($request, $student));

        return redirect()->route('students.index')->with('status', 'Student updated.');
    }

    public function destroy(Student $student)
    {
        $student->delete();

        return redirect()->route('students.index')->with('status', 'Student deleted.');
    }

    private function validated(Request $request, ?Student $student = null): array
    {
        return $request->validate([
            'user_id' => ['nullable', Rule::exists('users', 'id')],
            'student_number' => ['required', 'max:50', Rule::unique('students')->ignore($student)],
            'full_name' => ['required', 'max:255'],
            'email' => ['nullable', 'email'],
            'program' => ['required', 'in:Civil Engineering'],
            'year_level' => ['nullable', 'max:50'],
            'section' => ['nullable', 'max:50'],
            'address' => ['nullable'],
            'contact_number' => ['nullable', 'max:50'],
        ]);
    }
}
