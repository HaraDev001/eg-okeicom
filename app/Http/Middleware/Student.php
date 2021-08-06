<?php

namespace App\Http\Middleware;

use App\Models\User;
use App\Models\Cancel;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Factory;

class Student
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
        // 受講者ダッシュボード共通変数(未実装)
//        $cancel_count = $this->cancel->getCancelPendingCount(Auth::user()->id);
//        $this->viewFactory->share('common_cancel_count', $cancel_count);
        return $next($request);
    }
}
