<?php
namespace App\Helpers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class WebResponseHelper
{
    /**
     * Set a flash message and redirect the user.
     *
     * @param string $message
     * @param bool $success
     * @param string $route
     * @param array $routeParams
     * @return RedirectResponse
     */
    public function flashAndRedirect(string $message, bool $success, string $route, array $routeParams = []): RedirectResponse
    {
        $this->flashMessage($message, $success);

        return Redirect::route($route, $routeParams);
    }

    /**
     * Set a flash message without redirecting (can be used for partial reloads).
     *
     * @param string $message
     * @param bool $success
     * @return void
     */
    public function flashMessage(string $message, bool $success)
    {
        Session::flash('message', $message);
        Session::flash('alert-class', $success ? 'alert-success' : 'alert-danger');
    }
}
