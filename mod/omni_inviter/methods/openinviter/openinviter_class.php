<?php
/**
 * Omni Inviter -- Offers multiple, extendable ways of inviting new users
 * 
 * @package Omni Inviter
 * @subpackage openinviter
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
 * @author Brett Profitt <brett.profitt@gmail.com>
 * @copyright Brett Profitt 2009  
 */

require_once dirname(__FILE__) . '/vendor/OpenInviter/openinviter.php';

// create our own class that extends OpenInviter so we specify 
// the config and the plugins dirs
class oiOpenInviter extends OpenInviter {
	// use stored config.
	// @todo use args to set these...???
	
	// these don't come in when you extend...?
	public $pluginTypes=array('email'=>'Email Providers','social'=>'Social Networks');
	private $ignoredFiles=array('default.php'=>'','index.php'=>'');
	private $version='1.6.7';
	
	public function __construct($config_overrides=array()) {
		global $CONFIG;
		$openinviter_settings=array(
			'username'=> get_plugin_setting('openinviter_username', 'omni_inviter'),
			'private_key'=>get_plugin_setting('key', 'omni_inviter'),
			'cookie_path'=>$CONFIG->dataroot . 'openinviter',
			'message_body'=> get_plugin_setting('message_body', 'omni_inviter'),
			'message_subject'=>get_plugin_setting('message_subject', 'omni_inviter'),
			'transport'=> get_plugin_setting('openinviter_transport', 'omni_inviter'),
			'local_debug'=> get_plugin_setting('openinviter_local_debug', 'omni_inviter'),
			'remote_debug'=>get_plugin_setting('openinviter_remote_debug', 'omni_inviter')
		);
		
		// passed config overrides...
		if (is_array($config_overrides)) {
			foreach($config_overrides as $var => $val) {
				$openinviter_settings[$var] = $val;
			}
		}
		
		$this->openinviter_root = dirname(__FILE__) . '/vendor/OpenInviter';
		
		include_once($this->openinviter_root . "/openinviter_base.php");
		$this->settings=$openinviter_settings;
	}
	
	/**
	 * Start internal plugin
	 * 
	 * Starts the internal plugin and
	 * transfers the settings to it.
	 * 
	 * @param string $plugin_name The name of the plugin being started
	 */
	public function startPlugin($plugin_name) {
		if (file_exists($this->openinviter_root . "/postinstall.php")) {
			$this->internalError="You have to delete postinstall.php before using OpenInviter";
		} elseif (file_exists($this->openinviter_root . "/plugins/{$plugin_name}.php")) {
			$ok=true;
			if (!class_exists($plugin_name)) include_once($this->openinviter_root . "/plugins/{$plugin_name}.php");
			$this->plugin=new $plugin_name();
    		$this->plugin->settings=$this->settings;
    		$this->plugin->base_version=$this->version;
    		$this->plugin->base_path=$this->openinviter_root;
		} else {
			$this->internalError="Invalid service provider";
		}
	}
	
	//@todo omg fix this crap style.
	public function getPlugins() {
		// catch any output from plugins...
		ob_start();
		$plugins=array();$array_file=array();
		$dir=$this->openinviter_root . "/plugins";
		
		if (is_dir($dir)) 
		    if ($op=opendir($dir))
		    	{ 
		        while (false!==($file=readdir($op))) 
		        	if (($file!=".") AND ($file!="..") AND (strpos($file,'.php')!==false) AND (!isset($this->ignoredFiles[$file]))) $array_file[$file]=$file;
		        closedir($op);
		    	}
		if (count($array_file)>0) 
			{
			sort($array_file);
			foreach($array_file as $key=>$val)
				{
		    	$plugin_key=str_replace('.php','',$val);
		        include("{$dir}/{$val}");
		        if ($this->checkVersion($_pluginInfo['base_version']))
		       		$plugins[$_pluginInfo['type']][$plugin_key]=$_pluginInfo;
				}
			}
			
		// ...and silently discard it.
		ob_end_clean();
		
		if (count($plugins)>0) return $plugins;
		else return false;
	}
	
}
