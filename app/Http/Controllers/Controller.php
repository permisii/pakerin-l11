<?php

namespace App\Http\Controllers;

abstract class Controller {
    protected $breadcrumbs = [];

    protected function setBreadcrumbs(array $breadcrumbs) {
        $this->breadcrumbs = $breadcrumbs;
    }

    protected function getBreadcrumbs() {
        return $this->breadcrumbs;
    }

    protected function renderView($view, $data = []) {
        return view($view, array_merge($data, ['breadcrumbs' => $this->getBreadcrumbs()]));
    }
}
