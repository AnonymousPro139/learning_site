<?php
class View
{
    protected $data;
    protected $file;

    public function __construct($data, $file)
    {
        $this->data = $data;
        $this->file = VIEWS_PATH . $file;
    }

    public function render()
    {
        ob_start();
        $data = $this->data;

        require $this->file;

        $content = ob_get_clean();

        $data['site_html_content'] = $content;

        $route = App::getRouter()->getRoute();

        require ROOT . DS . 'views' . DS . $route . '.html'; // default.html or admin.html
    }
}
