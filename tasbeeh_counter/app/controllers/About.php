<?php
    class About extends Controller{
        private $aboutModel;

        public function __construct(){
            $this->aboutModel = $this->model("AboutModel");
        }

        // call home view
        public function index(){
            $data = ['view' => 'About'];
            $this->view("about/index", $data);
        }
    }
?>