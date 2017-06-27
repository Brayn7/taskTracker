<form class="mx-auto col-8  form-control" action="GET" action="">
   <input type="hidden" name="updating" value="<?php echo $data['id']; ?>">
   <div class="form-group">
      <label for="task_name">Task Name: </label>
      <input class="form-control" id="task_name" type="text" name="task_name" placeholder="Task Name" value="<?php echo $data['task_name']; ?>">
   </div>
   <div class="form-group">
      <label for="task_date">Date: </label>
      <input class="form-control" id="task_date" type="date" name="task_date" value="<?php echo $data['task_date']; ?>">
   </div>
   <div class="form-group">
      <label for="taskName">Start Time: </label>
      <input class="form-control" id="clock_in_time" type="time" name="clock_in_time" value="<?php echo $data['clock_in_time']; ?>">
   </div>
   <div class="form-group">
      <label for="taskName">End Time: </label>
      <input class="form-control" id="clock_out_time" type="time" name="clock_out_time" value="<?php echo $data['clock_out_time']; ?>">
   </div>
   
   
   <button name="saving" class="col-4 mx-auto btn btn-outline-primary btn-block" type="submit">Save</button>
   
   
</form>