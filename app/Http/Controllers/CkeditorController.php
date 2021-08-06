<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CkeditorController extends Controller
{
    /**
     * Ckeditorの画像をアップロードする
     *
     * @param Request $request
     */
    public function upload(Request $request)
    {
        if ($request->hasFile('upload')) {
            $file = $request->file('upload');
            // 保存用ファイル名を生成
            $storeFilename =
                // ファイル名
                pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME).
                // 名前が重複しないようにアップロードした時間をつけとく
                '_'. time(). '.'.
                // 拡張子をつける
                $file->getClientOriginalExtension();

            // アップロード処理
            $file->storeAs('public/uploads', $storeFilename);
            // ckeditor.jsに返却するデータを生成する
            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $url = asset('storage/uploads/'. $storeFilename);
            $msg = 'アップロードが完了しました';
            $res = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";

            // HTMLを返す
            @header('Content-type: text/html; charset=utf-8');
            echo $res;
        }
    }
}
