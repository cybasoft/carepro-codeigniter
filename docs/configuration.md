# Configuration

## Logo

Logo image must be in `/assets/img` directory. A new logo can be uploaded in the settings page and will overwrite the current logo image file. For best results, your logo should be 200x45 pixels or 500x112 pixels.

## Company settings

> /application/production/config/config.php
You can configure your company settings in this configuration file.
If you are working on development instance, you can create a new folder inside config folder and copy config files in it, then edit your config development settings.

```php
$config['company'] = array(
    'name' => 'DaycarePRO',
    'slogan' => '',
    'phone' => '',
    'fax' => '',
    'email' => 'admin@app.com',
    'street' => '',
    'city' => '',
    'state' => '',
    'postal_code' => '',
    'country' => '',
    'timezone' => 'America/New_York', //http://php.net/manual/en/timezones.america.php
    'google_analytics' => '', //enter google analytics ID
    'currency_symbol' => '$',
    'currency_abbr' => 'USD',
    'date_format' => 'd M, Y H:ia',
    'logo' => 'logo.png', //logo must be in '/assets/img' directory
    'invoice_logo' => 'logo.png' //logo must be in '/assets/img' directory
);
$config['allow_registration'] = TRUE;
$config['allow_reset_password'] = TRUE;
$config['enable_captcha']=FALSE;
$config['maintenance_mode']=FALSE;

$config['demo_mode']=FALSE;
```

Change base_url to your site address. If you are accessing this installation on the web, it is highly advisable that you use SSL encryption (https).

`$config['base_url'] = 'https://yoursite.com';`

## Language & Translation

`/application/language/<language>`
You can translate the application using the language files located in the path above.
To get started, copy the English folder with all the files included in to another folder named the language of your choice.
Change the language configuration to the same name as the folder you named above.

`$config['language'] = 'english';`

Open the language files in and edit the second part that is the translation to whatever language you have chosen.
Creating migration files
If you have made any changes to the database tables or created new tables, you can generate new migration files using

`php artisan migration create`

> IMPORTANT: Your application must be in development environment in order to run this command.

By default, allowing user self-registration will not assign them to any role, you will need to add their role manually.