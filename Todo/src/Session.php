<?php

namespace App;

class Session{
    protected $id;
    public function __construct(){
    $status=session_status();
    if($status==PHP_SESSION_DISABLED){
        throw new \LogicException('Sessions are disabled.');
    }
    if($status==PHP_SESSION_NONE){
        session_start();
        $this->id=session_id();
    }
    }
   
/**
 * Gets a session value associated with teh specified key
 * @param string $key
 * @return mixed|null Returns the value on succes. Null if the key
 */
public function get($key){
    if(array_key_exists($key,$_SESSION ) ){
        return $_SESSION[$key];
    }
    return null;
}
/**
 * Gets a session value associated with teh specified key
 * @param string $key
 *  @param mixed $key
 */
public function set($key, $value){
    $_SESSION[$key]=$value;
   
}
/**
 * Delete session element
 * @param string $key
 *  @return bool
 */
public function delete($key){
    if(array_key_exists($key,$_SESSION ) ){
        unset($_SESSION[$key]) ;
        return true;
    }
    return false;
   
}
/**
 * Determines if a session key exists
 * @param string $key
 *  @return bool
 */
public function exists($key){
    array_key_exists($key,$_SESSION );
   
}
}