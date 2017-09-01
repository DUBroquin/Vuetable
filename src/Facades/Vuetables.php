<?php

namespace dubroquin\vuetables\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class vuetables.
 *
 * @package dubroquin\vuetables\Facades
 * @author  Arjay Angeles <aqangeles@gmail.com>
 */
class Vuetables extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'vuetables';
    }
}
