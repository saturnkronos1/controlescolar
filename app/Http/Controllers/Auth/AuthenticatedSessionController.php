<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    /**
     * Handle authenticated user redirection.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->session()->regenerate();

        return redirect()->route(
            $this->getDashboardRoute()
        );
    }

    /**
     * Determine dashboard route according to role.
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
