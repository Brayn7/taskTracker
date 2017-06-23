<?php

      date_default_timezone_set('America/Kentucky/Louisville');

      $statusMsg = NULL;
      $task_name = "";
      $task_date = date('m/d/y');
      $clock_in_time = date('H:i:s'); 
      $clock_out_time = NULL;

      if(empty($_GET['task_name'])){
        $statusMsg = "Please Enter a Task Name...";
      } else {
        $task_name = htmlentities($_GET['task_name']);
        $task_date = !empty($_GET['task_date']) ? htmlentities($_GET['task_date']) : $task_date;
        $clock_in_time = !empty($_GET['clock_in_time']) ? htmlentities($_GET['clock_in_time']) : $clock_in_time;
        $clock_out_time = !empty($_GET['clock_out_time']) ? htmlentities($_GET['clock_out_time']) : $clock_out_time;
       

           if (isset($_GET['updating'])){
            $id = htmlentities($_GET['updating']);
            updateRow(getDB(), $id, $task_name, $task_date, $clock_in_time, $clock_out_time);
          } else {
            addTask(getDB(), $task_name, $task_date, $clock_in_time, $clock_out_time);
          }
       }
  

      if (isset($_GET['removeTask'])){
        $id = htmlentities($_GET['removeTask']);
        removeTask(getDB(), $id);
      }

      if (isset($_GET['stopTime'])){
        $id = htmlentities($_GET['stopTime']);
        stopTime(getDB(), $id);
      }

      if(isset($_GET['editTask'])){
        $id = htmlentities($_GET['editTask']);
        $data = getRow(getDB(), $id); 
      }


      function getDB (){
         return pg_connect('
            host = localhost
            port = 5432
            dbname = timesheet
            user = brayn7
            password = admin
      ');
      }

      function getTasks ($db){
         $request = pg_query($db, 'SELECT * FROM times;');
         return pg_fetch_all($request);
      }

      function getRow ($db, $id){
          $request = pg_query($db, "SELECT * FROM times WHERE id = '$id' ");
          return pg_fetch_all($request)[0];
      }
     
      function addTask($db, $task, $date, $clockin, $clockout) {
        if ($clockout){
          $stmt = "insert into times (task_name, task_date, clock_in_time, clock_out_time) values ('$task', '$date', '$clockin', '$clockout' );";
        } else {
          $stmt = "insert into times (task_name, task_date, clock_in_time, clock_out_time) values ('$task', '$date', '$clockin', NULL);";
        }
        $result = pg_query($stmt);
      }

      function removeTask ($db, $id){
        $stmt = "DELETE FROM times WHERE id = '$id';";
        $result = pg_query($stmt);
      }

      function stopTime ($db, $id){
        $time = date('H:i:s');
        $stmt = "UPDATE times SET clock_out_time = '$time' WHERE id = '$id' ;";
        $result = pg_query($stmt);
      }

      function updateRow ($db, $id, $task, $date, $clockin, $clockout){
        $stmt = "UPDATE times SET (task_name, task_date, clock_in_time, clock_out_time) = ('$task', '$date', '$clockin', '$clockout') WHERE id = '$id' ;";
        $result = pg_query($stmt);
      }

?>