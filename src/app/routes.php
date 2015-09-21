<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/


Route::group(array('before' => 'auth'), function () {
	//ниже идут запросы, требующие авторизованности пользователя

	Route::get('/', function()
	{
		return View::make("base")
		->with("currentMenu","main")
		->nest("conetent","intro.index",[])
		;
	});

	Route::get("/main",function()
	{
		return View::make("base")
		->with("currentMenu","main")
		->nest("conetent","intro.main",[])
		;
	});

	Route::get("/admin",function()
	{

		$admin = Admin::first();
		$admin_users = AdminUser::all();
		$admin_access_subnet = AdminAccessSubnet::all();
		$admin_ntp_servers = AdminNtpServer::all();

		// dd($admin);

		return View::make("base")
		->with("currentMenu","admin")
		->nest("conetent","intro.admin",[
				"admin" => $admin,
				"admin_users" => $admin_users,
				"admin_access_subnet" => $admin_access_subnet,
				"admin_ntp_servers" => $admin_ntp_servers,
				"user_id_start" => 1
			])
		;
	});

	Route::post("/admin/save",function()
	{
		$admin = Admin::first();

		// dd(Input::get("datetime_offset"),$admin);

		$admin->hostname = Input::get("hostname");
		$admin->location = Input::get("location");
		$admin->contacts = Input::get("contacts");
		$admin->access_read = Input::get("access_read");
		$admin->access_write = Input::get("access_write");
		$admin->access_filter = Input::get("access_filter");
		// $admin->timezone = Input::get("timezone");
		// $admin->datetime_offset	 = Input::get("datetime_offset");
		// $admin->time = Input::get("time");
		$admin->save();

		return "ok";

	});


	Route::post("/admin/save/time",function()
	{
		$admin = Admin::first();

		// dd(Input::get("api_date_time"));//ok

		@exec(Config::get('app.cmdpath').' time-set='.Input::get("api_date_time") );
		
		$admin->timezone = Input::get("timezone");
		$admin->datetime_offset	 = Input::get("datetime_offset");
		$admin->save();
		return "ok";
	});

	Route::post("/admin/save/users",function()
	{
		$users = Input::get("users");

		$login_user = Auth::user()->username;
		$login_user_password = Auth::user()->password;

		// dd($users);

		$db_users = DB::table('admin_users')->get();

		DB::table('admin_users')->truncate();

		$i = 1;
		foreach($users as $user)
		{
			$password ="";
			if( $user['password'] =="" || $user['password'] =="undefined")
			{
				if($user['hash_password'] =="" || $user['hash_password'] =="undefined")
				{
					echo "no hash pass ";
					// dd($db_users);
					foreach($db_users as $du)
					{
						if($du->username == $user['username'])
						{
							$password1 = $du->password;
							// dd($user['username']. " ".$password1);
							if(isset($password1))
							{
								echo "get pass from db ".$password1;
								$password = $password1;
							}
							else continue;
						}
					}
				}
				else $password = $user['hash_password'];
			}
			else
			{
				$password = Hash::make( $user['password'] );
				$login_user_password = $password;
			}

			$insertUser = 
			[
				"id" => $i,
				"username" => trim($user['username']),
				"password" => $password,
				"access_level" => $user['access_level']
			];

			DB::table("admin_users")->insert($insertUser);
			$i++;
		}

		Auth::attempt(['username'=>$login_user,'password'=>$login_user_password]);

		return "ok";




		/////////////////////////////////


		$user_send_to_db = [];


		foreach($users as $user)
		{
			if($user['password'] !="")
			{
				$user_send_to_db[$user['id']] = 
				[
					"id" => $user['id'],
					"username" => $user['username'],
					"password" => Hash::make($user['password']),
					"access_level" => $user['access_level']
				];
			}
		}

		foreach($db_users as $db_user)
		{			
			$user_send_to_db[$db_user->id] = 
			[
				"id" => $user['id'],
				"username" => $db_user->username,
				"password" => $db_user->password,
				"access_level" => $db_user->access_level
			];
		}


		DB::table('admin_users')->truncate();

		$user_send_to_db2 = [];
		$i = 1;
		foreach($user_send_to_db as $user)
		{
			$user_send_to_db2 = 
			[
				"id" => $i,
				"username" => $user['username'],
				"password" => $user['password'],
				"access_level" => $user['access_level']
			];

			DB::table("admin_users")->insert($user_send_to_db2);
			$i++;
		}
		// dd($user_send_to_db2);

		return "ok";
		/////////////////////////////////////////


		$update_user = 
		[
			"id" => $user['id'],
			"username" => $user['username'],
			"password" => Hash::make($user['password']),
			"access_level" => $user['access_level']
		];

		$is_update = DB::table("admin_users")
			->where('id', $user['id'])
			->update($update_user);

		if(is_null($is_update))
		{
			DB::table("admin_users")->insert($update_user);
		}
		





		/////////////////////////////
		$insert_users_arr = [];
		$users_db_count = DB::table('admin_users')->count();

		//если добавлены новые пользователи
		if($users_db_count < count($users))
		{

			$db_users = DB::table('admin_users')->get();
			foreach($users as $user)
			{
				$is_add = true;

				foreach($db_users as $db_user)
				{
					if($db_user->id == $user['id'] )
					{
						$is_add = false;
						continue;
					}
				}
				if($is_add)
				{
					if( $user['username'] =="")continue;
					$insert_user = 
					[
						"id" => $user['id'],
						"username" => $user['username'],
						"password" => Hash::make($user['password']),
						"access_level" => $user['access_level']
					];
					DB::table("admin_users")->insert($insert_user);
				}
			}
		}
		//если удалены пользователи
		else if($users_db_count > count($users))
		{
			$db_users = DB::table('admin_users')->get();
			foreach($db_users as $db_user)
			{
				$is_delete = true;

				foreach($users as $user)
				{
					if($db_user->id == $user['id'] )
					{
						$is_delete = false;
					}
				}
				if($is_delete)
				{
					DB::table('admin_users')->where("id", '=', $db_user->id)->delete();
				}
			}
		}
		//если количество пользователей не изменилось
		else
		{
			foreach($users as $user)
			{

				// if($user['password'] =="" || is_null($user['password']) ) continue;

				if($user['password'] =="" || is_null($user['password']) )
				{
					$update_user = 
					[
						"id" => $user['id'],
						"username" => $user['username'],
						// "password" => Hash::make($user['password']),
						"access_level" => $user['access_level']
					];

					$is_update = DB::table("admin_users")
						->where('id', $user['id'])
						->update($update_user);

					if(is_null($is_update))
					{
						DB::table("admin_users")->insert($update_user);
					}				
				}
				else
				{
					$update_user = 
					[
						"id" => $user['id'],
						"username" => $user['username'],
						"password" => Hash::make($user['password']),
						"access_level" => $user['access_level']
					];

					$is_update = DB::table("admin_users")
						->where('id', $user['id'])
						->update($update_user);

					if(is_null($is_update))
					{
						DB::table("admin_users")->insert($update_user);
					}
				}


	/*			$insert_users_arr[] = 
				[
					"id" => $user['id'],
					"username" => $user['username'],
					"password" => Hash::make($user['password']),
					"access_level" => $user['access_level']
				];*/

				$update_user = 
				[
					"id" => $user['id'],
					"username" => $user['username'],
					"password" => Hash::make($user['password']),
					"access_level" => $user['access_level']
				];

				$is_update = DB::table("admin_users")
					->where('id', $user['id'])
					->update($update_user);

				if(is_null($is_update))
				{
					DB::table("admin_users")->insert($update_user);
				}

			}
		}

		// DB::table("admin_users")->insert($insert_users_arr);
		// DB::table("admin_users")->update($insert_users_arr);

		return "ok";

	});

	Route::post("/admin/save/subnets",function()
	{
		DB::table('admin_access_subnet')->truncate();
		
		$subnets = Input::get("subnets");

		$insert_subnet_arr = [];


		foreach($subnets as $subnet)
		{
			$insert_subnet_arr[] = 
			[
				"id" => $subnet['id'],
				"subnet" => $subnet['subnet']
			];
		}

		DB::table("admin_access_subnet")->insert($insert_subnet_arr);

		return "ok";

	});

	Route::post("/admin/save/ntps",function()
	{

		DB::table('admin_ntp_servers')->truncate();
		
		$ntps = Input::get("ntps");

		$insert_ntp_arr = [];


		foreach($ntps as $ntp)
		{
			$insert_ntp_arr[] = 
			[
				"id" => $ntp['id'],
				"ntp_server" => $ntp['ntp']
			];
		}

		DB::table("admin_ntp_servers")->insert($insert_ntp_arr);

		return "ok";

	});



	Route::get("/network",function()
	{
		$ip = exec(Config::get('app.cmdpath').' get-devipaddr') | "error_no_data_ip";
		$mask = exec(Config::get('app.cmdpath').' get-netmask') | "error_no_data_mask";
		$gateway = exec(Config::get('app.cmdpath').' get-gateway') | "error_no_data_gateway";
		$mac = exec(Config::get('app.cmdpath').' get-mac') | "error_no_data_mac";
		$httpport = exec(Config::get('app.cmdpath').' get-httpport') | "error_no_data_httpport";
		$snmp_agent_port = "error_no_data_snmp_arent_port";//exec(Config::get('app.cmdpath').' get-devipaddr') | "error_no_data";
		$dns1 = exec(Config::get('app.cmdpath').' get-dns') | "error_no_data_dns1";
		// $ip = exec(Config::get('app.cmdpath').' get-devipaddr') | "error_no_data";
		// $ip = exec(Config::get('app.cmdpath').' get-devipaddr') | "error_no_data";
		// $ip = exec(Config::get('app.cmdpath').' get-devipaddr') | "error_no_data";

		// Config::get('app.cmdpath');

		return View::make("base")
		->with("currentMenu","network")
		->nest("conetent","intro.networks_settings",[
			"ip"=>$ip,
			"mask"=>$mask,
			"gateway"=>$gateway,
			"mac"=>$mac,
			"httpport"=>$httpport,
			"snmp_agent_port"=>$snmp_agent_port,
			"dns1"=>$dns1
			])
		;
	});

	Route::post("/network/save",function()
	{

  		$ip = Input::get("ip-address");
  		$mask = Input::get("mask");
  		$gateway = Input::get("gateway");
  		$mac = Input::get("mac-address");
  		$httpport = Input::get("http-port");
  		$dns1 = Input::get("dns-server-1");

  		//сохраняем настройки в системе
  		@exec(Config::get('app.cmdpath').' set devipaddr='.$ip);
  		@exec(Config::get('app.cmdpath').' set netmask='.$mask);
  		@exec(Config::get('app.cmdpath').' set gateway='.$gateway);
  		@exec(Config::get('app.cmdpath').' set macaddr='.$mac);
  		@exec(Config::get('app.cmdpath').' set httpport='.$httpport);
  		@exec(Config::get('app.cmdpath').' set macaddr='.$mac);
  		@exec(Config::get('app.cmdpath').' set dns='.$dns1);

  		return Redirect::back();
	});



	Route::get("/notifications/config",function()
	{
		return View::make("base")
		->with("currentMenu","notifications/config")
		->nest("conetent","intro.notifications_config",[])
		;
	});

	Route::get("/firmware",function()
	{
		return View::make("base")
		->with("currentMenu","firmware")
		->nest("conetent","intro.firmware")
		;
	});

	Route::get("/log",function()
	{
		return View::make("base")
		->with("currentMenu","log")
		->nest("conetent","intro.log",[])
		;
	});

	Route::get("/sockets",function()
	{
		return View::make("base")
		->with("currentMenu","sockets")
		->nest("conetent","intro.sockets",[])
		;
	});

	Route::get("/sensors",function()
	{
		return View::make("base")
		->with("currentMenu","sensors")
		->nest("conetent","intro.sensors",[])
		;
	});

	Route::get("/notifications",function()
	{
		return View::make("base")
		->with("currentMenu","notifications")
		->nest("conetent","intro.notifications",[])
		;
	});

	Route::get("/reports",function()
	{
		return View::make("base")
		->with("currentMenu","reports")
		->nest("conetent","intro.reports",[])
		;
	});

	Route::get("/logic",function()
	{
		return View::make("base")
		->with("currentMenu","logic")
		->nest("conetent","intro.logic",[])
		;
	});
});//конец запросов, требующих авторизованности



