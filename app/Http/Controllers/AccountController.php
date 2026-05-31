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
            'users' => User::with('role')->latest()->paginate(10),
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
        $this->syncRoleProfile($user);

        return redirect()->route('accounts.index')->with('status', 'Account created.');
    }

    public function edit(User $account)
    {
        return view('accounts.form', ['user' => $account, 'roles' => $this->roles()]);
    }

    public function update(Request $request, User $account)
    {
        $data = $this->validated($request, $account);
        if (blank($data['password'] ?? null)) {
            unset($data['password']);
        }

        $account->update($data);
        $this->syncRoleProfile($account);

        return redirect()->route('accounts.index')->with('status', 'Account updated.');
    }

    public function toggle(User $account)
    {
        $account->update(['is_active' => ! $account->is_active]);

        return back()->with('status', 'Account status updated.');
    }

    private function validated(Request $request, ?User $user = null): array
    {
        $passwordRule = $user ? ['nullable', 'confirmed', 'min:8'] : ['required', 'confirmed', 'min:8'];

        return $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user)],
            'username' => ['required', 'alpha_dash', 'max:100', Rule::unique('users')->ignore($user)],
            'role_id' => ['required', Rule::exists('roles', 'id')],
            'password' => $passwordRule,
            'is_active' => ['nullable', 'boolean'],
        ]) + ['is_active' => false];
    }

    private function syncRoleProfile(User $user): void
    {
        if ($user->isRole('student')) {
            Student::firstOrCreate(['user_id' => $user->id], [
                'student_number' => 'STU-'.str_pad((string) $user->id, 5, '0', STR_PAD_LEFT),
                'full_name' => $user->name,
                'email' => $user->email,
                'program' => 'Civil Engineering',
            ]);
        }

        if ($user->isRole('instructor')) {
            Instructor::firstOrCreate(['user_id' => $user->id], [
                'employee_number' => 'INS-'.str_pad((string) $user->id, 5, '0', STR_PAD_LEFT),
                'full_name' => $user->name,
                'email' => $user->email,
            ]);
        }
    }

    private function roles()
    {
        foreach ([
            'student' => 'Student',
            'instructor' => 'Instructor',
            'admin' => 'Admin',
        ] as $name => $displayName) {
            Role::firstOrCreate(['name' => $name], ['display_name' => $displayName]);
        }

        return Role::orderBy('display_name')->get();
    }
}
