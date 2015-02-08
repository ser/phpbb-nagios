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

        /* @var \phpbb\db\driver\driver_interface */
        protected $db;

	/* @var \phpbb\controller\helper */
	protected $helper;

	/* @var \phpbb\template\template */
        protected $template;

        /* @var \phpbb\user */
        protected $user;

        protected $phpbb_container;

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
            \Symfony\Component\DependencyInjection\ContainerInterface $phpbb_container,
            \phpbb\user $user
            )
	{
                $this->config = $config;
                $this->db = $db;
                $this->helper = $helper;
                $this->template = $template;
                $this->user = $user;
                $this->phpbb_container = $phpbb_container;
	}

        /**
         * Count users
         *
         * @return number of active users
         *
         */
        protected function get_number_of_active_users()
        {
            // SQL query tp get all active users 
            $sql = 'SELECT COUNT(*) AS howmany FROM ' . USERS_TABLE . ' WHERE user_type=0';
            $result = $this->db->sql_query($sql);
            $user_count = $this->db->sql_fetchrow($result);
            $this->db->sql_freeresult($result);

            return $user_count['howmany'];
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

            //$phpbb_container = new \phpbb_mock_container_builder();
            //$this->phpbb_container = $phpbb_container;

            // Checking the phpBB version
            $version_helper = $this->phpbb_container->get('version_helper');

            // Get translation
            $this->user->add_lang_ext('ser/nagios', 'common');

            // Nagios status
            $this->template->assign_var('NAGIOS_STATUS', "ON");

            // Count users
            $regusers = $this->get_number_of_active_users();
            $this->template->assign_var('NAGIOS_ACTIVE_USERS', $regusers);

            // And finally display the status page
            return $this->helper->render('nagios_body.html');
	}
}

