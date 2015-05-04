<?php

namespace CommunityPi;

class Core {
	private $config;
	private $view_controller;

	public function __construct() {
		// load config
		$config = new \CommunityPi\Config\ConfigParse();
		$this->config = $config->file;

		// setup view controller
		$this->view_controller = new \CommunityPi\View\Main;
	}

	public function requestRouter($path, $payload) {
		$prefix_length = strlen($this->config['general']['path']);
		$path = substr($path, $prefix_length);


		if ($path == '' || $path == 'home') {
			// get some basic variables
			$variables = array(
				'theme' => $this->theme_variables()
				);

			$this->view_controller->view_home($variables);
		} else {
			$error = new \CommunityPi\Errors\HTTPError(404, "Invalid Route");
		}
	}

	private function theme_variables() {
		return array(
			'path' => '/themes/' . $this->config['general']['theme name'] . '/'
			);

	}
}