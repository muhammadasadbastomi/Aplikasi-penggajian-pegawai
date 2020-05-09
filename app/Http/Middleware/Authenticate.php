<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */

    protected function redirectTo($request)
    {
        $messages = [
            'email' => ':attribute harus benar.',
            'required' => ':attribute harus diisi.',
            'min' => ':attribute minimal harus 5 karakter.'
        ];
        $request->validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string', 'min:5'],
        ], $messages);

        if (!$request->expectsJson()) {
            return route('login');
        }
    }
}
