`git clone https://github.com/anvar0142/symfony-console.git`

`composer install`

configure db file `/config/bootstrap.php`

```$dbParams = array(
     'driver'   => 'pdo_mysql',
     'user'     => 'root',
     'password' => '',
     'dbname'   => 'sp',
 );
```
run command:
`"vendor/bin/doctrine.bat" orm:schema-tool:update --force`

view commands:

`php bin/console list`


