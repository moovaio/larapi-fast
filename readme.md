## LarapiFast - Package of generators for [Larapi](https://github.com/Versoo/larapi)

### Instalation

For install package run command:

```composer require --dev versoo/larapi-fast```

After success installation you can use all commands. All of them you can found with descriptions in [Wiki](https://github.com/Versoo/larapi/wiki)

### Custom configuration

Custom configuration allow you to change default directories of creating files. If you need, you should publish custom config file with command:

```php artisan vendor:publish --tag=LarapiFast```

You should see:

```Copied File [/vendor/versoo/larapi-fast/src/Config/versoo.larapi-fast.php] To [/config/versoo.larapi-fast.php]```

Now you can edit file (Default: /config/versoo.larapi-fast.php) in your app config folder.
