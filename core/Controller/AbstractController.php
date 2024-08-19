<?php

namespace Core\Controller;

use Core\View\ViewInterface;

abstract class AbstractController
{
    private ViewInterface $view;

    public function setView(ViewInterface $view): void
    {
        $this->view = $view;
    }

    public function view(): ViewInterface
    {
        return $this->view;
    }

    
}
