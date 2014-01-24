<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Example_rte {
	public $info = array(
		'name'			=> 'Example',
		'version'		=> '1.0',
		'description'	=> 'Example Tool',
		'cp_only'		=> 'n'
	);
	
	private $EE;
	
	/**
	 * Constructor
	 *
	 * @access	public
	 */
	function __construct()
	{
		$this->EE =& get_instance();
	}

	// --------------------------------------------------------------------

	/**
	 * Globals we need
	 *
	 * @access	public
	 */
	function globals()
	{
	}
	
	/** -------------------------------------
	/**  Libraries we need loaded
	/** -------------------------------------*/
	function libraries()
	{
    return array();
	}
	
	// --------------------------------------------------------------------

	/**
	 * Styles we need
	 *
	 * @access	public
	 */
	function styles()
	{
		# load the external file
		$styles	= file_get_contents( 'rte.example.css', TRUE );
		$theme	= ee()->session->userdata('cp_theme');
		$theme	= ee()->config->item('theme_folder_url').'cp_themes/'.($theme ? $theme : 'default').'/';
		return str_replace('{theme_folder_url}', $theme, $styles);
	}

	// --------------------------------------------------------------------

	/**
	 * JS Defintion
	 *
	 * @access	public
	 */
	function definition()
	{
		# load the external file
		return file_get_contents( 'rte.example.js', TRUE );
	}
	
} // END Embed_rte

/* End of file rte.exmple.php */
/* Location: ./system/expressionengine/third_party/example/rte.example.php */