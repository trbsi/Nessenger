<?php

use App\Routes\ApiRoute;

if (! function_exists('api_route')) {
    /**
     * Generate the URL to a named route.
     *
     * @param  array|string  $name
     * @param  mixed  $parameters
     * @param  bool  $absolute
     * @return string
     */
    function api_route($name, $parameters = [], $absolute = true)
    {
        $name = ApiRoute::name($name);
        return route($name, $parameters, $absolute);
    }
}
