<?php

namespace App\Http\Controllers;

use App\Models\Instructor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class InstructorController extends Controller
{
    public function index()
    {
        return view('instructors.index', ['instructors' => Instructor::latest()->paginate(10)]);
    }

    public function create()
    {
        return view('instructors.form', ['instructor' => new Instructor(), 'users' => User::whereHas('role', fn ($q) => $q->where('name', 'instructor'))->get()]);
    }

    public function store(Request $request)
    {
        Instructor::create($this->validated($request));

        return redirect()->route('instructors.index')->with('status', 'Instructor saved.');
    }

    public function show(Instructor $instructor)
    {
        return view('instructors.show', compact('instructor'));
    }

    public function edit(Instructor $instructor)
    {
        return view('instructors.form', ['instructor' => $instructor, 'users' => User::whereHas('role', fn ($q) => $q->where('name', 'instructor'))->get()]);
    }

    public function update(Request $request, Instructor $instructor)
    {
        $instructor->update($this->validated($request, $instructor));

        return redirect()->route('instructors.index')->with('status', 'Instructor updated.');
    }

    public function destroy(Instructor $instructor)
    {
        $instructor->delete();

        return redirect()->route('instructors.index')->with('status', 'Instructor deleted.');
    }

    private function validated(Request $request, ?Instructor $instructor = null): array
    {
        return $request->validate([
            'user_id' => ['nullable', Rule::exists('users', 'id')],
            'employee_number' => ['required', 'max:50', Rule::unique('instructors')->ignore($instructor)],
            'full_name' => ['required', 'max:255'],
            'email' => ['nullable', 'email'],
            'department' => ['required', 'max:255'],
            'contact_number' => ['nullable', 'max:50'],
        ]);
    }
}
