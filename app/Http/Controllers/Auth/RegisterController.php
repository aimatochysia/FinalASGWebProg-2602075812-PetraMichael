<?php

namespace App\Http\Controllers\Auth;
// <!-- app/http/controllers/auth/regis controller -->
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
        $randomPrice = session('random_price');

        return Validator::make($data, [
            'username' => ['required', 'string', 'max:255'],
            'instagram_username' => ['nullable', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'gender' => ['required', 'in:male,female,other'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'mobile_number' => ['required', 'string', 'regex:/^\d{10,15}$/'],
            'price' => ['required','integer',
                function ($attribute, $value, $fail) use ($randomPrice) {
                    if ($value < $randomPrice) {
                        $fail(__('The entered price is less than the required amount.'));
                    } elseif ($value > $randomPrice) {
                        $fail(__('The entered price is greater than the required amount.'));
                    }},],
            'hobbies' => ['required', 'array', 'min:2'],
            'hobbies.*' => ['string', 'max:30'],
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
    // Create the user first
    $user = User::create([
        'username' => $data['username'],
        'instagram_username' => $data['instagram_username'],
        'email' => $data['email'],
        'gender' => $data['gender'],
        'password' => Hash::make($data['password']),
        'mobile_number' => $data['mobile_number'],
        'price' => $data['price'],
        'profile_picture' => $this->fetchPicsumImageUrl(),
    ]);

    // Check if hobbies exist and save them
    if (isset($data['hobbies'])) {
        foreach ($data['hobbies'] as $hobbyName) {
            $user->hobbies()->create(['name' => $hobbyName]);
        }
    }

    // Return the user after hobbies have been saved
    return $user;
}

    private function fetchPicsumImageUrl()
    {
        $picsumBaseUrl = 'https://picsum.photos/200';
        $ch = curl_init($picsumBaseUrl);
        curl_setopt($ch, CURLOPT_HEADER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        $finalUrl = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL);
        curl_close($ch);
        $urlParts = parse_url($finalUrl);

        if (isset($urlParts['path'])) {
            return 'https://picsum.photos' . $urlParts['path'];
        }
        return $picsumBaseUrl;
    }

    public function showRegistrationForm()
    {
        $randomPrice = rand(20000, 25000);
        session(['random_price' => $randomPrice]);
        return view('auth.register', ['randomPrice' => $randomPrice]);
    }
}
