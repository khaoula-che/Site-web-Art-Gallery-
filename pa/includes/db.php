<?php
try{
       $bdd = new PDO('mysql:host=51.75.246.121;dbname=ARTSGALLERY', 'groupe3', 'G32023', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
      }
      
   catch(Exception $e){
       die('Erreur PDO : ' . $e->getMessage());
   }
?>