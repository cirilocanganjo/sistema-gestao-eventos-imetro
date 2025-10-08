<?php

namespace App\Http\Middleware\Admin;

use \App\Models\User;
use App\Models\UserType;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Middleware
{
    protected $is_admin;

    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check()) {
        $this->is_admin = UserType::query()->where('uuid', auth()->user()->user_type_uuid)->whereIn('type', ['admin', 'Admin'])->value('type');
        if (auth()->user()->UserType->type === $this->is_admin ) {
            return $next($request);        
        }

    }else {
        return redirect()->route('user.login');
    }
}


}
