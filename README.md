# bitlist

1. База данных находится в папке /admin (подключать в /functions/connect.php)

2. Данные от админки root:bitroot (пароль в md5 хеше, добавлять новых админ-пользователей только через базу)

3. Для добавления новой монеты надо указать точное имя short_name (данные подгружаются через веб-сокет 'wss://ws-feed.pro.coinbase.com')

###

1. The database is located in the /admin folder (connect in /functions/connect.php)

2. Data from admin root:bitroot (password in md5 hash, add new admin users only through the database)

3. To add a new coin it is necessary to specify the exact name short_name (data is loaded via web socket 'wss://ws-feed.pro.coinbase.com')
