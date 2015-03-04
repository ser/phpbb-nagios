<?php
/**
*
* @package phpBB Extension - Acme Demo
* @copyright (c) 2014 phpBB Group
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace ser\nagios\tests\controller;

class main_test extends \phpbb_test_case
{
	public function handle_data()
	{
		return array(
			array(200, 'nagios_body.html'),
		);
	}

	/**
	 * @dataProvider handle_data
	 */
	public function test_handle($status_code, $page_content)
	{
		$controller = new \ser\nagios\controller\main(
			new \phpbb\config\config(array()),
			new \ser\nagios\tests\mock\controller_helper(),
			new \ser\nagios\tests\mock\template(),
			new \ser\nagios\tests\mock\user()
		);

		$response = $controller->handle('test');
		$this->assertInstanceOf('\Symfony\Component\HttpFoundation\Response', $response);
		$this->assertEquals($status_code, $response->getStatusCode());
		$this->assertEquals($page_content, $response->getContent());
	}
}
