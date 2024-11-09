<?php

namespace Zaker\User\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Zaker\User\Http\Requests\Auth\ChangePasswordRequest;
use Zaker\User\Http\Requests\Auth\ResetPasswordVerifyCodeRequest;
use Zaker\User\Http\Requests\Auth\SendResetPasswordVerifyCodeRequest;
use Zaker\User\Repositories\UserInterface;
use Zaker\User\Services\UserService;
use Zaker\User\Services\VerifyCodeService;

class PasswordResetController extends Controller
{
    public $repo;
    public function __construct(UserInterface $repo)
    {
        $this->repo = $repo;
    }
    public function passwordResetCode(SendResetPasswordVerifyCodeRequest $request)
    {
        $user = $this->repo->findBy(['email'=>$request->email]);
        if (!$user)
            throw new ModelNotFoundException('کاربری با این ایمیل یافت نشد');

        if ($user && !VerifyCodeService::has($user->id)){
            $user->sendResetPasswordRequestNotification();
        }

        return response(['message' => 'به ایمیل شما کدی ارسال شد'], 200);
    }

    public function checkVerifyCode(ResetPasswordVerifyCodeRequest $request)
    {
        $user = $this->repo->findBy(['email'=>$request->email]);
        if (!$user)
            throw new ModelNotFoundException('کاربری با این ایمیل یافت نشد');

        if (!VerifyCodeService::check($user->id,$request->verify_code))
            throw new ModelNotFoundException('کد وارد شده معتبر نمی باشد');

        return response(['message' => 'کد وارد شده صحیح می باشد'], 200);
    }

    public function NewPassword(ChangePasswordRequest $request)
    {
        UserService::changePassword(auth()->user(),$request->password);

        return response(['message' => 'ورود موفقیت آمیز'], 200);
    }
}
