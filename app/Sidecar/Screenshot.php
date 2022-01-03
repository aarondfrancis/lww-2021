<?php
/**
 * @author Aaron Francis <aarondfrancis@gmail.com|https://twitter.com/aarondfrancis>
 */

namespace App\Sidecar;


use Hammerstone\Sidecar\LambdaFunction;
use Hammerstone\Sidecar\Package;
use Hammerstone\Sidecar\Results\SettledResult;

class Screenshot extends LambdaFunction
{

    public function handler()
    {
        return 'index.handler';
    }

    public function package()
    {
        return Package::make()
            ->setBasePath('sidecar/screenshot')
            ->include('*');
    }

    public function toResponse($request, SettledResult $result)
    {
        $body = $result->body();

        $image = base64_decode($body['image']);

        return response($image)->header('Content-type', 'image/' . $body['screenshot']['type']);
    }

    public function memory()
    {
        return 4098;
    }

    public function layers()
    {
        return [
            // Publicly available Chrome built specifically for Lambda.
            // https://github.com/shelfio/chrome-aws-lambda-layer/blob/master/readme.md
            'arn:aws:lambda:us-east-2:764866452798:layer:chrome-aws-lambda:25',
        ];
    }
}
