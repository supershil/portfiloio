<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require "include/conn.php";
include ("include/header.php");

$data = $_POST;
$errors = [];

if(isset($data['dothis']))
{

    if(trim($data['login'])=='')
    {
        array_push($errors , "login is empty");

    }
    if($data['password']=='')
    {
            array_push($errors , "password is empty");
    }
    if(trim($data['name'])=='')
    {
            array_push($errors , "Name is empty");
    }
    if(trim($data['email'])=='')
    {
            array_push($errors , "password is empty");
    }
    if($data['password']!=$data['password2'])
    {

            array_push($errors , "Confirmation password is incorect");
    }
    if(empty($errors)){
        //all good can register
        $user = R::dispense("users");
        $user->login = $data['login'];
        $user->password = $data['password'];
        $user->name = $data[name];
        $user->email = $data[email];
        $id = R::store($user);
        
        if($id > 0){
            echo '<div style="color: green;> You are registered. Your id: '.$id.'</div><hr/>';
        }
        else
        {
            echo '<div class="errors;"> Something wrong</div><hr/>';
        }

    }
    else{

        echo '<div class="errors;">'.array_shift($errors).'</div><hr/>';
    }

}



?>
<div class="formholder">
<form  class="l_form" action="/signup.php" method="POST">
    <p>
    <p><strong>Yourth login: </strong></p>
    <input type="text" name="login" value="<?php   echo @$data['login'];?>">
    </p>
    <p>
    <p><strong>Yourth password: </strong></p>
    <input type="password" name="password" value="<?php  echo @$data['password'];?>" >
    </p>
    <p>
    <p><strong>re-enter password: </strong></p>
    <input type="password" name="password2" value="<?php echo @$data['password2'];?>">
    </p>

    <p>
    <p><strong>Your Name: </strong></p>
    <input type="text" name="name" placeholder="John Doe" value="<?php   echo @$data['name'];?>">
    </p>

    <p>
    <p><strong>Your Email: </strong></p>
    <input type="text" name="email" value="<?php   echo @$data['email'];?>">
    </p>


    <p>
    <button type="submit" name="dothis" >Register me!! </button>
    </p>
</form>
    <div class="clear_float"> </div>
    </div>

<?php
include ("include/footer.php");
?>
