<?php

namespace Core\Http\Redirect {

    class Redirect implements RedirectInterface
    {
        public function to(string $uri)
        {
            /**
             * header(string $header, bool $replace = true, int $response_code = 0): void
             * 
             * https://www.php.net/manual/ru/function.header.php
             */

            header("Location: {$uri}");
            exit;
        }
    }
}
