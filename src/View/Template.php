<?php

require_once 'vendor/autoload.php';

class Template {
    private $mustache;

    public function __construct() {
        $this->mustache = new Mustache_Engine([
            'loader' => new Mustache_Loader_FilesystemLoader(dirname(__FILE__) . '/templates'),
        ]);
    }

    public function render($template, $data = []) {
        echo $this->mustache->render($template, $data);
    }
}
?>