<?php
namespace Auth0\SDK\API\Header;

class Header {

    protected $header;
    protected $value;

    public function __construct($header, $value) {
        $this->header = $header;
        $this->value = $value;
    }

    public function getHeader() {
        return $this->header;
    }

    public function getValue() {
        return $this->value;
    }

    public function get() {
        return "{$this->header}: {$this->value}\n";
    }

}