# おけい.com

## 構築手順(Docker)
* git clone後、プロジェクトフォルダにCD
* コンテナのビルド<br>
docker-compose build
* コンテナ起動<br>
docker-compose up -d
* PHPコンテナに接続<br>
docker exec -it php bash
* .env.exampleをコピーして.env作成<br>
cp .env.example .env
* composerインストール<br>
composer install
* アプリケーションキーの生成<br>
php artisan key:generate
* .envの編集（DBの設定）<br>
DB_HOST=mysql<br>
DB_PORT=3306<br>
DB_DATABASE=homestead<br>
DB_USERNAME=homestead<br>
DB_PASSWORD=secret<br>
※パスワードリセットメールを使用する場合は以下も設定(メールサーバに合わせて変更してください)<br>
MAIL_MAILER=smtp<br>
MAIL_HOST=smtp.mailtrap.io<br>
MAIL_PORT=2525<br>
MAIL_USERNAME=xxx<br>
MAIL_PASSWORD=yyy<br>
MAIL_ENCRYPTION=tls<br>
MAIL_FROM_ADDRESS=test@test.com<br>
MAIL_FROM_NAME="${APP_NAME}"<br>
* DBのマイグレーション<br>
php artisan migrate
* 画像保存フォルダへのシンボリックリンク作成<br>
php artisan storage:link
* npmインストール<br>
npm install
* Vue/Sassのビルド(※ここでコンパイルするのはjsのみ。cssはコンパイル後ファイルをpublicで管理)<br>
npm run dev
* 開発時にJSの変更のたびにトランスパイルしたい場合<br>
npm run watch
