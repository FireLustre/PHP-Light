<?php
namespace Home\Controller;
use Core\Controller;

class IndexController extends Controller{

    public function index() {
        $this->with('demo', 'Light1.0')->view();
    }
}