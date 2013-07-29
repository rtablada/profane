Laravel Profanity Filter
=========================

This package facilitates filtering profanity within your Eloquent models and your Laravel project.

## Installation Using Laravel 4 Package Installer

If you have [Laravel 4 Package Installer](https://github.com/rtablada/package-installer) installed you can install Profane by running `php artisan package:install rtablada/profane`.

## Installing Using Composer

If you do not have Pacakge Installer, you can install Profane by running `composer require rtablada/profane` and then modifying your `providers` in `app/config/app.php` to include `'Rtablada\Profane\FilterServiceProvider'` and your `aliases` to include `'Filter' => 'Rtablada\Profane\Facades\Filter'` and replace your existing Eloquent alias with: `'Eloquent' => 'Rtablada\Profane\Model'`.

## Using The Filter

The filter is quite simple and can be used at any time using the facade like this:

```php
$result = Filter::filter($input);
```

By default the filter erases all profane words. Alternatively, you can replace profane words using the second argument:

```php
$result = Filter::filter($input, '***');
```

## Using Filtered Models

With the standard installation process, all classes that extend the Eloquent Facade will now extend filtered models. This will retain all functionality with the added benifit of allowing you to specify filtered fields with a `protected $filtered` parameter. You can also define the replacement string used in the filter with a `protected $filterReplace`. An example model could be:

```php
class Post extends Eloquent
{
	protected $filtered = array(
		'title',
		'body',
	);

	protected $filterReplace = '***';
}
```
