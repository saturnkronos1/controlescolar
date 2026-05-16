<?php

declare(strict_types=1);

namespace App\Http\Responses;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

class LoginResponse implements LoginResponseContract
{
    /**
     * Handle login response.
     */
    public function toResponse($request): RedirectResponse
    {
        return redirect()->route(
            $this->getDashboardRoute()
        );
    }

    /**
     * Determine dashboard route according to user role.
     */
    private function getDashboardRoute(): string
    {
        $user = Auth::user();

        if ($user->hasRole('Super Admin')) {
            return 'admin.dashboard';
        }

        if ($user->hasRole('Administrador')) {
            return 'admin.dashboard';
        }

        if ($user->hasRole('Director')) {
            return 'direccion.dashboard';
        }

        if ($user->hasRole('Subdirector')) {
            return 'direccion.dashboard';
        }

        if ($user->hasRole('Docente')) {
            return 'docente.dashboard';
        }

        if ($user->hasRole('Tutor')) {
            return 'tutor.dashboard';
        }

        abort(403);
    }
}
