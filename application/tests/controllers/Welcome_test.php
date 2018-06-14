<?php
/**
 * Part of ci-phpunit-test
 *
 * @author     Kenji Suzuki <https://github.com/kenjis>
 * @license    MIT License
 * @copyright  2015 Kenji Suzuki
 * @link       https://github.com/kenjis/ci-phpunit-test
 */

class Welcome_test extends TestCase
{
	public function setUp(){
		$this->resetInstance();
	}

	public function test_method_404()
	{
		$this->request('GET', 'welcome/method_not_exist');
		$this->assertResponseCode(404);
	}

	public function test_APPPATH()
	{
		$actual = realpath(APPPATH);
		$expected = realpath(__DIR__ . '/../..');
		$this->assertEquals(
			$expected,
			$actual,
			'Your APPPATH seems to be wrong. Check your $application_folder in tests/Bootstrap.php'
		);
	}

	// UT00
	public function test_login_page()
	{
		$output = $this->request('GET', 'login');
		$this->assertContains('<button type="submit" class="btn btn-primary">Login</button>', $output);
	}

	// UT01
	public function test_login()
	{
		$username = 'projectmanager';
		$password = '12345';
		$name = 'Project Manager';
		$id = 2;

		// login process
		$out = $this->request('POST','login/auth', [
			'username' => $username,
			'password' => $password,
		]);

		$this->assertRedirect('homepage');
	}

	// UT01
	public function test_login_fail_0()
	{
		$out = $this->request('POST','login/auth', [
			'username' => 'projectmanager',
			'password' => '123'
		]);

		$this->assertRedirect('login/auth_false');
	}

	// UT01
	public function test_login_fail_1()
	{
		$out = $this->request('POST','login/auth');

		$this->assertRedirect('login/auth_false');
	}

	// UT02
	// public function test_logout_0()
	// {
	// 	$username = 'projectmanager';
	// 	$password = '12345';
	// 	$name = 'Project Manager';
	// 	$id = 2;

	// 	// login process
	// 	// $this->request('POST','login/auth', [
	// 	// 	'username' => $username,
	// 	// 	'password' => $password,
	// 	// ]);

	// 	$_SESSION['username'] = $username;
	// 	$_SESSION['id_user'] = $id;
	// 	$_SESSION['name'] = $name;
	// 	$this->assertTrue(isset($_SESSION['username']));
	// 	$this->request('GET', 'login/logout');
	// 	$this->assertRedirect('login');
	// 	$this->assertFalse(isset($_SESSION['username']));
	// }
	
	// UT02
	// public function test_logout_1()
	// {
	// 	$this->request('GET', 'login/logout');
	// 	$this->assertRedirect('login');
	// }

	// UT03
	public function test_index_notlogin()
	{
		$out = $this->request('GET', '/');
		$this->assertRedirect('login');
	}

	// UT03
	public function test_index()
	{
		$username = 'projectmanager';
		$password = '12345';
		$name = 'Project Manager';
		$id = 2;

		$out = $this->request('POST','login/auth', [
			'username' => $username,
			'password' => $password,
		]);

		$out = $this->request('GET', '/');
		$expect = '<h3>Selamat Datang, '.$name.'</h3>';
		$this->assertContains($expect, $out);
	}
	
	// UT04
	public function test_form_client_notlogin()
	{
		$out = $this->request('GET', '/estimasi_fp/form_client');
		$this->assertRedirect('login');
	}

	// UT04
	public function test_add_cfp_notlogin()
	{
		$out = $this->request('GET', '/estimasi_fp/add_cfp');
		$this->assertRedirect('login');
	}

	// UT04
	public function test_edit_cfp_notlogin()
	{
		$out = $this->request('GET', '/estimasi_fp/form_edit_cfp');
		$this->assertRedirect('login');
	}
	
	// UT04
	public function test_update_client_notlogin()
	{
		$out = $this->request('GET', '/estimasi_fp/update_client');
		$this->assertRedirect('login');
	}

	// UT04
	public function test_form_client_withid()
	{
		$username = 'projectmanager';
		$password = '12345';
		$name = 'Project Manager';
		$id_aplikasi = 50;

		$out = $this->request('POST','login/auth', [
			'username' => $username,
			'password' => $password,
		]);

		$_SESSION['id_aplikasi'] = $id_aplikasi;

		$out = $this->request('GET', '/estimasi_fp/form_client');
		$this->assertRedirect('/estimasi_fp/form_edit_client/'.$id_aplikasi);
	}
}
