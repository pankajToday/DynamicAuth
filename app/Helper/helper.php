<?php

use App\Model\User;

function checkDatabase($dbName )
{
    $query = "SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME =  ?";
    $db = \DB::select($query, [$dbName]);
    if(empty($db))
    {return 0 ;}
    else
    {return 1;}
}

 function dynamicDatabaseConfig($dbName)
{
    $dbConfig=[];
    if( env('APP_ENV') == 'local')
    {
        $dbConfig=[
            "dbHost"=>"localhost",
            "dbName"=>$dbName,
            "dbUser"=>"root",
            "dbPassword"=>"",
        ];
    }

    if(  checkDatabase(  $dbConfig['dbName'] ) )
    {
        \DB::disconnect('mysql');
        \DB::disconnect('myDBConfig');

        \DB::setDefaultConnection('myDBConfig');
        \Config::set('database.connections.myDBConfig', array(
            'driver'    => 'mysql',
            'host'      => $dbConfig['dbHost'],
            'database'  => $dbConfig['dbName'],
            'username'  => $dbConfig['dbUser'],
            'password'  => $dbConfig['dbPassword'],
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
            'strict' => false,
            'engine'=>"InnoDB"
        ));

        \Config::set('database.connections.myDBConfig.database', $dbConfig['dbName']);
        DB::purge('myDBConfig');
        \DB::reconnect('myDBConfig');
        session()->put('myDatabase',\DB::connection()->getDatabaseName());
        return \DB::connection()->getDatabaseName();
    }
    else
    {
        return "No Database found.";
    }


}

 function dynamicAuthLogin( $databaseName, $login_id, $password )
 {
     if( $databaseName ==  dynamicDatabaseConfig($databaseName))
     {
         $user=  User::where("login_id",$login_id)->first();

         if( $user )
         {
             if(\Hash::check($password,$user->password ))
             {
                 \Auth::login($user);
                  $token =  hash('sha1', $user->id.'-'.$password);
                   $user->update(["login_token"=>$token]);
                 return ["status"=>"success","message"=>"Login success","token"=>$token];
             }
             return ["status"=>"failed","message"=>"Password not matched","token"=>""];
         }
         return ["status"=>"failed","message"=>"Login-Id not matched","token"=>""];
     }
     return ["status"=>"failed","message"=>"Client App is disabled.","token"=>""];

 }


 function enc($string) {
    $output = false;
    $encrypt_method = "AES-256-CBC";
    $secret_key = env('ENC_SEC_KEY');
    $secret_iv = env('ENC_SECRET_IV');;
    $key = hash('sha256', $secret_key);
    $iv = substr(hash('sha256', $secret_iv), 0, 16);
    $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
    return base64_encode($output);
}

 function dnc($string) {
    $output = false;
    $encrypt_method = "AES-256-CBC";
    $secret_key = env('ENC_SEC_KEY');
    $secret_iv = env('ENC_SECRET_IV');
    $key = hash('sha256', $secret_key);
    $iv = substr(hash('sha256', $secret_iv), 0, 16);
    return openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
}

