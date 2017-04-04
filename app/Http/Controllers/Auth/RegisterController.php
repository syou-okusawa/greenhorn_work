<?php

namespace App\Http\Controllers\Auth;

use App\Entities\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\request;
use Illuminate\Support\Facades\DB;
use App\Repositories\UserInfosRepository;
use Illuminate\Support\Facades\Request as test;

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
    protected $redirectTo = '/';
    protected $register;
    protected $userinfo;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(User $user, UserInfosRepository $userinfo)
    {
        $this->middleware('guest');
        $this->register = $user;
        $this->userinfo = $userinfo;
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
            'name' => 'required|max:255',
            // 'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        $hex = $data['hash'];
        $password = "hogehoge";
        $gethex = hex2bin($hex);
        $decrypt = openssl_decrypt($gethex, 'aes-256-ecb', $password);
        $user = $this->userinfo->getUserRecord($decrypt);

        //Whereを使って、復号化したメアドを元にUSERINFOSテーブルのレコード取得している。
        // idwotoru
        // usertable infoid ni ireru hensuu ni ireru

        return $this->register->create([
            'name' => $data['name'],
            // 'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'user_info_id' => $user['id']

        ]);


    }

    //hex2bin関数とopenssl_decryptで16進数に変換されたメアドを元の文字列に戻す。

    //順番としては、１．アカウント登録ボタンが押された時に、URLも末尾に暗号化されているメアドを復号化して、２．それを元にUSERINFOSテーブルのそのメアドと同じメアドを持つユーザーのレコードを探す。３．そのレコードからIDを引っ張り、ユーザーテーブルに入れる。４．そして、ユーザーがアカウント登録画面で入力したユーザー名とパスワードと共にUSERINFOIDが保存される。

     
    public function register(Request $request)
    {

       $this->validator($request->all());

       $this->create($request->all());

    }

     protected function showRegistrationForm(Request $request)
     {
        $url = $request->query();
        return view('auth.register', compact('url'));
     }
}
