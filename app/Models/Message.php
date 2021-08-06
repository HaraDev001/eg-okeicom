<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class Message extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_send_id',
        'user_receive_id',
        'message_detail',
        'file1',
        'file2',
        'file3',
        'is_read',
    ];

    /**
     * キャストする属性
     *
     * @var array
     */
    protected $casts = [
        'is_read' => 'boolean',
    ];

    /**
     * 作成日付を西暦ハイフン区切り時刻なしにフォーマット
     *
     * @return string
     */
    public function getSeparateHyphenCreatedAtAttribute()
    {
        return $this->created_at->format("Y-m-d");
    }

    /**
     * 作成時刻を取得
     *
     * @return string
     */
    public function getCreatedTimeAttribute()
    {
        return $this->created_at->format("H:i");
    }
    /**
     *
     * ファイル保存処理
     * @return Array
     *
     */
    public function messageList()
    {
        return Message::select([
            'messages.*',
            'receiver.account as receive_name',
            'receiver.id as receive_id',
            'sender.account as send_name',
            'sender.id as send_id',
        ])
        ->leftJoin('users as receiver', 'messages.user_receive_id', '=', 'receiver.id')
        ->leftJoin('users as sender', 'messages.user_send_id', '=', 'sender.id')
        ->get();
    }

    /**
     * ファイル保存処理
     */
    public function saveImgs($request)
    {
        if ($request->hasFile('message_file')) {
            if (array_key_exists(0, $request->file('message_file')) && $request->file('message_file.0')->isValid()) {
                $this->file1 = basename(Storage::putFile(Config::get('const.file_path.message'), $request->file('message_file.0')));
            }
            if (array_key_exists(1, $request->file('message_file')) && $request->file('message_file.1')->isValid()) {
                $this->file2 = basename(Storage::putFile(Config::get('const.file_path.message'), $request->file('message_file.1')));
            }
            if (array_key_exists(2, $request->file('message_file')) && $request->file('message_file.2')->isValid()) {
                $this->file3 = basename(Storage::putFile(Config::get('const.file_path.message'), $request->file('message_file.2')));
            }
        }
    }

    /**
     * ファイル1の公開パスを取得
     * @return string
     */
    public function getPublicPathFile1Attribute()
    {
        return '/storage/messages/' . $this->file1;
    }
    /**
     * ファイル2の公開パスを取得
     * @return string
     */
    public function getPublicPathFile2Attribute()
    {
        return '/storage/messages/' . $this->file2;
    }
    /**
     * ファイル3の公開パスを取得
     * @return string
     */
    public function getPublicPathFile3Attribute()
    {
        return '/storage/messages/' . $this->file3;
    }

    /**
     * メッセージを既読にする
     *
     * @param Collection $messages
     */
    public function saveRead(Collection $messages)
    {
        $messages->transform(function ($message) {
            if ($message->user_receive_id == Auth::user()->id && !$message->is_read) {
                // DB更新
                Message::query()->find($message->id)->update(['is_read' => true]);
                // コレクション更新
                $message->is_read = true;
            }
            return $message;
        });
    }

    /**
     * 受送信ユーザー一覧と最新メッセージ取得
     *
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getUsersWithLatestMessage()
    {
        // 受信メッセージのユーザ一覧(送信してきたユーザ一リスト)
        $query_send_users = self::query()
            ->select([
                'messages.id as id',
                'messages.is_read as is_read',
                'users.id as users_id',
                'users.name as users_name',
                'users.img as users_img',
            ])
            ->join('users', 'messages.user_send_id', '=', 'users.id')
            ->where('messages.user_receive_id', Auth::user()->id);

        // 受信メッセージのユーザ一覧＋送信メッセージのユーザ一覧。自身が送信した場合は、既読フラグは強制的にtrue
        $query_users = self::query()
            ->select([
                'messages.id as id',
                DB::raw('1 as is_read'),
                'users.id as users_id',
                'users.name as users_name',
                'users.img as users_img',
            ])
            ->join('users', 'messages.user_receive_id', '=', 'users.id')
            ->where('messages.user_send_id', Auth::user()->id)
            ->unionAll($query_send_users);

        // やり取りしたユーザ一覧から最新メッセージIDを取得
        $query_latest_messages = User::query()
            ->select([
                DB::raw('MAX(partner_users.id) as max_messages_id'),
                DB::raw('MIN(partner_users.is_read) as is_all_read'),
                'partner_users.users_id',
                'partner_users.users_name',
                'partner_users.users_img',
            ])
            ->joinSub($query_users, 'partner_users', function ($join) {
                $join->on('users.id', '=', 'partner_users.users_id');
            })
            ->groupBy([
                'partner_users.users_id',
                'partner_users.users_name',
                'partner_users.users_img',
            ]);

        // 最新メッセージIDからメッセージ詳細を取得
        return self::query()
            ->select([
                'messages.*',
                'latest_messages.*',
            ])
            ->joinSub($query_latest_messages, 'latest_messages', function ($join) {
                $join->on('messages.id', '=', 'latest_messages.max_messages_id');
            })
            ->orderBy('messages.created_at', 'desc')
            ->get();
    }

    /**
     * 指定ユーザとの会話を取得
     *
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getConversation(int $partner_users_id)
    {
        return self::query()
            ->select([
                'messages.*',
                'users.name as users_name',
                'users.img as users_img',
            ])
            ->selectRaw($partner_users_id. ' as partner_users_id')
            ->join('users', 'messages.user_send_id', '=', 'users.id')
            ->where(function ($query) use ($partner_users_id) {
                $query->orwhere(function ($query) use ($partner_users_id) {
                   $query->where('messages.user_receive_id', Auth::user()->id)
                         ->where('messages.user_send_id', $partner_users_id);
                })->orWhere(function ($query) use ($partner_users_id) {
                   $query->where('messages.user_receive_id', $partner_users_id)
                         ->where('messages.user_send_id', Auth::user()->id);
                });
            })
            ->orderBy('messages.created_at')
            ->get();
    }
}
