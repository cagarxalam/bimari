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
        $data = $this->model->ambil();
        foreach ($data as $key) {
            if($key['nama'] == $_POST['user'] && password_verify($_POST['password'],$key['password'])){
                // set session
                $session['user'] = $key['nama'];
                $session['pass'] = $_POST['password'];
                $session['role'] = $key['role'];
                $this->session->set($session);

                $value = "cocok";
            } else {
                $value = "Username dan Password tidak cocok";
            }
        }

        echo json_encode($value);
    }

    public function logout(){
        $this->session->destroy();

        return redirect()->to(base_url("login"));
    }
}
