<?php

namespace App\Http\Controllers\AdminPanel\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\VerifyCodeRequest;
use App\Models\User;
use App\Services\VerifyCodeService;
use Illuminate\Auth\Events\Registered;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
//    public $repo;
//    public function __construct(UserInterface $repo)
//    {
//        $this->repo = $repo;
//    }

    public function register(\App\Http\Requests\Auth\RegisterRequest $request)
    {
//        $field = $request->getFieldName();
//        $value = $request->getFieldValue();
//
//        $code = random_verification_code(100000, 999999);
//
//        if ($user = $this->repo->findBy([$field=>$value])) {
//            if ($user->verified_at) {
//                throw new UserAlreadyRegisteredException('شما قبلا ثبت نام کرده اید');
//            }
//
//            return response(['message' => 'کد فعالسازی قبلا برای شما ارسال شده'], 200);
//        }
//
//        $user = [
//            'name'=> $request->name,
//            $field => $value,
//            'verify_code' => $code,
//            'password' => Hash::make($request->password),
//        ];
//
//        $this->repo->store($user);
//
//        Log::info('SEND-REGISTER-CODE-MESSAGE-TO-USER', ['code' => $code]);
//
//        return response(['message' => 'کاربر ثبت موقت شد'], 200);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'mobile'=>$request->mobile,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        return response(['message' => 'کاربر ثبت شد'], 200);
    }

    public function registerVerify(VerifyCodeRequest $request)
    {
//        $field = $request->getFieldName();
//        $value = $request->getFieldValue();
//
//        $code = $request->verify_code;
//
//        $user = $this->repo->findBy([$field => $value,'verify_code' => $code]);
//
//        if (empty($user)) {
//            throw new ModelNotFoundException('کاربری با کد مورد نظر یافت نشد');
//        }
//
//        $user->verify_code = null;
//        $user->verified_at = now();
//        $user->save();
//
//        return response($user, 200);
        if (!VerifyCodeService::check(auth()->id(),$request->verify_code))
            throw new ModelNotFoundException('کد وارد شده معتبر نمی باشد');

        auth()->user()->markEmailAsVerified();
        return response('ورود کاربر با موفقیت انجام شد',200);
    }
}
