<?php
/**
*
* @package phpBB Extension - Acme Demo
* @copyright (c) 2014 phpBB Group
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace ser\nagios\tests\functional;

/**
* @group functional
*/
class nagios_test extends \phpbb_functional_test_case
{
	static protected function setup_extensions()
	{
            return array('ser/nagios');
	}

	public function test_ser_nagios()
	{
		$crawler = self::request('GET', 'app.php/nagios/status');
		$this->assertContains('Board', $crawler->filter('h2')->text());

		$this->add_lang_ext('ser/nagios', 'common');
		//$this->assertContains($this->lang('DEMO_HELLO', 'acme'), $crawler->filter('h2')->text());
		//$this->assertNotContains($this->lang('DEMO_GOODBYE', 'acme'), $crawler->filter('h2')->text());

		//$this->assertNotContainsLang('ACP_DEMO', $crawler->filter('h2')->text());
	}
}
