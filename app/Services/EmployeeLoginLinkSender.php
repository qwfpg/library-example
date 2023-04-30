<?php

namespace App\Services;

use App\Exceptions\NotificationSendingException;
use App\Models\User;
use App\Notifications\NewEmployeeNotification;
use Illuminate\Support\Facades\Password;

class EmployeeLoginLinkSender implements EmployeeLoginLinkSenderInterface
{
    public function sendLoginLink(User $user): void
    {
        if (!$user->isEmployee()) {
            return;
        }
        $token = Password::broker()->createToken($user);
        $url = url(route('password.reset', [
                'token' => $token,
                'email' => $user->email,
            ], false)
        );

        try {
            $user->notify(new NewEmployeeNotification($user, $url));
        } catch (\Throwable $exception) {
            throw new NotificationSendingException('Email notification with login link was not sent. ' . $exception->getMessage(), 0, $exception);
        }
    }
}
