<?php

namespace App\Http\Controllers;

use App\Models\Examination;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class QuestionController extends Controller
{
    public function index()
    {
        return view('questions.index', ['questions' => Question::with('examination')->latest()->paginate(10)]);
    }

    public function create()
    {
        return view('questions.form', ['question' => new Question(), 'examinations' => Examination::orderBy('title')->get()]);
    }

    public function store(Request $request)
    {
        Question::create($this->validated($request));

        return redirect()->route('questions.index')->with('status', 'Question saved.');
    }

    public function edit(Question $question)
    {
        return view('questions.form', ['question' => $question, 'examinations' => Examination::orderBy('title')->get()]);
    }

    public function update(Request $request, Question $question)
    {
        $question->update($this->validated($request));

        return redirect()->route('questions.index')->with('status', 'Question updated.');
    }

    public function destroy(Question $question)
    {
        $question->delete();

        return redirect()->route('questions.index')->with('status', 'Question deleted.');
    }

    private function validated(Request $request): array
    {
        $data = $request->validate([
            'examination_id' => ['required', Rule::exists('examinations', 'id')],
            'type' => ['required', Rule::in(['multiple_choice', 'true_false', 'matching_type'])],
            'question_text' => ['required'],
            'options_text' => ['nullable', 'string'],
            'correct_answer' => ['nullable', 'max:255'],
            'points' => ['required', 'integer', 'min:1'],
        ]);

        $options = collect(preg_split('/\r\n|\r|\n/', $data['options_text'] ?? ''))
            ->map(fn ($option) => trim($option))
            ->filter()
            ->values()
            ->all();

        return [
            'examination_id' => $data['examination_id'],
            'type' => $data['type'],
            'question_text' => $data['question_text'],
            'options' => $options ?: null,
            'correct_answer' => $data['correct_answer'] ?? null,
            'points' => $data['points'],
        ];
    }
}
