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

class WelcomeController extends Controller {

    public function __construct() {
        parent::__construct();
    }

    public function hello() {
        $query = DB::table('users')->all();
        $data['name'] = $query;
        $arr = [
            'album_name' => 'new album',
            'album_title' => 'PDO',
            'album_description' => 'Class'.__CLASS__.' have '.__NAMESPACE__.' Test my framework using Php Data Object',
            'user_id' => 1
        ];
        //Redirect::to('goole');
        //\DB::table('albums')->insert($arr);
        return view('welcome', $data);
    }

}
