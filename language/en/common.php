<?php
/**
*
* @package phpBB Extension - Acme Demo
* @copyright (c) 2013 phpBB Group
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

if (!defined('IN_PHPBB'))
{
	exit;
}

if (empty($lang) || !is_array($lang))
{
	$lang = array();
}

$lang = array_merge($lang, array(
	'NAGIOS_ACTIVE_USERS_TEXT'      => 'Active users:',
	'NAGIOS_FORUM_VERSION'		=> 'Forum Ver',
        'ACP_NAGIOS_TITLE'		=> 'Nagios Module',
        'ACP_NAGIOS'			=> 'Settings',
        'ACP_NAGIOS_ENABLE'		=> 'Do you want to activate Nagios health monitoring?',
        'ACP_NAGIOS_STATUS'		=> 'Should Nagios health monitoring be active?',
	'ACP_NAGIOS_SETTING_SAVED'	=> 'Settings have been saved successfully!',
));
