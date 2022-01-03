<?php
/**
 * @author Aaron Francis <aarondfrancis@gmail.com|https://twitter.com/aarondfrancis>
 */

namespace App\Sidecar;


use Hammerstone\Sidecar\LambdaFunction;
use Hammerstone\Sidecar\Package;
use Hammerstone\Sidecar\Results\SettledResult;

class Image extends LambdaFunction
{

    public function handler()
    {
        return 'index.handler';
    }

    public function package()
    {
        return Package::make()
            ->setBasePath('sidecar/image')
            ->include('*');
    }

    public function runtime()
    {
        return 'nodejs12.x';
    }

    public function toResponse($request, SettledResult $result)
    {
        $body = base64_decode($result->body());

        return response($body)->header('Content-type', 'image/jpg');
    }

    public function layers()
    {
        return [
            // Node Canvas from https://github.com/jwerre/node-canvas-lambda
            'arn:aws:lambda:us-east-2:457434779810:layer:node_canvas:1',
            'arn:aws:lambda:us-east-2:457434779810:layer:node_canvas_64:1'
        ];
    }
}
