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

        /** @var \phpbb\user */
        protected $user;

	/**
	* Constructor
	*
        * @param \phpbb\config\config		    $config     Config object
        * @param \phpbb\db\driver\driver_interface  $db         Database object
        * @param \phpbb\controller\helper	    $helper     Helper object
	* @param \phpbb\template\template	    $template   Template object
        * @param \phpbb\user                        $user       User object
        * @return \phpbb\pages\controller\main_controller
        * @access public
	*/
        public function __construct(
            \phpbb\config\config $config, 
            \phpbb\db\driver\driver_interface $db, 
            \phpbb\controller\helper $helper, 
            \phpbb\template\template $template,
            \phpbb\user $user
            )
	{
                $this->config = $config;
                $this->db = $db;
                $this->helper = $helper;
                $this->template = $template;
                $this->user = $user;
	}

        /**
         * Count users
         *
         * @return number
         *
         */
        protected function get_number_of_active_users()
        {
            // SQL query 
            $sql = 'SELECT COUNT(*) FROM '
                . USERS_TABLE . 
                ' WHERE user_type=0';
            $this->db->sql_query($sql);
        }

	/**
	* Nagios controller for route /nagios/{name}
	*
        * @param string		$name       in config/routing.yml we set the
        *                                   only option is $name = status whatever user sets
	* @return \Symfony\Component\HttpFoundation\Response A Symfony Response object
	*/
	public function handle($name)
        {
	//$l_message = !$this->config['ser_nagios_state'] ? 'NAGIOS_OFF' : 'NAGIOS_ON';
        //$this->template->assign_var('NAGIOS_ACTIVE_USERS_TEXT', $this->user->lang($l_message, $name));
        //

            $user->add_lang_ext('ser/nagios', 'common');
            regusers = get_number_of_active_users();

            return $this->helper->render('nagios_body.html', $name);
	}

