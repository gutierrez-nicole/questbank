<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Instructor;
use App\Models\Role;
use App\Models\Student;
use App\Models\User;
use App\Models\UserLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'login' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        $field = filter_var($credentials['login'], FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        $user = User::where($field, $credentials['login'])->first();

        if (! $user || ! Hash::check($credentials['password'], $user->password)) {
            return back()->withErrors(['login' => 'The provided credentials do not match our records.'])->onlyInput('login');
        }

        if (! $user->is_active) {
            return back()->withErrors(['login' => 'Your account is inactive. Please contact an administrator.'])->onlyInput('login');
        }

        Auth::login($user);
        $request->session()->regenerate();
        UserLog::create([
            'user_id' => $user->id,
            'action' => 'login',
            'description' => 'User logged in.',
            'ip_address' => $request->ip(),
        ]);

        return redirect()->route('dashboard');
    }

    public function showRegister()
    {
        return view('auth.register', ['roles' => $this->roles()]);
    }

    public function register(Request $request)
    {
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'username' => ['required', 'alpha_dash', 'max:100', 'unique:users,username'],
            'password' => ['required', 'confirmed', 'min:8'],
            'role_id' => ['required', Rule::exists('roles', 'id')],
        ];

        $role = Role::find($request->input('role_id'));

        if ($role?->name === 'student') {
            $rules += [
                'student_number' => ['required', 'max:50', Rule::unique('students', 'student_number')],
                'year_level' => ['required', 'max:50'],
                'section' => ['required', 'max:50'],
                'program' => ['required', 'in:Bachelor of Science in Civil Engineering (BSCE)'],
            ];
        }

        if ($role?->name === 'instructor') {
            $rules += [
                'employee_number' => ['required', 'max:50', Rule::unique('instructors', 'employee_number')],
                'department' => ['required', 'max:255'],
                'position' => ['required', 'max:255'],
            ];
        }

        $data = $request->validate($rules);

        $user = User::create($data);
        $this->syncRoleProfile($user, $data);
        Auth::login($user);
        $request->session()->regenerate();

        UserLog::create([
            'user_id' => $user->id,
            'action' => 'register',
            'description' => 'New account registered.',
            'ip_address' => $request->ip(),
        ]);

        return redirect()->route('dashboard');
    }

    public function logout(Request $request)
    {
        UserLog::create([
            'user_id' => $request->user()?->id,
            'action' => 'logout',
            'description' => 'User logged out.',
            'ip_address' => $request->ip(),
        ]);

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
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

        return Role::orderBy('display_name')->get();
    }
}
