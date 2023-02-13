<?php
abstract class Controller
{
    protected $model;
    protected $data;
    protected $params;

    public function __construct($data = [])
    {
        $this->data = $data;
        $this->params = App::getRouter()->getParams();
    }

    public function getModel()
    {
        return $this->model;
    }

    public function getData()
    {
        return $this->data;
    }

    public function getParams()
    {
        return $this->params;
    }
}