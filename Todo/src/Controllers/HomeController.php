<?php

namespace App\Controllers;

use App\Request;
use App\Controller;
use App\Session;
use App\DB;

final class HomeController extends Controller
{

    public function __construct(Request $request, Session $session)
    {
        parent::__construct($request, $session);
    }
    public function index()
    {
      
        $this->select();
    }
    public function select()
    {
        $user=$this->session->get('uname');
        $userd=$this->session->get('email');
        $condition = ['user', $user['iduser']];
        $data = $this->getDB()->selectTaskUser('Task', ['titulo', 'description','due_date'], $condition);
        //$data=$this->getDB()->selectAllWithJoin("Task","Users",['Task.id', 'Task.description', 'Task.due_date'],"user","id", $condition );

        $this->render(['user' => $userd, 'id'=>$user['iduser'], 'data' => $data], 'home');
        
    }
    
    

}
