<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\MUser;

class Auth extends BaseController
{
    protected $model;

    public function __construct(){
        $this->model = new MUser();
    }

    public function index(){
        return view('auth/login');
    }

    public function sessions(){
        $user = $_POST['user'];
        $pass = $_POST['password'];
        $data = $this->model->ambil();

        // set session
        $session['user'] = null;
        $session['pass'] = null;
        $session['role'] = null;

        // default value
        $value = "Username dan Password tidak cocok";

        foreach($data as $row){
            if($row['nama'] == $user && password_verify($pass,$row['password'])){
                $session['user'] = $user;
                $session['pass'] = $pass;
                $session['role'] = $row['role'];
                $value = "cocok";
            }
        }

        $this->session->set($session);
        echo json_encode($value);
    }

    public function logout(){
        $this->session->destroy();

        return redirect()->to(base_url("login"));
    }
}
