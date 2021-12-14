<?php
  
 // connection to database----->

  $conn = mysqli_connect('localhost','root','','studentpro');
   if(isset($_POST['btn'])){
     $stuName = ($_POST['stdname']);
     $stuReg = ($_POST['stdreg']);
     $stuRoll = ($_POST['stdroll']);
     
     if(!empty($stuName) && !empty($stuReg)&&!empty($stdroll)){
       $query = " INSERT INTO student(stdname,stdreg,stdroll) VALUE('$stuName', $stuReg, $stuRoll)";
       $createQuery = mysqli_query($conn, $query);

     }
     else{
       echo "database not connected";
     }
  }
?>
 <!-- php coad for delete  -->
<?php
   if(isset($_GET['delete'])){
     $stdid = $_GET['delete'];
     $query = "DELETE FROM student WHERE id={$stdid}";
     $deleteQuery = mysqli_query($conn, $query);
   }

?>

  <!-- php coad for edit button -->
<?php
  if(isset($_GET['edit'])){
      $stdid = $_GET['edit'];
      $query = "SELECT * FROM student WHERE id= {$stdid}";
      $updateQuery = mysqli_query($conn, $query);
      while($get = mysqli_fetch_assoc($updateQuery)){
                    
      $stdid = $get['id'];
      $studentName = $get['stdname'];
      $stdreg = $get['stdreg'];
      $stdroll = $get['stdroll'];
  ?>

  <?php
      }
       }
  ?>
  <?php
  
  if(isset($_POST["edit_btn"])){
   $stdname = $_POST["stdname"];
   $stdreg = $_POST["stdreg"];
   $stdroll = $_POST["stdroll"];



   $query = "UPDATE student SET stdname='$stdname', stdreg = $stdreg, stdroll = $stdroll WHERE 
   id=$stdid";
   $updateQuery = mysqli_query($conn, $query);
   if($updateQuery){
     echo "updated done";
   }
   
   
  }
  
  ?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>crud system</title>
  </head>
  <body>
    <h4 class="text-center p-4">Student CRUD System</h4>

       <div class="container shadow m-5 p-3 ">
        <form action=" " method="post" class="d-flex justify-content-center">

        <input   class="form contorl m-2" type="text" name="stdname" placeholder="enter your name">

        <input class="form control m-2" type="number" name="stdreg" placeholder="enter your reg number">

        <input class="form control m-2" type="number" name="stdroll" placeholder="enter your roll number">
        -
        <input class="btn btn-success m-2" type="submit" value="Add" name="btn" >
        </form> 
    </div>

    <div class="container m-5 p-3 ">
      <form action=" " method="post" class="d-flex justify-content-center">

      
        

      <input class="form control m-2" type="text" name="stdname" value="<?php 
       if(isset($studentName)){
        echo $studentName;
        }?>">

          <input class="form control m-2" type="number" name="stdreg" value="<?php echo $stdreg;?>">

          <input class="form control m-2" type="number" name="stdroll" value="<?php echo $stdroll;?>">
          
          <input class="btn btn-primary m-2" type="submit" value="Update" name="edit_btn" >

      </form> 
    </div>
    <div class="container shadow m-5 p-3 gray-500 ">
      <table class="table table-striped table-hover">
        <tr>
          <th>Student Id</th>
          <th>Student Name</th>
          <th>Student Reg</th>
          <th>Student Roll</th>
          <th></th>
          <th></th>
        </tr>

        <!-- select all data from database and show in table  -->
        <?php
        $i = 1;
         $query = "SELECT * FROM student";
         $readQuery = mysqli_query($conn, $query);
         if($readQuery->num_rows>0){
           while($read=mysqli_fetch_assoc($readQuery)){
             
             $stdid = $read['id'];
             $stdname = $read['stdname'];
             $stdreg = $read['stdreg'];
             $stdroll = $read['stdroll'];
         ?>
        <tr>
          <th><?php echo $i++;?></th>
          <th><?php echo $stdname;?></th>
          <th><?php echo $stdreg;?></th>
          <th><?php echo $stdroll;?></th>
          <th><a href="index.php?edit=<?php echo $stdid;?>" class="btn btn-primary">Edit</a></th>
          <th><a href="index.php?delete=<?php echo $stdid;?>" class="btn btn-danger">Delete</a></th>
        </tr>
        <?php
           }
          }
        ?>

      </table>
    </div>
  
</body>
</html>