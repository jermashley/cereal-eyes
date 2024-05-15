<?php

namespace App\Observers;

use App\Models\Decode;
use Crypt;

class DecodeObserver
{
    /**
     * Handle the Decode "saving" event.
     */
    public function saving(Decode $decode): void
    {
        $decode->data = Crypt::encrypt($decode->data);
    }

    /**
     * Handle the Decode "saving" event.
     */
    public function retrieved(Decode $decode): void
    {
        $decode->data = Crypt::decrypt($decode->data);
    }
}
