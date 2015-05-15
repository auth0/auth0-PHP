<?php

namespace Auth0\SDK\API;

class InformationHeaders {

	protected $data = array();

	public function setPackage($name, $version) {
		$this->data['name'] = $name;
		$this->data['version'] = $version;
	}

	public function setEnvironment($name, $version) {
		$this->data['environment'][] = array(
			'name' => $name,
			'version' => $version,
		);
	}

	public function setEnvironmentData($data) {
		$this->data['environment'] = $data;
	}

	public function setDependency($name, $version) {
		$this->data['dependencies'][] = array(
			'name' => $name,
			'version' => $version,
		);
	}

	public function setDependencyData($data) {
		$this->data['dependencies'] = $data;
	}

    public function get() {
    	return $this->data;
    }

    public function build() {
    	return base64_encode(json_encode($this->get()));
    }

    public static function Extend(InformationHeaders $headers) {

    	$newHeaders = new InformationHeaders;

    	$oldData = $headers->get();

    	$newHeaders->setEnvironmentData($oldData['environment']);
    	$newHeaders->setDependency($oldData['name'], $oldData['version']);

    	return $newHeaders;

    }
	
}