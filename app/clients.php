<!DOCTYPE html>
<html lang="en">
   <?php include 'head.html' ?>
   <body>
      <?php include 'functions.php'; ?>

      
      <div class="container-fluid">
         <div class="row">
            <div id="client_list" class="col-sm-10 col-md-8 mx-auto">
               <div class="row">
                  <form id="add_clients"  class="col p-5 mx-auto" action="clients.php" action="GET">
                     <div class="input-group">
                        <input type="text" class="form-control" name="client_name" placeholder="enter client name...">
                        <span class="input-group-btn">
                           <button class="btn btn-success" name="submit" value="add_client" type="submit">Add</button>
                        </span>
                     </div>
                  </form>
               </div>
               <div class="row">
               <?php foreach (getClients(getDB()) as $client) { ?>
                  <div class="col-6 client p-3 text-center">
                     <form class="d-inline-block align-text-bottom p-3" action="clients.php" action="GET">
                        <input type="hidden" name="id" value="<?= $client['id']?>">
                        <input type="text" name="client_name" value="<?=$client['name']?>">
                        <button class="btn btn-sm btn-outline-warning py-0" name="submit" value="edit_client" type="submit"><span>&#9998;</span></button>
                        <button class="btn btn-sm btn-outline-danger py-0" name="submit" value="delete_client" type="submit"><span>&times;</span></button>
                     </form>
                  </div>
               <?php } ?>

               </div>
            </div>
         </div>
         
      </div>
      
      <?php include 'scripts.html' ?>
   </body>
</html>