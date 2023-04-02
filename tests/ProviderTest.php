<?php

// phpcs:disable PSR1.Classes.ClassDeclaration.MissingNamespace

use Illuminate\Config\Repository;
use Illuminate\Filesystem\FilesystemServiceProvider;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Facade;
use Illuminate\Support\Facades\Storage;
use PHPUnit\Framework\TestCase;
use Sulao\LaravelFilesystem\BaiduBos\BaiduBosServiceProvider;

class ProviderTest extends TestCase
{
    public function testProvider()
    {
        $app = $this->getApp();
        $app->register(BaiduBosServiceProvider::class);
        $app->boot();

        $this->assertTrue(
            Storage::disk('bos')->put('laravel_bos.txt', 'laravel bos')
        );

        $this->assertTrue(
            Storage::disk('bos2')->exists('laravel_bos.txt')
        );

        $this->assertTrue(
            Storage::delete('laravel_bos.txt')
        );

        $this->assertFalse(
            Storage::disk('bos2')->exists('laravel_bos.txt')
        );
    }

    protected function getApp()
    {
        $app = new Application(__DIR__);
        Facade::setFacadeApplication($app);
        $app->register(FilesystemServiceProvider::class);

        $filesystems = [
            'default' => 'bos',
            'disks' => [
                'bos' => [
                    'driver' => 'bos',
                    'access_key' => env('BOS_KEY'),
                    'secret_key' => env('BOS_SECRET'),
                    'region' => 'gz',
                    'bucket' => 'xinningsu',
                ],
                'bos2' => [
                    'driver' => 'bos',
                    'access_key' => env('BOS_KEY'),
                    'secret_key' => env('BOS_SECRET'),
                    'region' => 'gz',
                    'bucket' => 'xinningsu',
                    'disable_asserts' => false,
                    'case_sensitive' => true,
                    'options' => ['connect_timeout' => 10],
                ],
            ],

        ];
        $config = new Repository();
        $config->set('filesystems', $filesystems);
        $app->instance('config', $config);

        return $app;
    }
}
