<?php
/**
*
* @package phpBB Extension - Nagios health monitoring
* @copyright (c) 2015 Serge Victor <phpbb@random.re>
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace ser\nagios\acp;

class main_info
{
	function module()
	{
		return array(
			'filename'	=> '\ser\nagios\acp\main_module',
			'title'		=> 'ACP_NAGIOS_TITLE',
			'version'	=> '0.0.1',
			'modes'		=> array(
				'settings'	=> array('title' => 'ACP_NAGIOS', 'auth' => 'ser/nagios && acl_a_board', 'cat' => array('ACP_NAGIOS_TITLE')),
			),
		);
	}
}
