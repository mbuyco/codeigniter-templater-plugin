<?php

class Templater {

	private $CI, $view_data;

	public function __construct($view_data)
	{
		$this->CI = get_instance();
		$this->view_data = $view_data;
	}

	public function render_view($view_page, $template = NULL, $partials = array())
	{
		$this->CI->load->library('parser');

		$this->view_data['content'] = $this->CI->load->view($view_page, $this->view_data, TRUE);

		foreach($partials as $partial_name)
		{
			$this->render_partial($partial_name);
		}

		$this->CI->parser->parse(($template == NULL) ? 'templates/main' : 'templates/'.$template, $this->view_data);
	}

	public function add_styles($css_filenames, $source_url)
	{
		if(is_string($css_filenames))
			$css_filenames = explode(',', str_replace(' ', '', $css_filenames));

		foreach($css_filenames as $style)
		{
			$this->view_data['styles'] .= '<link rel="stylesheet" href="'. $source_url .'/'. $style .'.css">';;
		}

		return $this;
	}

	public function add_scripts($script_filenames, $source_url)
	{
		if(is_string($script_filenames))
			$script_filenames = explode(',', str_replace(' ', '', $script_filenames));

		foreach($script_filenames as $script)
		{
			$this->view_data['scripts'] .= '<script src="'. $source_url .'/'. $script .'.js"></script>';
		}

		return $this;
	}

	private function render_partial($partial_name, $source_url = 'partials')
	{
		$this->view_data[$partial_name] = $this->load->view($source_url .'/_'. $partial_name,  $this->view_data, TRUE);
	}
}