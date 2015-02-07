<?php
/**
*
* @package phpBB Extension - Nagios health monitoring
* @copyright (c) 2015 Serge Victor <phpbb@random.re>
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace ser\nagios\acp;

class main_module
{
	var $u_action;

	function main($id, $mode)
	{
		global $db, $user, $auth, $template, $cache, $request;
		global $config, $phpbb_root_path, $phpbb_admin_path, $phpEx;

		$user->add_lang('acp/common');
		$this->tpl_name = 'nagios_body';
		$this->page_title = $user->lang('ACP_NAGIOS_TITLE');
		add_form_key('ser/nagios');

		if ($request->is_set_post('submit'))
		{
			if (!check_form_key('ser/nagios'))
			{
				trigger_error('FORM_INVALID');
			}

			$config->set('ser_nagios_goodbye', $request->variable('ser_nagios_goodbye', 0));

			trigger_error($user->lang('ACP_NAGIOS_SETTING_SAVED') . adm_back_link($this->u_action));
		}

		$template->assign_vars(array(
			'U_ACTION'				=> $this->u_action,
			'SER_NAGIOS_GOODBYE'		=> $config['ser_nagios_goodbye'],
		));
	}
}
