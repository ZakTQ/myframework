<?php

namespace Core\Routing;

interface RouterInterface
{
    const NOT_FOUND = 0;
    const FOUND = 1;
    const METHOD_NOT_ALLOWED = 2;

    public function matching();

}
