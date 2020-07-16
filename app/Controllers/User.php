<?php namespace App\Controllers;
use App\Models\M_user;
class User extends BaseController
{
	public function index()
	{
	   if (session()->get('user_nama') == '') {
		  session()->setFlashdata('gagal', 'Anda belum login');
		  return redirect()->to(base_url('login'));
	   }
 
	   $model = new M_user();
	   $data['user'] = $model->get_user();
 
	   return view('user_view', $data);
	}
	public function tambahdata()
   {
      echo view('tambahdata');
   }

   public function save()
   {
      $model = new M_user();
      $data = [
         'user_nama' => $this->request->getPost('user_nama'),
         'user_email' => $this->request->getPost('user_email')
      ];
      $model->saveUser($data);
      return redirect()->to('/user');
   }
   public function delete($id)
   {
      $model = new M_user();
      $model->deleteUser($id);
      return redirect()->to('/user');
   }
   public function edit($id)
   {
      $model = new M_user();
      $data['user'] = $model->get_user($id)->getRow();
      return view('editdata', $data);
   }

   public function updateData()
   {
      $model = new M_user();
      $id = $this->request->getPost('user_id');
      $data = [
         'user_nama' => $this->request->getPost('user_nama'),
         'user_email' => $this->request->getPost('user_email')
      ];
      $model->updateUser($data, $id);
      return redirect()->to('/user');
   }
 
 }
