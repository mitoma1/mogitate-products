環境構築
Dockerビルド

git clone git@github.com:estra-inc/confirmation-test-contact-form.git
DockerDesktopアプリを立ち上げる
docker-compose up -d --build

Laravel環境構築

docker-compose exec php bash
composer install
「.env.example」ファイルを 「.env」ファイルに命名を変更。または、新しく.envファイルを作成
.envに以下の環境変数を追加

DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=laravel_db
DB_USERNAME=laravel_user
DB_PASSWORD=laravel_pass

使用技術(実行環境)
PHP8.3.0
Laravel8.83.27
MySQL8.0.26

URL
開発環境：http://localhost/
phpMyAdmin:：http://localhost:8080/
