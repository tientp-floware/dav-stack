<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Sabre\DAV;
class SabreDavServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

        $rootDirectory = new DAV\FS\Directory('storage/dav');

        $this->app->singleton('dav-server', function ($app) {
            // The server object is responsible for making sense out of the WebDAV protocol
            $server = new DAV\Server($rootDirectory);

            // If your server is not on your webroot, make sure the following line has the
            // correct information
            $server->setBaseUri('/');

            // The lock manager is reponsible for making sure users don't overwrite
            // each others changes.
            $lockBackend = new DAV\Locks\Backend\File('data/locks');
            $lockPlugin = new DAV\Locks\Plugin($lockBackend);
            $server->addPlugin($lockPlugin);

            // This ensures that we get a pretty index in the browser, but it is
            // optional.
            $server->addPlugin(new DAV\Browser\Plugin());

            // All we need to do now, is to fire up the server
            return $server->exec();
        });
    }
}
