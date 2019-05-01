<?php

namespace App\Oauth\Implementation\Adapter;

interface ServerAdapterInterface {
    function authorize($request=null);
    function token($request=null);
    function resource($request=null);
}