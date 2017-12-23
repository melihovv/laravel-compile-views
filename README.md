# Laravel Compile Views

[![Build Status](https://travis-ci.org/melihovv/laravel-compile-views.svg?branch=master)](https://travis-ci.org/melihovv/laravel-compile-views)
[![styleci](https://styleci.io/repos/109587030/shield)](https://styleci.io/repos/109587030)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/melihovv/laravel-compile-views/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/melihovv/laravel-compile-views/?branch=master)
[![SensioLabsInsight](https://insight.sensiolabs.com/projects/28893314-076d-4940-bfc2-d5aac1bfec0b/mini.png)](https://insight.sensiolabs.com/projects/28893314-076d-4940-bfc2-d5aac1bfec0b)

[![Packagist](https://img.shields.io/packagist/v/melihovv/laravel-compile-views.svg)](https://packagist.org/packages/melihovv/laravel-compile-views)
[![Packagist](https://poser.pugx.org/melihovv/laravel-compile-views/d/total.svg)](https://packagist.org/packages/melihovv/laravel-compile-views)
[![Packagist](https://img.shields.io/packagist/l/melihovv/laravel-compile-views.svg)](https://packagist.org/packages/melihovv/laravel-compile-views)

Missing view:compile command for laravel.

The perfect solution in combination with [blade minifier](https://github.com/HTMLMin/Laravel-HTMLMin): get minified compiled views with zero cost during your deploy script.

## Installation

Install via composer
```bash
composer require melihovv/laravel-compile-views
```

**Following step is optional if you use laravel>=5.5 with package
auto discovery feature.**

Add service provider to `config/app.php` in `providers` section
```php
Melihovv\LaravelCompileViews\ServiceProvider::class,
```

## Usage

```bash
php artisan view:compile
```

## Security

If you discover any security related issues, please email amelihovv@ya.ru
instead of using the issue tracker.

## Credits

- [Alexander Melihov](https://github.com/melihovv/laravel-compile-views)
- [All contributors](https://github.com/melihovv/laravel-compile-views/graphs/contributors)

This package is bootstrapped with the help of
[melihovv/laravel-package-generator](https://github.com/melihovv/laravel-package-generator).
