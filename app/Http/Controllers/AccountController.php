<?php

namespace App\Http\Controllers;

use App\Models\Instructor;
use App\Models\Role;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AccountController extends Controller
{
    public function index()
    {
        return view('accounts.index', [
            'users' => $this->visibleAccountsQuery()->with('role')->latest()->paginate(10),
        ]);
    }

    public function create()
    {
        return view('accounts.form', ['user' => new User(), 'roles' => $this->roles()]);
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        $user = User::create($data);
        $this->syncRoleProfile($user, $data);

        return redirect()->route('accounts.index')->with('status', 'Account created.');
    }

    public function edit(User $account)
    {
        $this->authorizeVisibleAccount($account);

        return view('accounts.form', ['user' => $account, 'roles' => $this->roles()]);
    }

    public function update(Request $request, User $account)
    {
        $this->authorizeVisibleAccount($account);

        $data = $this->validated($request, $account);
        if (blank($data['password'] ?? null)) {
            unset($data['password']);
        }

        $account->update($data);
        $this->syncRoleProfile($account, $data);

        return redirect()->route('accounts.index')->with('status', 'Account updated.');
    }

    public function toggle(User $account)
    {
        $this->authorizeVisibleAccount($account);

        $account->update(['is_active' => ! $account->is_active]);

        return back()->with('status', 'Account status updated.');
    }

    private function validated(Request $request, ?User $user = null): array
    {
        $passwordRule = $user ? ['nullable', 'confirmed', 'min:8'] : ['required', 'confirmed', 'min:8'];
        $allowedRoleIds = $this->roles()->pluck('id')->all();
        $role = Role::find($request->input('role_id'));
        $student = $user?->student;
        $instructor = $user?->instructor;

        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user)],
            'username' => ['required', 'alpha_dash', 'max:100', Rule::unique('users')->ignore($user)],
            'role_id' => ['required', Rule::in($allowedRoleIds)],
            'password' => $passwordRule,
            'is_active' => ['nullable', 'boolean'],
        ];

        if ($role?->name === 'student') {
            $rules += [
                'student_number' => ['required', 'max:50', Rule::unique('students', 'student_number')->ignore($student)],
                'year_level' => ['required', 'max:50'],
                'section' => ['required', 'max:50'],
                'program' => ['required', 'in:Bachelor of Science in Civil Engineering (BSCE)'],
            ];
        }

        if ($role?->name === 'instructor') {
            $rules += [
                'employee_number' => ['required', 'max:50', Rule::unique('instructors', 'employee_number')->ignore($instructor)],
                'department' => ['required', 'max:255'],
                'position' => ['required', 'max:255'],
            ];
        }

        return $request->validate($rules) + ['is_active' => false];
    }

    private function syncRoleProfile(User $user, array $data = []): void
    {
        if ($user->isRole('student')) {
            Student::updateOrCreate(
                ['user_id' => $user->id],
                [
                    'student_number' => $data['student_number'] ?? 'STU-'.str_pad((string) $user->id, 5, '0', STR_PAD_LEFT),
                    'full_name' => $user->name,
                    'email' => $user->email,
                    'program' => $data['program'] ?? 'Bachelor of Science in Civil Engineering (BSCE)',
                    'year_level' => $data['year_level'] ?? null,
                    'section' => $data['section'] ?? null,
                ]
            );
        }

        if ($user->isRole('instructor')) {
            Instructor::updateOrCreate(
                ['user_id' => $user->id],
                [
                    'employee_number' => $data['employee_number'] ?? 'INS-'.str_pad((string) $user->id, 5, '0', STR_PAD_LEFT),
                    'full_name' => $user->name,
                    'email' => $user->email,
                    'department' => $data['department'] ?? 'Civil Engineering',
                    'position' => $data['position'] ?? null,
                ]
            );
        }
    }

    private function roles()
    {
        foreach ([
            'student' => 'Student',
            'instructor' => 'Instructor',
            'admin' => 'Administrator',
        ] as $name => $displayName) {
            Role::updateOrCreate(['name' => $name], ['display_name' => $displayName]);
        }

        $query = Role::query();

        if (! request()->user()->isRole('admin')) {
            $query->where('name', request()->user()->role?->name);
        }

        return $query->orderBy('display_name')->get();
    }

    private function visibleAccountsQuery()
    {
        $query = User::query();

        if (! request()->user()->isRole('admin')) {
            $query->where('role_id', request()->user()->role_id);
        }

        return $query;
    }

    private function authorizeVisibleAccount(User $account): void
    {
        abort_if(
            ! request()->user()->isRole('admin') && $account->role_id !== request()->user()->role_id,
            403
        );
    }
}
