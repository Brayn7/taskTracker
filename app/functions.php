<?php

      ########### LOAD ENV ############
      require __DIR__ . "../../vendor/autoload.php";
      $dotenv = new Dotenv\Dotenv(__DIR__);
      $dotenv->load();
      use Herrera\Pdo\PdoServiceProvider;
      use Silex\Application;
      $app = new Application();
      $dbopts = parse_url(getenv('DB_URL'));
      $app->register(new Herrera\Pdo\PdoServiceProvider(),
               array(
                   'pdo.dsn' => 'pgsql:dbname='.ltrim($dbopts["path"],'/').';host='.$dbopts["host"] . ';port=' . $dbopts["port"],
                   'pdo.username' => $dbopts["user"],
                   'pdo.password' => $dbopts["pass"]
               )
        );

        $pdo = $app;
        var_dump($pdo);

      // connect to DB
      function getDB (){
        global $pdo;
         return pg_connect("$pdo[pdo.dsn] $pdo[pdo.username] $pdo[pdo.password]");
      }

      ########### CONTENTS ############
        // 1. INITIAL VARS     
        // 2. IS-SETS
        // 3. FUNCTIONS
          // getDb (connect to db)
          // getTask
          // getRow
          // addTask
          // removeTask
          // stopTime
          // updateRow

      ########### 1. INITIAL VARS ############
      // get timezone
      date_default_timezone_set('America/Kentucky/Louisville');
      // set defaults for info
      $statusMsg = NULL;
      $task_name = "";
      $task_date = date('m/d/y');
      $clock_in_time = date('H:i:s'); 
      $clock_out_time = NULL;

      ########### 2. IS-SETS ############

      // if task name is set then send info off to database
      if(empty($_GET['task_name'])){
        $statusMsg = "Please Enter a Task Name...";
      } else {
        $task_name = htmlentities($_GET['task_name']);
        $task_date = !empty($_GET['task_date']) ? htmlentities($_GET['task_date']) : $task_date;
        $clock_in_time = !empty($_GET['clock_in_time']) ? htmlentities($_GET['clock_in_time']) : $clock_in_time;
        $clock_out_time = !empty($_GET['clock_out_time']) ? htmlentities($_GET['clock_out_time']) : $clock_out_time;
       
          // if updating then update row 
           if (isset($_GET['updating'])){
            $id = htmlentities($_GET['updating']);
            updateRow(getDB(), $id, $task_name, $task_date, $clock_in_time, $clock_out_time);
          // if not updating add new row  
          } else {
            addTask(getDB(), $task_name, $task_date, $clock_in_time, $clock_out_time);
          }
       }
  
      // if removeTask is set then get id and remove row
      if (isset($_GET['removeTask'])){
        $id = htmlentities($_GET['removeTask']);
        removeTask(getDB(), $id);
      }
      // if stopTime is set then set clock out time as the current time
      if (isset($_GET['stopTime'])){
        $id = htmlentities($_GET['stopTime']);
        stopTime(getDB(), $id);
      }
      // if editTask is set then show get row data via id and save to $data
      if(isset($_GET['editTask'])){
        $id = htmlentities($_GET['editTask']);
        $data = getRow(getDB(), $id); 
      }

       ########### 3. FUNCTIONS ############


      // get all rows and columns from times
      function getTasks ($db){
         $request = pg_query($db, 'SELECT * FROM times;');
         return pg_fetch_all($request);
      }
      // get one row via id
      function getRow ($db, $id){
          $request = pg_query($db, "SELECT * FROM times WHERE id = '$id' ");
          return pg_fetch_all($request)[0];
      }
     // add a new row 
      function addTask($db, $task, $date, $clockin, $clockout) {
        // if $clockout is set to a time then add it too
        if ($clockout){
          $stmt = "insert into times (task_name, task_date, clock_in_time, clock_out_time) values ('$task', '$date', '$clockin', '$clockout' );";
        } else {
          // otherwise leave it null
          $stmt = "insert into times (task_name, task_date, clock_in_time, clock_out_time) values ('$task', '$date', '$clockin', NULL);";
        }
        $result = pg_query($stmt);
      }

      // get row via id and remove it
      function removeTask ($db, $id){
        $stmt = "DELETE FROM times WHERE id = '$id';";
        $result = pg_query($stmt);
      }
      // get row via id and update the clock out time
      function stopTime ($db, $id){
        $time = date('H:i:s');
        $date = date('m/d/y');
        $stmt = "UPDATE times SET (clock_out_time, last_update_date, last_update_time) = ('$time', '$date', '$time') WHERE id = '$id' ;";
        $result = pg_query($stmt);
      }
      // update row with changed data 
      function updateRow ($db, $id, $task, $date, $clockin, $clockout){
        $time = date('H:i:s');
        $date = date('m/d/y');
        if ($clockout){
          $stmt = "UPDATE times SET (task_name, task_date, clock_in_time, clock_out_time, last_update_date, last_update_time) = ('$task', '$date', '$clockin', '$clockout', '$date' , '$time') WHERE id = '$id' ;";
        } else {
          $stmt = "UPDATE times SET (task_name, task_date, clock_in_time, clock_out_time, last_update_date, last_update_time) = ('$task', '$date', '$clockin', NULL , '$date', '$time') WHERE id = '$id' ;";
        }
        
        $result = pg_query($stmt);
      }

?>