<?php

namespace App\Http\Controllers\Auth;

use Carbon\Carbon;
use App\Http\Controllers\Controller;
use App\Mail\EmailVerify;
use App\Providers\RouteServiceProvider;
use App\Models\EmailVerification;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except(['completeRegister', 'redirectTo']);;
    }

    /**
     * 仮登録メール送信画面
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function showEmailVerifyForm()
    {
        return view('auth.email-verify');
    }

    /**
     * 仮登録メール送信処理
     *
     * @param Request $request
     * @return string
     */
    public function emailVerify(Request $request)
    {
        $request->validate([
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        ]);

        $email_verification = EmailVerification::build($request->email);
        $email_verification->save();

        /* メール送信 */
        $email = new EmailVerify($email_verification);
        Mail::to($email_verification->email)->send($email);

        return redirect(route('email.send.complete'));
    }

    /**
     * メール送信完了画面
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function completeEmailSend()
    {
        return view('auth.email-verify-send', [
            'hours' => EmailVerification::EXPIRATION_HOURS
        ]);
    }

    /**
     * Show the application registration form.
     *
     * @param $token
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function showRegistrationForm($token)
    {
        // 有効なtokenか確認する
        $email_verification = EmailVerification::findByToken($token);
        if (empty($email_verification)) {
            // 該当トークンなし
            return redirect(route('email.verify'))->with('verify_failed', 'トークンが不正です。');
        } elseif ($email_verification->isRegister()) {
            // 登録済み
            return redirect(route('email.verify'))->with('verify_failed', 'このメールアドレスは既に登録済みです。');
        } elseif (!$email_verification->isExpiration()) {
            // 有効期限切れ
            return redirect(route('email.verify'))->with('verify_failed', 'リンクの有効期限が切れています。再度仮登録メールを送信してください。');
        }

        // ステータスをメール認証済みに変更する
        $email_verification->mailVerify();
        $email_verification->update();

        $sexes = User::getArraySexes();

        return view('auth.register', [
            'token' => $token,
            'email' => $email_verification->email,
            'sexes' => $sexes,
        ]);
    }

    /**
     * Handle a registration request for the application.
     *
     * @param Request $request
     * @param $token
     *
     * @return \Illuminate\Contracts\Foundation\Application|JsonResponse|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|mixed
     * @throws \Illuminate\Validation\ValidationException
     */
    public function register(Request $request, $token)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all(), $token)));

        $this->guard()->login($user);

        if ($response = $this->registered($request, $user)) {
            return $response;
        }

        return $request->wantsJson()
            ? new JsonResponse([], 201)
            : redirect($this->redirectPath());
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'account' => ['required', 'regex:/^[a-zA-Z0-9]+$/', 'max:255'],
            'sex' => ['required', 'numeric'],
            // 'sex' => ['required', 'numeric'],
            // 'profile' => ['required', 'string'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @param  string  $token
     * @return \App\Models\User
     */
    protected function create(array $data, string $token)
    {
        return DB::transaction(function () use ($data, $token) {
            // ステータスをメール認証済みに変更する
            $email_verification = EmailVerification::findByToken($token);
            $email_verification->register();
            $email_verification->update();

            return User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'email_verified_at' => Carbon::now(),
                'password' => Hash::make($data['password']),
                'account' => $data['account'],
                'tel' => $data['tel'],
                'status' => 0,
                'sex' => $data['sex'],
                'profile' => $data['profile'],
                'mailing' => 0,
            ]);
        });
    }

    /**
     * 登録完了画面
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function completeRegister()
    {
        return view('auth.complete-register');
    }

    protected function redirectTo()
    {
        return route('sign-up.complete');
    }
}
