<form class="mx-auto col-8  form-control" action="GET" action="">
   <div class="form-group">
      <label for="taskName">Task Name: </label>
      <input class="form-control" id="task_name" type="text" name="task_name" placeholder="Task Name" value="<?php echo "cheese" ?>">
   </div>
   <div class="form-group">
      <label for="taskName">Date: </label>
      <input class="form-control" id="task_date" type="date" name="task_date" value="<?php  ?>">
   </div>
   <div class="form-group">
      <label for="taskName">Start Time: </label>
      <input class="form-control" id="clock_in_time" type="time" name="clock_in_time" value="<?php  ?>">
   </div>
   <div class="form-group">
      <label for="taskName">End Time: </label>
      <input class="form-control" id="clock_out_time" type="time" name="clock_out_time" value="<?php  ?>">
   </div>
   
   
   <button class="col-4 mx-auto btn btn-outline-primary btn-block" type="submit">Save</button>
   
   
</form>