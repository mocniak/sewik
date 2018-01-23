<?php
/**
 * Created by PhpStorm.
 * User: mocniak
 * Date: 23.01.18
 * Time: 22:11
 */

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;

class DefaultController
{
    public function test()
    {
        return new Response('test');
    }

    public function index()
    {
        return new Response('index');
    }
}