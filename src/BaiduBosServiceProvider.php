<?php

namespace Sulao\LaravelFilesystem\BaiduBos;

use Illuminate\Filesystem\FilesystemAdapter;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\ServiceProvider;
use League\Flysystem\Filesystem;
use Sulao\BaiduBos\Client;
use Sulao\Flysystem\BaiduBos\BaiduBosAdapter;

class BaiduBosServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Storage::extend('bos', function ($app, $config) {
            $config += [
                'disable_asserts' => true,
                'case_sensitive' => true,
                'options' => [],
            ];

            $client = new Client([
                'access_key' => $config['access_key'],
                'secret_key' => $config['secret_key'],
                'bucket' => $config['bucket'],
                'region' => $config['region'],
                'options' => $config['options']
            ]);

            $adapter = new BaiduBosAdapter($client);

            return new FilesystemAdapter(new Filesystem($adapter, [
                'disable_asserts' => $config['disable_asserts'],
                'case_sensitive' => $config['case_sensitive'],
            ]), $adapter);
        });
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
    }
}
