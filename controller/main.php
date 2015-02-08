<?php
/**
*
* @package phpBB Extension - Acme Demo
* @copyright (c) 2013 phpBB Group
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace ser\nagios\controller;

class main
{
	/* @var \phpbb\config\config */
        protected $config;

        /** @var \phpbb\db\driver\driver_interface */
        protected $db;

	/* @var \phpbb\controller\helper */
	protected $helper;

	/* @var \phpbb\template\template */
	protected $template;

	/**
	* Constructor
	*
        * @param \phpbb\config\config		    $config     Config object
        * @param \phpbb\db\driver\driver_interface  $db         Database object
        * @param \phpbb\controller\helper	    $helper     Helper object
	* @param \phpbb\template\template	    $template   Template object
	*/
        public function __construct(\phpbb\config\config $config, 
            \phpbb\db\driver\driver_interface $db, 
            \phpbb\controller\helper $helper, 
            \phpbb\template\template $template)
	{
                $this->config = $config;
                $this->db = $db;
                $this->helper = $helper;
                $this->template = $template;
	}

	/**
	* Nagios controller for route /nagios/{name}
	*
	* @param string		$name
	* @return \Symfony\Component\HttpFoundation\Response A Symfony Response object
	*/
	public function handle($name)
	{
		$l_message = !$this->config['ser_nagios_state'] ? 'DEMO_HELLO' : 'DEMO_GOODBYE';
		$this->template->assign_var('NAGIOS_MESSAGE', $this->user->lang($l_message, $name));

		return $this->helper->render('nagios_body.html', $name);
	}
}
