<?php

namespace App\Services;

use App\Models\User;

interface EmployeeLoginLinkSenderInterface
{
    public function sendLoginLink(User $user): void;
}
