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
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'username' => ['required', 'alpha_dash', 'max:100', 'unique:users,username'],
            'password' => ['required', 'confirmed', 'min:8'],
            'role_id' => ['required', Rule::exists('roles', 'id')],
        ]);

        $user = User::create($data);
        $this->syncRoleProfile($user);
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

    private function syncRoleProfile(User $user): void
    {
        if ($user->isRole('student')) {
            Student::firstOrCreate(
                ['user_id' => $user->id],
                [
                    'student_number' => 'STU-'.str_pad((string) $user->id, 5, '0', STR_PAD_LEFT),
                    'full_name' => $user->name,
                    'email' => $user->email,
                    'program' => 'Civil Engineering',
                ]
            );
        }

        if ($user->isRole('instructor')) {
            Instructor::firstOrCreate(
                ['user_id' => $user->id],
                [
                    'employee_number' => 'INS-'.str_pad((string) $user->id, 5, '0', STR_PAD_LEFT),
                    'full_name' => $user->name,
                    'email' => $user->email,
                ]
            );
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
