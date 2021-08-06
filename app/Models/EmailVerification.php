<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailVerification extends Model
{
    use HasFactory;

    const EXPIRATION_HOURS = 1;   // 有効期限のデフォルト(時間)
    const STATUS_SEND_MAIL = 0;   // 仮会員登録のメール送信
    const STATUS_MAIL_VERIFY = 1; // メールアドレス認証
    const STATUS_REGISTER = 2;    // 本会員登録完了

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email',
        'url_token',
        'status',
        'expiration',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'url_token',
    ];

    /**
     * 日付を変形する属性
     *
     * @var array
     */
    protected $dates = [
        'expiration',
        'deleted_at',
    ];

    /**
     * 仮会員登録
     *
     * @param $email
     * @param int $hours
     *
     * @return EmailVerification
     */
    public static function build($email, $hours = self::EXPIRATION_HOURS)
    {
        return new self([
            'email' => $email,
            'url_token' => md5(uniqid(rand(), true)),
            'status' => self::STATUS_SEND_MAIL,
            'expiration' => Carbon::now()->addHours($hours),
        ]);
    }

    /**
     * トークンに一致するデータを抽出
     *
     * @param $token
     *
     * @return mixed
     */
    public static function findByToken($token)
    {
        return self::query()
            ->where('url_token', '=', $token)
            ->whereIn('status', [self::STATUS_SEND_MAIL, self::STATUS_MAIL_VERIFY])
            ->first();
    }

    /**
     * 登録済みかどうかを取得
     *
     * @return bool
     */
    public function isRegister()
    {
        return $this->status === self::STATUS_REGISTER;
    }

    /**
     * 有効期限内かどうかを取得
     *
     * @return bool
     */
    public function isExpiration()
    {
        return $this->expiration >= Carbon::now();
    }

    /**
     * メールアドレス認証をセットする
     */
    public function mailVerify()
    {
        $this->status = self::STATUS_MAIL_VERIFY;
    }

    /**
     * 本会員登録完了をセットする
     */
    public function register()
    {
        $this->status = self::STATUS_REGISTER;
    }
}
