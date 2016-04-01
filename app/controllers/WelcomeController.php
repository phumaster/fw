<?php

/*
  | Project: fw
  | Description: my framework
  | Author: Pham Ngoc Phu
  | Alias: Phu Master
  | Email: phumaster.dev@gmail.com
 */

namespace App\controllers;

use PM\Controller;
use PM\DB;
use PM\Redirect;
use PM\Session;

use App\models\User;

class WelcomeController extends Controller {

    public function __construct() {
        parent::__construct();
    }

    public function hello() {
        $model = new User();
        echo $model;
        $arr = [
            'album_name' => 'hahahahahah',
            'album_title' => 'PDO',
            'album_description' => 'Class'.__CLASS__.' have '.__NAMESPACE__.' Test my framework using Php Data Object',
            'user_id' => 1
        ];
        $data['name'] = DB::table('users')->all();
        //Redirect::to('goole');
        //\DB::table('albums')->insert($arr);
        //Session::put(['test' => 'This is session test', 'test2' => 'test2']);
        //Session::delete('test');
        //Session::destroy();
        //Session::flash(['test' => 'flash data test session']);
        //return redirect()->to('phumaster');
        return view('welcome', $data);
    }

}
