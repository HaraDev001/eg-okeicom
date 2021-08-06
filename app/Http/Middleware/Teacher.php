<?php

namespace App\Http\Middleware;

use App\Models\User;
use App\Models\Cancel;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Factory;

class Teacher
{
    public function __construct
    (
        Factory $viewFactory,
        Cancel $cancel
    )
    {
        $this->viewFactory = $viewFactory;
        $this->cancel = $cancel;
    }


    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // 講師ダッシュボード共通変数
        $cancel_count = $this->cancel->getCancelPendingCount(Auth::user()->id);
        $this->viewFactory->share('common_cancel_count', $cancel_count);

        return $next($request);
    }

    /**
     * ステータスの保存
     *
     * @param array $data
     */
    public function changeStatus($id) {
        $user = self::find($id);
        $user->status = 0;
        $user->save();
    }
}
