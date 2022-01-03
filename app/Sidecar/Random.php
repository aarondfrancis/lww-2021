<?php
/**
 * @author Aaron Francis <aarondfrancis@gmail.com|https://twitter.com/aarondfrancis>
 */

namespace App\Sidecar;

use Hammerstone\Sidecar\LambdaFunction;
use Hammerstone\Sidecar\Package;

class Random extends LambdaFunction
{

    public function handler()
    {
        return 'sidecar/random/index.handler';
    }

    public function package()
    {
        return [
            'sidecar/random'
        ];
    }
}
