<?php

namespace App\Providers;

use DB;
use Illuminate\Support\Arr;
use LaravelSabre\LaravelSabre;
use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

use Sabre\CalDAV\CalendarRoot;
use Sabre\CalDAV\ICSExportPlugin;
use Sabre\CardDAV\VCFExportPlugin;
use Sabre\CalDAV\Plugin as CalDAVPlugin;
use Sabre\DAV\Auth\Plugin as AuthPlugin;
use Sabre\DAV\Sync\Plugin as SyncPlugin;
use Sabre\CardDAV\Plugin as CardDAVPlugin;
use Sabre\DAV\Browser\Plugin as BrowserPlugin;
use Sabre\DAVACL\Plugin as AclPlugin;
use Sabre\DAVACL\PrincipalCollection;
use App\Http\Controllers\DAV\DAVRedirect;
use App\Http\Controllers\DAV\Auth\AuthBackend;

/* use Sabre\DAVACL\PrincipalBackend\PDO as PrincipalBackend;
use Sabre\CardDAV\Backend\PDO as CardDAVBackend;
use Sabre\CardDAV\AddressBookRoot;
use Sabre\CalDAV\Backend\PDO as CalDAVBackend; */

use App\Http\Controllers\DAV\DAVACL\PrincipalBackend;
use App\Http\Controllers\DAV\Backend\CalDAV\CalDAVBackend;
use App\Http\Controllers\DAV\Backend\CardDAV\CardDAVBackend;
use App\Http\Controllers\DAV\Backend\CardDAV\AddressBookRoot;

class DAVServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        LaravelSabre::nodes(function () {
            return $this->nodes();
        });
        LaravelSabre::plugins(function () {
            return $this->plugins();
        });
        LaravelSabre::auth(function (\Illuminate\Http\Request $request): bool {         
            if ($request->user()->admin || config('laravelsabre.users') == null) {
                return true;
            }
        });
    }

    /**
     * List of nodes for DAV Collection.
     */
    private function nodes(): array
    {

        $pdo = DB::connection()->getPdo();
        // Initiate custom backends for link between Sabre and Monica
        $principalBackend = new PrincipalBackend();   // User rights
        $carddavBackend = new CardDAVBackend();       // Contacts
        $caldavBackend = new CalDAVBackend();         // Calendar

        return [
            new PrincipalCollection($principalBackend),
            new AddressBookRoot($principalBackend, $carddavBackend),
            new CalendarRoot($principalBackend, $caldavBackend),
        ];
    }

    /**
     * List of Sabre plugins.
     */
    private function plugins()
    {
        // Authentication backend
        $authBackend = new AuthBackend();
        yield new AuthPlugin($authBackend);

        // CardDAV plugin
        yield new CardDAVPlugin();
        yield new VCFExportPlugin();

        // CalDAV plugin
        yield new CalDAVPlugin();
        yield new ICSExportPlugin();

        // Sync Plugin - rfc6578
        yield new SyncPlugin();

        // ACL plugnin
        $aclPlugin = new AclPlugin();
        $aclPlugin->allowUnauthenticatedAccess = false;
        $aclPlugin->hideNodesFromListings = true;
        yield $aclPlugin;

        // Browser Plugin
        yield new BrowserPlugin();
        // In local environment add browser plugin
        if (App::environment('local')) {
            yield new BrowserPlugin(false);
        } else {
            yield new DAVRedirect();
        }
    }
}
