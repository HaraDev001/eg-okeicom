<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Mail\EvaluationRequest;
use App\Models\User;
use App\Models\Lesson;
use App\Models\Payment;
use App\Models\Application;
use App\Models\Evaluation;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class LessonFinish extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:lessonFinish';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'レッスンの終了時間に合わせて、レッスンを終了させる';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // レッスンの終了時刻を超えた場合、論理削除処理実装
        DB::beginTransaction();
        try {
            $lessons = Lesson::where('date', '=', Carbon::today())
                ->where('finish', '<=', Carbon::now())
                ->get();
            foreach($lessons as $lesson) {
                $lesson_id = $lesson->id;
                // レッスンと紐づく予約情報を取得し、論理削除を実行
                $applications = Application::where('lesson_id', '=', $lesson_id)->where('status', '=', 0)->get();
                if($applications) {
                    foreach($applications as $application) {
                        // 予約情報を確定し、ステータスを1に変更
                        $application->status = 1;
                        $application->delete();
                        $application->save();

                        // // 予約情報ごとに、決済履歴情報を登録
                        // $payment = new Payment();
                        // /* 講師IDを取得 */
                        // // レッスンIDを取得
                        // $lesson_id = $application->lesson_id;
                        // // レッスンIDから、レッスン情報を取得
                        // $lessonInstance = new Lesson();
                        // // レッスン情報から講師IDを取得する
                        // $teacher_id = $lessonInstance::find($lesson_id)->user_id;

                        // /* 受講者IDを取得 */
                        // $student_id = $application->user_id;

                        // /* 受講金額 */
                        // $price = $application->price;

                        // /* 決済登録処理 */
                        // $payment->user_teacher_id = $teacher_id;
                        // $payment->user_student_id = $student_id;
                        // $payment->lesson_id       = $lesson_id;
                        // $payment->amount          = $price;
                        // $payment->save();

                        /* 決済情報を変更する */
                        $payments = Payment::where('lesson_id', '=', $application->lesson_id)->get();
                        if($payments) {
                            foreach($payments as $payment) {
                                $payment->status = 1;
                                $payment->save();
                            }
                        }

                        /* 予約情報から評価情報を登録する */
                        // 過去のURLを全て取得する
                        $evaluation = Evaluation::create([
                            'user_student_id' => $application->user_id,
                            'user_teacher_id' => $lesson->user_id,
                            'lesson_id'       => $lesson_id,
                            'url'             => substr(bin2hex(random_bytes(64)), 0, 24),
                        ]);
                        $url = $evaluation->url; // 評価URL

                        /* 講師を評価するメール自動送信 */
                        $teacher = User::find($lesson->user_id)->name;
                        $email = new EvaluationRequest($lesson, $teacher, $url);
                        // 受講者のメールアドレスを取得する
                        $user = User::find($application->user_id);
                        $user_email = $user->email;
                        Mail::to($user_email)->send($email);

                        /* 予約情報を論理削除 */
                        $application->delete();
                        $application->save();

                    }
                }
                // レッスンを論理削除
                $lesson->delete();
                $lesson->save();
            }
            // トランザクション
            DB::commit();
        } catch(\Exception $e) {
            // rollバック処理
            DB::rollBack();
        }
    }
}
