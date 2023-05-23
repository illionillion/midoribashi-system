<?php 
class FooterComponent {
    private $title;

    public function __construct($title) {
        $this->title = $title;
    }

    public function render() {
        $title = $this->title;
        include 'element.php';
    }
}
