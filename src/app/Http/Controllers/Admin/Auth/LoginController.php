<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::ADMIN;

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $dataLogin = $request->except(['_token']);
        if (Admin::where('email', $dataLogin['email'])->where('is_active', 1)->first()) {
            $checkLogin = Auth::guard('admin')->attempt($dataLogin);
            if ($checkLogin) {
                return redirect($this->redirectTo);
            }

            return back()->with('error', 'Email hoặc mật khẩu không hợp lệ');
        }

        return back()->with('error', 'Tài khoản chưa được kích hoạt');
    }

    /**
     * Log the user out of the application.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout()
    {
        Auth::guard('admin')->logout();

        return redirect($this->redirectTo);
    }
}
