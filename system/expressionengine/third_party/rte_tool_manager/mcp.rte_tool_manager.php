<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * ExpressionEngine - by EllisLab
 *
 * @package    ExpressionEngine
 * @author    ExpressionEngine Dev Team
 * @copyright  Copyright (c) 2003 - 2011, EllisLab, Inc.
 * @license    http://expressionengine.com/user_guide/license.html
 * @link    http://expressionengine.com
 * @since    Version 2.0
 * @filesource
 */
 
// ------------------------------------------------------------------------

/**
 * RTE Tool Manager Module Control Panel File
 *
 * @package    ExpressionEngine
 * @subpackage  Addons
 * @category  Module
 * @author    Jeremy Bueler
 * @link    http://jbueler.com
 */

class Rte_tool_manager_mcp {
  
  public $return_data;
  
  private $_base_url;
  
  /**
   * Constructor
   */
  public function __construct()
  {
    $this->EE =& get_instance();
    
    $this->_base_url = BASE.AMP.'C=addons_modules'.AMP.'M=show_module_cp'.AMP.'module=rte_tool_manager';
    
    $this->EE->cp->set_right_nav(array(
      'module_home'  => $this->_base_url,
      // Add more right nav items here.
    ));
  }
  
  // ----------------------------------------------------------------

  /**
   * Index Function
   *
   * @return   void
   */
  public function index()
  {
    $this->EE->cp->set_variable('cp_page_title', lang('rte_tool_manager_module_name'));
    ee()->load->library('table');
    ee()->load->library('addons');
    
    if (ee()->input->get('action') && ee()->input->get('class')){
      $query = ee()->db->get_where('rte_tools',array('class' => ee()->input->get('class')));
      
      if ($query->num_rows() > 0) {
        $this->_update_tool($query->result()[0],ee()->input->get('action'));
      }
      else{
        $this->_add_tool(ee()->input->get('class'));
      }
      $this->_update_toolset();
    }
    
    $vars = array();
    $vars['available_tools'] = ee()->addons->get_files('rte_tools');
    $vars['installed_tools'] = ee()->addons->get_installed('rte_tools');
    $vars['enable_url'] = $this->_base_url . AMP . 'method=index'.AMP.'action=enable'.AMP.'class=';
    $vars['disable_url'] = $this->_base_url . AMP . 'method=index'.AMP.'action=disable'.AMP.'class=';
    
    return ee()->load->view('index', $vars, TRUE);
  }
  
  private function _add_tool($class_name)
  { 
    $available = ee()->addons->get_files('rte_tools');
    $package = $this->_class_to_package($class_name);
    $tool = $available[$package];
    $data = array(
      "name" => $tool['name'],
      "class" => $tool['class'],
      "enabled" => 'y'
    );    
    ee()->db->insert('rte_tools',$data);
  }
  
  private function _update_tool($tool,$action)
  {
    $enabled = ($action == 'disable')? 'n' : 'y';
    ee()->db->where('tool_id',$tool->tool_id);
    ee()->db->update('rte_tools',array("enabled"=>$enabled));
  }
  
  private function _update_toolset()
  {
    /*
      Collect enabled tools
    */
    ee()->db->select('tool_id');
    ee()->db->where('enabled','y');    
    $query = ee()->db->get('rte_tools');
    $tool_ids = "";
    foreach ($query->result() as $tool) {
      $tool_ids .= $tool->tool_id ."|";
    }
    /*
      Update the toolset
    */
    $data = array("tools" => $tool_ids);
    ee()->db->where('toolset_id',1);
    ee()->db->update('rte_toolsets',$data);
  } 
  
  private function _class_to_package($class_name)
  {
   return str_replace('_rte','',strtolower($class_name));
  } 
}
/* End of file mcp.rte_tool_manager.php */
/* Location: /system/expressionengine/third_party/rte_tool_manager/mcp.rte_tool_manager.php */