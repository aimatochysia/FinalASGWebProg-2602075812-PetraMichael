<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
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
            'username' => ['required', 'string', 'max:255'],
            'instagram_username' => ['nullable', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'gender' => ['required', 'in:male,female,other'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'mobile_number' => ['required', 'string', 'regex:/^\d{10,15}$/'],
            'price' => ['required', 'integer', 'min:0'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $picsumUrl = $this->fetchPicsumImageUrl();
        return User::create([
            'username' => $data['username'],
            'instagram_username' => $data['instagram_username'],
            'email' => $data['email'],
            'gender' => $data['gender'],
            'password' => Hash::make($data['password']),
            'mobile_number' => $data['mobile_number'],
            'price' => $data['price'],
            'profile_picture' => $picsumUrl,
    ]);
    }

    private function fetchPicsumImageUrl()
    {
        $picsumBaseUrl = 'https://picsum.photos/200';
        $headers = get_headers($picsumBaseUrl, 1);

        if (isset($headers['Location'])) {
            return is_array($headers['Location']) ? end($headers['Location']) : $headers['Location'];
        }
        return $picsumBaseUrl;
    }
}
