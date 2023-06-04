<?php

namespace App\Controllers;
use App\Controllers\BaseController;

class Home extends BaseController
{
    public function _remap($method, ...$params)
    {
        if(!session()->has('id_user')){
            session()->setFlashdata("message", "Silahkan login terlebih dahulu !");
			return redirect()->to('/Login');
		}else{
            return $this->$method(...$params);
        }
    }

    public function index()
    {
        $title                      = 'TOKOUNIONJACK - Dashboard';
        $breadcrumb_data['data']    = '';
        $content_data['breadcrumb'] = view('home/list/breadcrumb', $breadcrumb_data);
        $content                    = view('home/list/view', $content_data);
        $content_js                 = view('home/list/js');
        $content_css                = view('home/list/css');
        $this->template($title, $content, $content_js, $content_css);
    }
}
