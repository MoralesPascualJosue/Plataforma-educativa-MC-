<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use App\Models\Estudiante;
use App\Models\Asesor;
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
    protected $redirectTo = RouteServiceProvider::HOME;

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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'bio',
            'image',
            'instituto' => ['required', 'string', 'max:255'],
            'departamento' => ['required', 'string', 'max:255'],
            'telephone'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'image' => 'photos/ileLyX10t6kFGvmYCYGT6VDIGgeOwoXL1PKFg7FR.png',
            'password' => Hash::make($data['password']),
        ]);

        if($data['radio3'] == "Asesor"){
            Asesor::create([
            'user_id'=> $user->id,
            'name' => $data['name'],
            'image' => 'photos/ileLyX10t6kFGvmYCYGT6VDIGgeOwoXL1PKFg7FR.png',
            'bio' => " ",
            'institute' => $data['instituto'],
            'department' => $data['departamento'],
            'telephone' => "0"+$data['telephone']
            ]);
        }else{
            Estudiante::create([
            'user_id'=> $user->id,
            'name' => $data['name'],
            'image' => 'photos/ileLyX10t6kFGvmYCYGT6VDIGgeOwoXL1PKFg7FR.png',
            'bio' => " ",
            'institute' => $data['instituto'],
            'department' => $data['departamento'],
            'telephone' => "0"+$data['telephone']
            ]);
        }

        $user->assignRole($data['radio3']);
            
        return $user;
    }
}
