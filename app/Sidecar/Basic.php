<?php
/**
 * @author Aaron Francis <aarondfrancis@gmail.com|https://twitter.com/aarondfrancis>
 */

namespace App\Sidecar;

use Hammerstone\Sidecar\LambdaFunction;
use Hammerstone\Sidecar\Package;

class Basic extends LambdaFunction
{

    public function handler()
    {
        return 'sidecar/basic/index.handler';
    }

    public function runtime()
    {
        return 'python2.7';
    }

    public function package()
    {
        return [
            'sidecar/basic'
        ];
    }
}
