<table id="taskTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
  <thead>
    <tr>
      <th></th>
      <th>Date</th>
      <th>Task Name</th>
      <th>Start</th>
      <th>End</th>
    </tr>
  </thead>
  <?php foreach(getTasks(getDB()) as $task) { ?>
  <tbody class="table-striped">
    <tr>
      <td width="75px" class="px-0">
        <form class="form-inline d-inline" action="GET" action="">
          <div class="d-inline-block p-0 ">
            <input name="removeTask" type="hidden" value='<?=$task["id"];?>'>
            <button class="btn btn-danger btn-sm" type="submit" >
            <span>&times;</span>
            </button>
          </div>
        </form>
        <form class="form-inline d-inline" action="GET" action="">
          <div class="d-inline-block p-0">

            <input name="editTask" type="hidden" value='<?=$task["id"];?>'>
            <button class="btn btn-info btn-sm" type="submit" >
            <span>&#9998;</span>
            </button>
          </div>
        </form>
      </td>
      <td>
        <?=$task['task_date'];?>
      </td>
      <td>
        <?=$task['task_name'];?>
      </td>
      <td>
        <?= date('h:i A', strtotime($task['clock_in_time']));?>
      </td>
      <td>
        <?php
        
        if ($task['clock_out_time'] === null){
          echo '<form class="form-inline d-inline" action="GET" action="">
            <div class="d-inline-block p-0 ">
              <input name="stopTime" type="hidden" value=' . $task["id"] .'>
              <button id="stopBtn" class="no-border btn btn-outline-danger" type="submit" >
              <i class="fa fa-stop-circle-o"></i>
              </button>
            </div>
          </form>';
        } else {
          echo date('h:i A', strtotime($task['clock_out_time']));
        }
        
        ?>
      </td>
    </tr>
    <?php } ?>
  </tbody>
</table>