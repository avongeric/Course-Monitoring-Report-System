<?php
  // try to conncet to database
  $dbh = new PDO('mysql:host=mysql.cms.gre.ac.uk;dbname=mdb_aa9625f;charset=utf8','aa9625f','avm8My9Q');
   //$dbh = new PDO("mysql:dbname={$database};host={$host};port={3306}", $user, $pass);

   if(!$dbh){

      echo "unable to connect to database";
   }
   ?>