<?php
/**
*
* @package phpBB Extension - Acme Demo
* @copyright (c) 2013 phpBB Group
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace ser\nagios\migrations;

class release_1_0_0 extends \phpbb\db\migration\migration
{
	public function effectively_installed()
	{
                return isset($this->config['ser_nagios_state']);
	}

	static public function depends_on()
	{
		return array('\phpbb\db\migration\data\v31x\v313');
	}

	public function update_data()
	{
		return array(
			array('config.add', array('ser_nagios_state', 0)),

			array('module.add', array(
				'acp',
				'ACP_CAT_DOT_MODS',
				'ACP_NAGIOS_TITLE'
			)),
			array('module.add', array(
				'acp',
				'ACP_NAGIOS_TITLE',
				array(
					'module_basename'	=> '\ser\nagios\acp\main_module',
					'modes'				=> array('settings'),
				),
			)),
		);
	}
}
