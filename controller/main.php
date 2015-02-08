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

        /* @var \Symfony\Component\DependencyInjection\ContainerInterface */
        protected $phpbb_container;

	/**
	* Constructor
	*
        * @param \phpbb\config\config		    $config     Config object
        * @param \phpbb\db\driver\driver_interface  $db         Database object
        * @param \phpbb\controller\helper	    $helper     Helper object
	* @param \phpbb\template\template	    $template   Template object
        * @param \phpbb\user                        $user       User object
        * @param \Symfony\Component\DependencyInjection\ContainerInterface $phpbb_container phpBB full container
        * @return \phpbb\pages\controller\main_controller
        * @access public
	*/
        public function __construct(
            \phpbb\config\config $config, 
            \phpbb\db\driver\driver_interface $db, 
            \phpbb\controller\helper $helper, 
            \phpbb\template\template $template,
            \phpbb\user $user,
            \Symfony\Component\DependencyInjection\ContainerInterface $phpbb_container
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
         * Checking if we have a fresh instance of phpBB
         *
         * @return current and expected version
         * 
         */
        protected function phpbb_freshness()
        {
            // we have ready function for it in phpBB core
            /* @var $version_helper \phpbb\version_helper */
            $version_helper = $this->phpbb_container->get('version_helper');

            // We enforce real check, not relying on ACP user settings, as we
            //      really want to have fresh information
            $force_update = true;
            $force_cache = false;

            try
            {
                $updates_available = $version_helper->get_suggested_updates($force_update, $force_cache);
                print_r(array_values($updates_available));

                $this->template->assign_vars(array(
                    'S_UP_TO_DATE'      => empty($updates_available),
                    'UP_TO_DATE_MSG'    => $this->user->lang(empty($updates_available) ? 'UP_TO_DATE' : 'NOT_UP_TO_DATE'),
                ));

                foreach ($updates_available as $branch => $version_data)
                {
                    $this->template->assign_block_vars('updates_available', $version_data);
                }
            }
            catch (\RuntimeException $e)
            {
                $this->template->assign_vars(array(
                    'S_VERSIONCHECK_STATUS'      => $e->getCode(),
                    'VERSIONCHECK_FAIL_REASON'  => ($e->getMessage() !== $user->lang('VERSIONCHECK_FAIL')) ? $e->getMessage() : '',
                ));
            }

            return $updates_available;
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


            // Get translation
            $this->user->add_lang_ext('ser/nagios', 'common');

            // Nagios status
            $this->template->assign_var('NAGIOS_STATUS', "ON");

            // Checking if we have a fresh instance of phpBB
            $updates_available = $this->phpbb_freshness();

            // Count users
            $regusers = $this->get_number_of_active_users();
            $this->template->assign_var('NAGIOS_ACTIVE_USERS', $regusers);

            // And finally display the status page
            return $this->helper->render('nagios_body.html');
	}
}

