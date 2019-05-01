<?php

namespace App\Oauth\Base;

interface DataInterface {
    /**
     * Populate current instance from array
     */
    function fromArray($array);
}