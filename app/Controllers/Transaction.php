<?php

namespace App\Controllers;
use App\Controllers\BaseController;

use App\Libraries\AES;

use App\Models\transaction as transactionModel;

class Transaction extends BaseController
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
        $title                      = 'Kriptografi - Transaction';
        $breadcrumb_data['data']    = '';
        $content_data['breadcrumb'] = view('transaction/list/breadcrumb', $breadcrumb_data);
        $content                    = view('transaction/list/view', $content_data);
        $content_js                 = view('transaction/list/js');
        $content_css                = view('transaction/list/css');
        $this->template($title, $content, $content_js, $content_css);
    }

    public function listData()
    {
        $transactionModel = new transactionModel;

        $dataHex = [];
        $data = $transactionModel->listTransaction();

        if(!$data){
            $dataHex['data'] = $data;
        }else{
            foreach ($data as $d) {
                if($d['upload_by'] == session()->get('role') || session()->get('role') == 1){
                    if($d['tgl_upload']){
                        $d['tgl_upload'] = date("Y-m-d", strtotime($d['tgl_upload']));
                    }else{
                        $d['tgl_upload'] = '';
                    }
                    $dataHex['data'][] = $d;
                }
            }
            if(count($dataHex) == 0){
                $dataHex['data'] = '';
            }
        }

        echo json_encode($dataHex);
    }

    public function add()
    {
        date_default_timezone_set('Asia/Jakarta');

        $key =  substr(md5($this->request->getPost('password')), 0,16);
        
        $file_tmpname = $this->request->getFile('file');
        $filename = $file_tmpname->getName();
        $file_name_source = $file_tmpname->getName();
        
        //untuk nama file url
        $file           = rand(1000,100000)."-".$filename;
        $new_file_name  = strtolower($file);
        $final_file     = str_replace(' ','-',$new_file_name);
        //untuk nama file
        $filename       = rand(1000,100000)."-".pathinfo($filename, PATHINFO_FILENAME);
        $new_filename   = strtolower($filename);
        $finalfile      = str_replace(' ','-',$new_filename);
        $size           = filesize($file_tmpname);
        $size2          = (filesize($file_tmpname))/1024;
        $info           = pathinfo($final_file );
        $file_source    = fopen($file_tmpname, 'rb');
        $ext            = $info["extension"];

        if( $ext=="docx" || $ext=="txt" || $ext=="pdf" || $ext=="xls" || $ext=="xlsx" || $ext=="ppt" || $ext=="pptx"){
            if($size2 > 10300){
                $res = [
                    'message' => 'gagal',
                    'data' => 'Maximal size file adalah 10mb'
                ];    
            }else{
                $url   = $finalfile.".rda";
                $file_url = ".\\..\\public\\file\\".$url;
                
                $file_output = fopen($file_url, 'wb');

                $mod    = $size%16;
                if($mod==0){
                    $banyak = $size / 16;
                }else{
                    $banyak = ($size - $mod) / 16;
                    $banyak = $banyak+1;
                }

                $test = [];
                if(is_uploaded_file($file_tmpname)){
                    ini_set('max_execution_time', -1);
                    ini_set('memory_limit', -1);
                    $aes = new AES();
          
                    for($i=0;$i<$banyak;$i++){
                        $data    = fread($file_source, 16);
                        $cipher  = $aes->encrypt($data, $key); 
                        fwrite($file_output, $cipher);
                    }
                    fclose($file_source);
                    fclose($file_output);

                    $data_add = [
                        'upload_by' => session()->get('id_user'),
                        'file_name_source' => $file_name_source,
                        'file_name_finish' => ".\\..\\public\\file\\".$file_name_source,
                        'file_url' => $file_url,
                        'file_size' => $size,
                        'password' => $key,
                        'tgl_upload' => date("Y/m/d H:i:s")
                    ];
            
                    $transactionModel = new transactionModel();
                    $insert = $transactionModel->insert($data_add);
            
                    if(!$insert){
                        $res = [
                            'message' => 'gagal',
                            'data' => 'Gagal encrypt data'
                        ];
                    }else{
                        $res = [
                            'message' => 'berhasil'
                        ];
                    }
            
                    echo json_encode($res);
                }
            }
        }else{
            $res = [
                'message' => 'gagal',
                'data' => 'Extension tidak terdaftar'
            ];
        }
    }

    function decrypt()
    {
        $data = service('request')->getPost('data');
        $id_file = $data[0];
        $password = $data[1];

        $transactionModel = new transactionModel();
        $getData = $transactionModel->select('*')->where('id_file', $id_file)->get()->getResult('array');

        $key = substr(md5($password), 0,16);
        if($getData[0]['password'] == $key){
            $file_path = $getData[0]['file_url'];
            $file_name = $getData[0]['file_name_source'];
            $file_size = $getData[0]['file_size'];

            $mod        = $file_size%16;

            $aes        = new AES();
            $fopen1     = fopen($file_path, "rb");
            $plain      = "";
            $cache      = ".\\..\\public\\file\\$file_name";
            $fopen2     = fopen($cache, "wb");
        
            if($mod==0){
                $banyak = $file_size / 16;
            }else{
                $banyak = ($file_size - $mod) / 16;
                $banyak = $banyak+1;
            }
        
            ini_set('max_execution_time', -1);
            ini_set('memory_limit', -1);
            for($i=0;$i<$banyak;$i++){
                $filedata    = fread($fopen1, 16);

                $plain = $aes->decrypt($filedata, $key);
                fwrite($fopen2, $plain);
            }

            $res = [
                'message' => 'berhasil',
                'data' => $file_name
            ];
        }else{
            $res = [
                'message' => 'gagal',
                'data' => 'Password tidak sesuai'
            ];
        }

        echo json_encode($res);
    }

    public function delete()
    {
        $data = service('request')->getPost('data');
        $id_file = $data[0];

        $transactionModel = new transactionModel;
        $getData = $transactionModel->select('*')->where('id_file', $id_file)->get()->getResult('array');

        if(file_exists($getData[0]['file_url'])){
            unlink($getData[0]['file_url']);
        }

        if(file_exists($getData[0]['file_name_finish'])){
            unlink($getData[0]['file_name_finish']);
        }
        
        $transactionModel->where('id_file', $id_file)->delete();

        $res = [
            'message' => 'berhasil'
        ];

        echo json_encode($res);
    }
    
}
