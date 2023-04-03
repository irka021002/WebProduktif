<?php

namespace App\Controllers;
use App\Models\userModel;
use App\Models\artikelModel;
use App\Models\komentarModel;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Home extends BaseController
{
    private function setUserSession($user)
    {
      $data = [
        'uid' => $user['uid'],
        'role' => $user['role'],
        'username' => $user['username'],
        'isLoggedIn' => true,
      ];
      session()->set($data);
      return true;
    }

    private function setUserCookie($user)
    {
      setcookie('uid', $user['uid'], time() + 3600);
      setcookie('role', $user['role'], time() + 3600);
      setcookie('username', $user['username'], time() + 3600);
      setcookie('isLoggedIn', true, time() + 3600);
      return true;
    }
    
    public function index()
    {
        return view('home_page');
    }

    public function masuk()
    {
        $data = [];
        if ($this->request->getMethod() == 'post') {
          // validation
          $rules = [
            'username' => 'required|min_length[6]|max_length[50]',
            'password' => 'required|min_length[3]|max_length[255]|validateUser[username,password]',
          ];
          $errors = [
            'password' => [
              'validateUser' => 'Email or Password don\'t match'
            ]
          ];
          if (!$this->validate($rules, $errors)) {
            $data['validation'] = $this->validator;
          } else {
            $model = new userModel();

            $user = $model->where('username', $this->request->getVar('username'))->first();
            $this->request->getVar('remember') ? $this->setUserCookie($user) : $this->setUserSession($user);
            return redirect()->to('tulisanku');
          }
        }
        if(session()->get('isLoggedIn') || isset($_COOKIE['isLoggedIn'])) {
          return redirect()->to('tulisanku');
        }
        return view('login_page', $data);
    }

    public function lupa()
    {
      $model = new userModel();
      if($this->request->getMethod() == 'post'){
        $user = $model->where('username', $this->request->getVar('username'))->first();
        if($user["email"] == $this->request->getVar('email')){
          return redirect()->to('/reset?email='.$user["email"]);
        }else{
          session()->setFlashdata("status", "Username dan email tidak cocok");
        }
      }
      return view('lupa_page');
    }
    public function reset()
    {
      $model = new userModel();
      if ($this->request->getMethod() == 'post'){
        $uri = current_url(true);
        $query = $uri->getQuery();
        $model->where("email",str_replace("%40","@",explode("=",$query)[1]))
              ->set(["password" => $this->request->getVar("password")])
              ->update();
        return redirect()->to('masuk');
      }
      return view('reset_page');
    }

    public function keluar()
    {
      helper(['cookie']);
      session()->destroy();
      setcookie('uid', '', time() - 3600);
      setcookie('role', '', time() - 3600);
      setcookie('username', '', time() - 3600);
      setcookie('isLoggedIn', '', time() - 3600);
      return redirect()->to('/');
    }

    public function daftar()
    {
        $data = [];
        helper(['form']);
        if ($this->request->getMethod() == 'post') {
          $rules = [
            'username' => 'required|min_length[6]|max_length[50]|is_unique[user.username]',
            'password' => 'required|min_length[8]|max_length[255]',
            'email' => 'required|is_unique[user.email]'
          ];
        if (!$this->validate($rules)) {
          $data['validation'] = $this->validator;
        } else {
          $model = new userModel();

          $newData = [
            'username' => $this->request->getVar('username'),
            'password' => $this->request->getVar('password'),
            'email' => $this->request->getVar('email'),
          ];

          $model->ignore(true)->insert($newData);
          return redirect()->to('masuk');
        }
      }
      if(session()->get('isLoggedIn') || isset($_COOKIE['isLoggedIn'])) {
        return redirect()->to('tulisanku');
      }
      return view('register_page', $data);
    }

    public function tulisanku()
    {
      helper(['cookie']);
        $artikels = new ArtikelModel();
        $data = [
          "role" => isset($_COOKIE['role']) ? $_COOKIE['role'] : session()->get('role'),
          "username" => isset($_COOKIE['username']) ? $_COOKIE['username'] : session()->get('username'),
          "isLoggedIn" => isset($_COOKIE['isLoggedIn']) ? $_COOKIE['isLoggedIn'] : session()->get('isLoggedIn'),
          "artikels" => $artikels->findAll(),
        ];
        return view('tulisan_page', $data);
    }
    
    public function artikel()
    {
        helper(['cookie']);
        $id = $this->request->getVar('aid');
        $artikel = new artikelModel();
        $komen = new komentarModel();
        $komentar = $komen->getKomentar($id);
        $hasil = $artikel->getArtikel($id);
        $data = [
            "role" => isset($_COOKIE['role']) ? $_COOKIE['role'] : session()->get('role'),
            "username" => isset($_COOKIE['username']) ? $_COOKIE['username'] : session()->get('username'),
            "isLoggedIn" => isset($_COOKIE['isLoggedIn']) ? $_COOKIE['isLoggedIn'] : session()->get('isLoggedIn'),
            'judul' => $hasil[0]->judul,
            'isi' => $hasil[0]->isi,
            'aid' => $hasil[0]->aid,
            'komentar' => $komentar
        ];
        return view('artikel_page', $data);
    }

    public function insertArtikel()
    {
        $model = new artikelModel();
        $data = array(
          'judul' => $this->request->getPost('judul'),
          'isi' => $this->request->getPost('isi'),
        );
        $model->insertArtikel($data);
        return redirect()->to('/tulisanku');
    }

    public function editArtikel()
    {
        $model = new artikelModel();
        $id = $this->request->getVar('aid');
        $data = array(
          'judul' => $this->request->getPost('judul'),
          'isi' => $this->request->getPost('isi'),
        );
        $model->editArtikel($data, $id);
        return redirect()->to('/tulisanku');
    }

    public function deleteArtikel()
    {
        $model = new artikelModel();
        $id = $this->request->getVar('aid');
        $model->deleteArtikel($id);
        return redirect()->to('/tulisanku');
    }

    public function insertKomentar()
    {
      $mode = new komentarModel();
      $data = array(
        'uid' => isset($_COOKIE['uid']) ? $_COOKIE['uid'] : session()->get('uid'),
        'aid' => $this->request->getVar('aid'),
        'isi' => $this->request->getVar('komentar'),
      );
      $mode->insertKomentar($data);
      return redirect()->to('/artikel?aid='.$this->request->getVar('aid'));
    }
}
