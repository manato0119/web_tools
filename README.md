# web_tools

- キャプチャ取得

```
git clone https://github.com/manato0119/web_tools
cd web_tools
composer install
mkdir img
vi list.txt  # urlの一覧
php get_capture.php
```

- SSL期限取得

```
git clone https://github.com/manato0119/web_tools
cd web_tools
vi list.txt  # domainの一覧
php get_ssl.php
```

- メタ情報取得

```
git clone https://github.com/manato0119/web_tools
cd web_tools
vi list.txt  # urlの一覧
php get_meta.php
```

- SMTPメール送信

```
git clone https://github.com/manato0119/web_tools
cd web_tools
vi config.php
```

```php
<?php 

    define('MAIL_HOST', 'xxxxxxxxxx');     // メールサーバのIPなど
    define('MAIL_PORT', 'xxxxxxxxxx');     // SMTPポート（25,587 ...）
    define('MAIL_FROM', 'xxxxxxxxxx');     // RETURN-PATH: に設定されるメールアドレス
    define('MAIL_TO',   'xxxxxxxxxx');     // 送信先メールアドレス
    define('MAIL_PROTOCOL', 'xxxxxxxxxx'); // 認証が必要なければ 'SMTP' でよい
    define('MAIL_USER', 'xxxxxxxxxx');     // SMTP認証ユーザ
    define('MAIL_PASS', 'xxxxxxxxxx');     // SMTP認証パスワード 
```

```
php mail.php
```
