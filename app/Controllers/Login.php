<?php namespace App\Controllers;
use App\Models\user;

class Login extends BaseController
{
	public function index()
	{
		echo view('login/view');
	}

	public function auth(){
		$user = new user();
		$email = $this->request->getPost('email');
		$password = $this->request->getPost('passwords');

		$getPass = $user->select('id_user, password, role')->where('email', $email)->get()->getResult('array');
    if($getPass){
      if(password_verify($password, trim($getPass[0]['password']))){
        session()->set('id_user', $getPass[0]['id_user']);
        session()->set('role', $getPass[0]['role']);
		    return redirect()->to('/');
      }else{
        session()->setFlashdata('message', 'Password Salah');
        return redirect()->to('/Login');
      }
    }else{
      session()->setFlashdata('message', 'Email tidak ditemukan');
			return redirect()->to('/Login');
    }
	}

	public function token_habis(){
		session()->setFlashdata("message", "Maaf, Token telah habis. Silahkan login kembali !");
		echo view('login/view');
		session()->destroy();
	}

	public function logout(){
		session()->destroy();
		return redirect()->to('/Login');
	}

	public function cek_session()
	{
		if(session()->get("id_user")){
			$data = [
				'message' => 'berhasil'
			];
		}else{
			$data = [
				'message' => 'gagal'
			];
		}

		echo json_encode($data);
	}
}