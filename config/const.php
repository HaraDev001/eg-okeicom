<?php
/**
 * Const
 */
return [
    // ページネーション設定
    'paginate' => [
        // レッスン一覧
        'lesson' => 20,
        // 受講者登録済みレッスン一覧
        'attendanceLesson' => 10,
    ],
    // TOPページサムネイル表示件数
    'top_thumbnail_count' => 5,
    // 画像保存フォルダ名(storage/appからの相対パス)
    'image_path' => [
        // コース
        'course' => 'public/courses',
        // プロフィール
        'profile' => 'public/profile',
    ],
    // ファイル保存フォルダ名(storage/appからの相対パス)
    'file_path' => [
        // メッセージ
        'message' => 'public/messages',
    ]
];
