<?php

require 'app.php';

function incluirTemplate ($nombre){
    include TEMPLATES_URL . "/${nombre}.php";
}

function estaAutenticado() : bool{
   session_start();

   $autenticado = $_SESSION['login'];

   if($autenticado){
       return true;
   }
   return false;
}