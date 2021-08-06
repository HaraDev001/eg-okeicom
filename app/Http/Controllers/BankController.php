<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
// use App\Models\OthersBank;
// use App\Models\JapansBank;
use App\Models\Bank;
use App\Models\BankJapan;
use App\Models\BankOther;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateBank;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class BankController extends Controller
{
    // private $others_bank;
    // private $japans_bank;
    private $bank_japan;
    private $bank_other;

    public function __construct(
        // OthersBank $others_bank,
        // JapansBank $japans_bank,
        BankJapan $bank_japan,
        BankOther $bank_other
    )
    {
        $this->others_bank = $bank_other;
        $this->japans_bank = $bank_japan;
    }

    /**
     *
     * 銀行口座情報 表示
     *
     */
    public function show()
    {
        // DBから銀行情報を取得する
        $userId = Auth::id();
        $bankNew = new Bank();
        $bank = $bankNew->showBank($userId);

        return view('users.banks_show', compact('bank'));
        // 銀行情報を取得する

        // $bankDate = '';
        // $target = '';
        // if(JapansBank::where('user_id', $userId)->first()) {
        //     $bankDate = JapansBank::where('user_id', $userId)->first();
        //     $target = 0;
        // } elseif(OthersBank::where('user_id', $userId)->first()) {
        //     $bankDate = OthersBank::where('user_id', $userId)->first();
        //     $target = 1;
        // }
        // return view('users.banks_show', compact('bankDate', 'target'));
    }

    /**
     *
     * 銀行口座情報 編集画面
     *
     */
    public function edit()
    {
        // DBから銀行情報を取得する
        $userId = Auth::id();
        $bankNew = new Bank();
        $bank = $bankNew->showBank($userId);

        return view('users.banks_edit', compact('bank'));

        // 銀行情報を取得する
        // $bankDate = '';
        // $target = '';
        // if(JapansBank::where('user_id', $userId)->first()) {
        //     // ゆうちょ銀行
        //     $bankDate = JapansBank::where('user_id', $userId)->first();
        //     $bankDate['japan_name'] = $bankDate['name'];
        //     $bankDate['japan_number'] = $bankDate['number'];
        //     $target = 0;
        // } elseif(OthersBank::where('user_id', $userId)->first()) {
        //     // その他銀行
        //     $bankDate = OthersBank::where('user_id', $userId)->first();
        //     $bankDate['other_name'] = $bankDate['name'];
        //     $bankDate['other_number'] = $bankDate['number'];
        //     $target = 1;
        // }

        // if($bankDate) {
        //     session([
        //         'bank_type' => $target,
        //         'bank_id'   => $bankDate->id,
        //     ]);
        // }

        // return view('users.banks_edit', compact('bankDate', 'target'));
    }

    /**
     *
     * 銀行口座情報 更新
     *
     */
    public function update(UpdateBank $request)
    // public function update(request $request)
    {
        $banks = $request->validated();
        $userId = Auth::id();

        // 銀行情報の登録処理を呼び出す
        $bankNew = new Bank();
        DB::beginTransaction();
        try {
          // 銀行情報を登録して、レスポンスを受け取る
          $res = $bankNew->storeBank($banks, $userId);
          if(is_numeric($res)) {
            // レスポンスが登録成功の場合
            DB::commit();
            return redirect(route('mypage.t.bank.show'));
          } else {
            // レスポンスが登録失敗の場合
            DB::rollBack();
            return back()->withInput()->withErrors($res);
          }
        } catch(\Exception $e) {
          // 予期せぬエラーの場合
          $res = '予期せぬエラーが発生しました。管理者へお問い合わせください。';
          return back()->withInput()->withErrors($res);
        }

        // エラーがあるか確認の処理
        // if(is_numeric($res)) {
        //     return redirect(route('mypage.t.bank.show'));
        // } else {
        //     return back()->withInput()->withErrors($res);
        // }


        // // バージョン1
        // /* パラーメーター設定 */
        // // バリデーションの値を取得する
        // $validated = $request->validated();
        // // ユーザーID
        // $user_id = Auth::id();

        // // dd(isset($validated['other_financial_name']));
        // /* トランザクションをしく */
        // // DBに登録
        // DB::transaction(function () use($validated, $request, $user_id) {
        //     // １．登録済みの銀行の情報を削除
        //     if(JapansBank::find(session('bank_id'))) {
        //         $register_bank = JapansBank::find(session('bank_id'));
        //         if($register_bank) {
        //             $register_bank->delete();
        //             $register_bank->save();
        //         }
        //     }
        //     if(OthersBank::find(session('bank_id'))) {
        //         // 登録済み情報を論理削除
        //         $register_bank = OthersBank::find(session('bank_id'));
        //         if($register_bank) {
        //             $register_bank->delete();
        //             $register_bank->save();
        //         }
        //     }

        //     // ２．銀行の登録
        //     if(isset($validated['yucho_mark'])) {
        //         $japan_bank = new JapansBank();
        //         $date = $japan_bank->registerJapanBank($request, $user_id);
        //     }
        //     // その他銀行の登録作業
        //     if(isset($validated['other_financial_name'])) {
        //         $other_bank = new OthersBank();
        //         $date = $other_bank->registerOtherBank($request, $user_id);
        //     };
        // });

        // // セッションをリセット
        // $request->session()->forget('bank_type');
        // $request->session()->forget('bank_id');

        // // 銀行の編集画面にリダイレクト処理
        // $url = '';
        // if(Auth::user()->status == 0) {
        //     $url = 'mypage.u.bank.show';
        // } else {
        //     $url = 'mypage.t.bank.show';
        // }
        // return redirect(route($url));
    }
}
