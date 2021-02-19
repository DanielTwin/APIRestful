<?php

namespace App\Traits;

trait AdminActions
{
	public function before($user, $ability)
    {
        if ($user->isAdministator()) {
            return true;
        }
    }
}
