
<!DOCTYPE html>
<html lang="en">
<?php include 'head.html' ?>
  <body>

    <?php include 'functions.php'; ?>   

    <div id="showForm">
      <i class="fa fa-plus-circle" aria-hidden="true"></i>
    </div>
    <div id="hideForm" class="d-none">
      <i class="fa fa-minus" aria-hidden="true"></i>
    </div>
    <div class="container-fluid text-center">
      <h1>Time Sheet</h1>
      <div class="row mt-5">
        
        <?php 
          if(isset($_GET['editTask'])){
            include './forms/prefilledForm.php'; 
          } else {
            include './forms/blankForm.html';
          }
        ?>
        
      </div>
      <div class="row mx-auto mt-5 w-100">
        
        <?php include 'tableContents.php'; ?>
        
      </div>
    </div>
   
  <?php include 'scripts.html' ?>
  </body>
</html>