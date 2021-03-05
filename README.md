# Laravel Filesystem Baidu BOS

Baidu BOS storage for Laravel, 百度对象存储作为Laravel文件存储。

[![MIT licensed](https://img.shields.io/badge/license-MIT-blue.svg)](./LICENSE)
[![Build Status](https://api.travis-ci.org/xinningsu/laravel-filesystem-baidu-bos.svg?branch=master)](https://travis-ci.org/xinningsu/laravel-filesystem-baidu-bos)
[![Coverage Status](https://coveralls.io/repos/github/xinningsu/laravel-filesystem-baidu-bos/badge.svg?branch=master)](https://coveralls.io/github/xinningsu/laravel-filesystem-baidu-bos)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/xinningsu/laravel-filesystem-baidu-bos/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/xinningsu/laravel-filesystem-baidu-bos)
[![Code Intelligence Status](https://scrutinizer-ci.com/g/xinningsu/laravel-filesystem-baidu-bos/badges/code-intelligence.svg?b=master)](https://scrutinizer-ci.com/g/xinningsu/laravel-filesystem-baidu-bos)
[![Quality Gate Status](https://sonarcloud.io/api/project_badges/measure?project=xinningsu_laravel-filesystem-baidu-bos&metric=alert_status)](https://sonarcloud.io/dashboard?id=xinningsu_laravel-filesystem-baidu-bos)
[![Reliability Rating](https://sonarcloud.io/api/project_badges/measure?project=xinningsu_laravel-filesystem-baidu-bos&metric=reliability_rating)](https://sonarcloud.io/dashboard?id=xinningsu_laravel-filesystem-baidu-bos)
[![Security Rating](https://sonarcloud.io/api/project_badges/measure?project=xinningsu_laravel-filesystem-baidu-bos&metric=security_rating)](https://sonarcloud.io/dashboard?id=xinningsu_laravel-filesystem-baidu-bos)
[![Maintainability](https://api.codeclimate.com/v1/badges/a56225bae92ae3336edf/maintainability)](https://codeclimate.com/github/xinningsu/laravel-filesystem-baidu-bos/maintainability)

# Installation

```
composer require xinningsu/laravel-filesystem-baidu-bos

```

## Discovery

- For Laravel >= 5.5, It uses package auto discovery feature, no need to add service provider.
- For Laravel < 5.5, add `Sulao\LaravelFilesystem\BaiduBos\BaiduBosServiceProvider::class` to `config/app.php` under `providers` element.
```php
return [
    // ...
    'providers' => [
        // ...
        /*
         * Package Service Providers...
         */
        Sulao\LaravelFilesystem\BaiduBos\BaiduBosServiceProvider::class,
    ],
    // ...
];
```
## Configuration

Set up bos credentials in .env, then add new disk in `config/filesystems.php`:
```php
return [
    // ...
    'disks' => [
        // ...
        'bos' => [
            'driver' => 'bos',
            'access_key' => env('BOS_KEY'),
            'secret_key' => env('BOS_SECRET'),
            'region' => env('BOS_REGION'), // gz, bj ...
            'bucket' => env('BOS_BUCKET'),
        ],
        // ...
    ],
    // ...
];
```

# Examples

```php
$disk = \Illuminate\Support\Facades\Storage::disk('bos');

// Determine if a file exists.
$disk->exists('file.txt');

// Get the contents of a file.
$content = $disk->get('file.txt');

// Get a resource to read the file.
$stream = $disk->readStream('file.txt');

// Write the contents of a file.
$disk->put('file.txt', 'contents');

// Write a new file using a stream.
$disk->writeStream('file.txt', fopen('/resource.txt', 'r'));

// Get the visibility for the given path.
$visibility = $disk->getVisibility('file.txt');

// Set the visibility for the given path.
$disk->setVisibility('file.txt', 'public');

// Prepend to a file.
$disk->prepend('file.txt', 'prepend contents');

// Append to a file.
$disk->append('file.txt', 'append contents');

// Delete the file(s) at a given path.
$disk->delete('file.txt');
$disk->delete(['file.txt', 'file2.txt']);

// Copy a file to a new location.
$disk->copy('file.txt', 'new_file.txt');

// Move a file to a new location.
$disk->move('file.txt', 'new_file.txt');

// Get the file size of a given file.
$size = $disk->size('file.txt');

// Get the file's last modification time.
$ts = $disk->lastModified('file.txt');

// Get an array of all files in a directory.
$files = $disk->files($directory = 'test/', $recursive = false);

// Get all of the files from the given directory (recursive).
$allFiles = $disk->allFiles($directory = null);

// Get all of the directories within a given directory.
$dirs = $disk->directories($directory = null, $recursive = false);

// Get all (recursive) of the directories within a given directory.
$allDirs = $disk->allDirectories($directory = null);

// Create a directory.
$disk->makeDirectory('test/');

// Delete a directory.
$disk->deleteDirectory('test/');

```

# Reference

- [https://laravel.com/docs/filesystem#custom-filesystems](https://laravel.com/docs/filesystem#custom-filesystems)
- [https://github.com/xinningsu/flysystem-baidu-bos](https://github.com/xinningsu/flysystem-baidu-bos)
- [https://github.com/thephpleague/flysystem](https://github.com/thephpleague/flysystem)
- [https://github.com/xinningsu/baidu-bos](https://github.com/xinningsu/baidu-bos)
- [https://cloud.baidu.com/doc/BOS/index.html](https://cloud.baidu.com/doc/BOS/index.html)

# License

[MIT](./LICENSE)
