<?php

use Illuminate\Support\Facades\Broadcast;



Broadcast::channel('chat', function ($user) {
    return \Illuminate\Support\Facades\Auth::check();
});

