<?php

namespace App\Controllers;
use App\Controllers\BaseController;

use App\Models\user as userModel;

class User extends BaseController
{
    public function _remap($method, ...$params)
    {
        if(!session()->has('id_user')){
            session()->setFlashdata("message", "Silahkan login terlebih dahulu !");
			return redirect()->to('/Login');
		}else{
            if(session()->get('role') == 1){
                return $this->$method(...$params);
            }else{
                session()->setFlashdata("message", "Anda tidak diperkenankan memasuki menu tersebut, silahkan login ulang !");
                return redirect()->to('/Login');
            }
        }
    }

    public function index()
    {
        $title                      = 'Kriptografi - User';
        $breadcrumb_data['data']    = '';
        $content_data['breadcrumb'] = view('user/list/breadcrumb', $breadcrumb_data);
        $content                    = view('user/list/view', $content_data);
        $content_js                 = view('user/list/js');
        $content_css                = view('user/list/css');
        $this->template($title, $content, $content_js, $content_css);
    }

    public function listData()
    {
        $userModel = new userModel;

        $dataHex = [];
        $data = $userModel->list();

        if(!$data){
            $dataHex['data'] = $data;
        }else{
            foreach ($data as $d) {
                $dataHex['data'][] = $d;
            }
        }

        echo json_encode($dataHex);
    }

    public function add()
    {
        $data = service('request')->getPost('data');
        $nama = $data[0];
        $email = $data[1];
        $password = $data[2];
        $role = $data[3];

        $password = password_hash($password, PASSWORD_DEFAULT)."\n";

        $data_add = [
            'nama' => $nama,
            'email' => $email,
            'password' => $password,
            'role' => $role
        ];
        $userModel = new userModel();
        $insert = $userModel->insert($data_add);

        if(!$insert){
            $res = [
                'message' => ''
            ];
        }else{
            $res = [
                'message' => 'berhasil'
            ];
        }

        echo json_encode($res);
    }

    public function update()
    {
        $data = service('request')->getPost('data');
        $id_user = $data[0];
        $nama = $data[1];
        $email = $data[2];
        $password = $data[3];
        $role = $data[4];

        if($password){
            $password = password_hash($password, PASSWORD_DEFAULT)."\n";
            
            $data_add = [
                'nama' => $nama,
                'email' => $email,
                'password' => $password,
                'role' => $role
            ];
        }else{
            $data_add = [
                'nama' => $nama,
                'email' => $email,
                'role' => $role
            ];
        }

        $userModel = new userModel();
        $userModel->where('id_user', $id_user)->set($data_add)->update();

        $res = [
            'message' => 'berhasil'
        ];

        echo json_encode($res);
    }

    public function delete()
    {
        $data = service('request')->getPost('data');
        $id_user = $data[0];

        $userModel = new userModel;
        $userModel->where('id_user', $id_user)->delete();

        $res = [
            'message' => 'berhasil'
        ];

        echo json_encode($res);
    }
}
