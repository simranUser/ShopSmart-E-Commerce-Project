<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Session;
use \Stripe\Stripe;
use \Stripe\Account;


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
        if($data['roleradio']=='vender')
        {
            Stripe::setApiKey('sk_test_51KyTVvSFqPVpcKeoE4TIvK7no1IRfiT6Cue69TPfBiZp7g32N6GHgRzEOj4QXkc9okizp0wGz4MV0SBK40zCkRv500qcv5m9Ef');
            
            $account = Account::create([
                'type' => 'standard',    
                'country' => 'US',
                'email' => 'abc123@example.com',    
                'business_type'=>'individual',
                'individual'=>[
                    'first_name'=>'Abc',
                    'last_name'=>'123',
                    'dob'=>[
                        'day'=>'07',
                        'month'=>'08',
                        'year'=>'1998',
                    ],
                    'address'=>[
                    'city'=>'ludhiana', 
                    ],    
                ],
            ]);
            $accountId=$account->id;
        }
        else
        {
            $accountId=null;
        }
        // echo $account->id;
        return User::create([
            'name' => strip_tags($data['name']),
            'email' =>strip_tags( $data['email']),
            'password' => strip_tags(Hash::make($data['password'])),
            'role' => $data['roleradio'],
            'accountId'=>$accountId,
        ]);
    }
}
