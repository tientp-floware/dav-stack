<?php

namespace App\Http\Controllers;

use App\Models\User\User;

class SettingsController
{
   
    public function index()
    {
        $davroute = route('sabre.dav');
        
        // dd(auth());

        $email = auth()->user()->email;

        return view('settings.dav.index')
                ->withDavRoute($davroute)
                ->withCardDavRoute("{$davroute}/addressbooks/{$email}/contacts")
                ->withCalDavBirthdaysRoute("{$davroute}/calendars/{$email}/birthdays")
                ->withCalDavTasksRoute("{$davroute}/calendars/{$email}/tasks");
    }

}