//сбрасываем все настройки в значение "по умолчанию"
Route::get("/set/default/settings",function()
{
	//ADMIN

	//clear
	DB::table('admin')->truncate();
	DB::table('admin_users')->truncate();
	DB::table('admin_access_subnet')->truncate();
	DB::table('admin_ntp_servers')->truncate();
	

	//set defaults
	$admin = new Admin();
	$admin->hostname = "hostname";
	$admin->location = "location";
	$admin->contacts = "contacts";
	$admin->access_read = "access_read";
	$admin->access_write = "access_write";
	$admin->access_filter = "access_filter";
	$admin->timezone = "3.0";
	$admin->datetime_offset = 0;
	$admin->save();

	$admin_users = new AdminUser();
	$admin_users->id = 0;
	$admin_users->username = "admin";
	$admin_users->password = Hash::make("admin");
	$admin_users->access_level = "admin";
	$admin_users->remember_token = Hash::make(time());
	$admin_users->save();

	$admin_access_subnet = new AdminAccessSubnet();
	$admin_access_subnet->subnet = "192.168.0.1";
	$admin_access_subnet->save();

	$admin_ntp_servers = new AdminNtpServer();
	$admin_ntp_servers->ntp_server = "192.168.0.1";
	$admin_ntp_servers->save();

	//

	return "settings was set default.";
});

Route::get("/login",function()
{
	return View::make("intro.login");
	;
});

Route::post("/login",function()
{
	$username = Input::get("username");
	$password = Input::get("password");

	// dd(AdminUser::all());

	if(Auth::attempt(["username"=>$username,"password"=>$password]))
	{
		return Response::json(
			[
				"status" =>"ok",
				"info"=>""
			]);
	}
	else
	{
		return Response::json(
			[
				"status" =>"error",
				"info"=> Lang::get('login.login_error')
			]);
	}
});

Route::get("/logout",function()
{
	Auth::logout();
	return Redirect::back();//to("/");
});