<?php

namespace App\Controllers;

use App\Request;
use App\Controller;
use App\Session;
use App\DB;

final class DashboardController extends Controller
{

    public function __construct(Request $request, Session $session)
    {
        parent::__construct($request, $session);
    }
    public function index()
    {
        
       $this->dashboard();
    }
    function dashboard(){
        $user=$this->session->get('uname');
        $userd=$this->session->get('email');
        $condition = ['user', $user['iduser']];
        $data = $this->getDB()->selectTaskUser('Task', ['titulo', 'description','due_date'], $condition);       
        $this->render(['user' => $userd,'id'=>$user['iduser'], 'data' => $data], 'dashboard');
    }
    public function insert()
    {
        $desc=filter_input(INPUT_POST, "desc", FILTER_SANITIZE_SPECIAL_CHARS);
        $date= filter_input(INPUT_POST, "date", FILTER_SANITIZE_SPECIAL_CHARS);
        $title= filter_input(INPUT_POST, "title", FILTER_SANITIZE_SPECIAL_CHARS);
        $user=$this->session->get('uname');
        $userd=$this->session->get('email');
        $campos = ['titulo' => $title,'description' => $desc,'user'=> $user['iduser'], 'due_date' => $date];
        $data = $this->getDB()->insert('Task', $campos );
        $this->dashboard();
    }
    public function delete()
    {
        $Taskt= filter_input(INPUT_POST, 'Taskt', FILTER_SANITIZE_STRING);
        
        $data = $this->getDB()->delete('Task', $Taskt);
       
        $this->dashboard();
         
    }
    
    public function edit()
    {
        $ndesc = filter_input(INPUT_POST, 'newdesc', FILTER_SANITIZE_STRING);
        $ndate = filter_input(INPUT_POST, 'newdate', FILTER_SANITIZE_STRING);
        $nidTask = filter_input(INPUT_POST, 'nidTask', FILTER_SANITIZE_STRING);

        $user = $this->session->get('user');
        $data = ['description' => $ndesc, 'due_date' => $ndate];
        $conditions = ['id', $nidTask];
        $result = $this->getDB()->update('Task', $data, $conditions);
        $this->render(['title' => 'Todo', 'user' => $user, 'data' => $result], 'dashboard');
    }
  

}
