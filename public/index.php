<?php
use Sewik\Kernel;

require_once dirname(__DIR__).'/vendor/autoload_runtime.php';

return function (array $context) {
    return new Kernel($context['APP_ENV'], (bool) $context['APP_DEBUG']);
};
?>
<!---->
<!--<h1>Prace serwisowe</h1>-->
<!---->
<!--<p>Planowany koniec: 9 marca 2023</p>-->
