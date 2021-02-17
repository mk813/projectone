
<?php require_once('include/header.php'); ?>

    <div class="container">
      <?php
        if(isset($_POST['submit'])) {
            $full_names = trim($_POST['full_names']);
            $contact_no = trim($_POST['contact_no']);
            if(empty($full_names) || empty($contact_no)) {
                $error = true;
            } else {
              $sql_stmt = "INSERT INTO `my_personal_contacts` (`full_names`,`gender`,`contact_no`,`email`,`city`,`country`,`file`)"; 
              $sql_stmt .= " VALUES ('".$_POST['full_names']."', '".$_POST['gender']."','".$_POST['contact_no']."', '".$_POST['email']."','".$_POST['region']."', '".$_POST['country']."', '".$_POST['file']."')";            
                
              $result = mysqli_query($dbh, $sql_stmt);
              if (!$result)
                die("Adding record failed: " . mysqli_error($dbh));
              }
          }?>
          <form id="form" class="py-4" action="index.php" method="POST" enctype="multipart/form-data">
            <fieldset>
              <div class="row">
              <div class="col">full_names<red style="color:red">*</red>
                      <input id="name" type="text" name="full_names" class="form-control" placeholder="full_names">
                  </div>
                <div class="form-group">Gender
                    <select name="gender" id="gender" class="custom-select">
                        <option value="not sure">not sure</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select>
                  </div>
                  <div class="col">
                    <label for="contact">contact_no <red style="color:red">*</red>
                    <input id="contact" type="tel" name="contact_no" class="form-control" placeholder="contact_no">
                  </div>
              <div class="col">
                <label for="email">email <red style="color:red">*</red>
                      <input id="email" type="email" name="email" class="form-control" placeholder="email@example.com">
                  </div>
                  <div class="form-group">Region
                    <select name="region" id="region" class="custom-select">
                        <option value="not sure">not sure</option>
                        <option value="Chuy">Chuy</option>
                        <option value="Issyk-Kul">Issyk-Kul</option>
                        <option value="Naryn">Naryn</option>
                        <option value="Talas">Talas</option>
                        <option value="Jalal-Abad">Jalal-Abad</option>
                        <option value="Osh">Osh</option>
                        <option value="Batken">Batken</option>
                    </select>
                    <div class="invalid-feedback">Example invalid custom select feedback</div>
                  </div>
                  <div class="col">Country
                    <input id="country" type="text" name="country" class="form-control" placeholder="country">
                  </div>

                  <div class="form-group">Choose file <p>
                    <input type="file" name="file">
                  </div>

                  <div class="col"></br>
                      <input type="submit" name="submit" class="form-control btn btn-secondary" value="Add New User">
                      <?php echo isset($error) ? "<p>Full_names i contact_no obiyzatelno!</p>": ''; ?>
                  </div>
              </div>
            <fieldset>
          </form>
          <div class="input-group">
          <form action="index.php" method="post">
              <input name="search" type="search" class="form-control rounded" placeholder="Search" aria-label="Search" aria-describedby="search-addon"/>
              <button name="search_button" type="submit" class="btn btn-outline-primary">search</button>
          </form>
        </div>

          <!-- upload file php code -->
          <?php
            if (isset($_POST['submit'])) {
              $file = $_FILES['file'];

              $filename = $_FILES['file']['name'];
              $fileTmpName = $_FILES['file']['tmp_name'];
              $fileSize = $_FILES['file']['size'];
              $fileError = $_FILES['file']['error'];
              $fileType = $_FILES['file']['type'];

              $fileExt = explode('.', $filename);
              $fileActualExt = strtolower(end($fileExt));

              $allowed = array('jpg', 'jpeg', 'png');

              if (in_array($fileActualExt, $allowed)) {
                  if ($fileError === 0) {
                    if ($fileSize < 1000000) {
                      $fileNameNew = uniqid('', true).".".$fileActualExt;
                      $fileDestination = 'uploads/'.$fileNameNew;
                      move_uploaded_file($fileTmpName, $fileDestination);
                      header("Location: index.php?uploadsuccess");
                    } else {
                      echo "thats to big";
                    }
                  } else {
                    echo "error tp upload";
                  }
              } else {
                echo "error type";
              }
            }

          ?>
          <!-- search php -->
          <?php
            if (isset($_POST['search'])) {
              if (empty($_POST['search']))
                die("Field can't blank!");
              $searchValue = $_POST['search'];
                  $sql = "SELECT * FROM my_personal_contacts WHERE full_names LIKE '%$searchValue%'";
                $result = mysqli_query($dbh, $sql); ?>

                    <table class="table table-hover">
                      <thead>
                        <tr>
                          <th scope="col">ID</th>
                          <th scope="col">full_names</th>
                          <th scope="col">gender</th>
                          <th scope="col">contact_no</th>
                          <th scope="col">email</th>
                          <th scope="col">city</th>
                          <th scope="col">country</th>
                        </tr>
                      </thead>
                    </table>
                    
                <?php while ($row = mysqli_fetch_array($result)) { ?>
                    <table class="table table-dark table-hover">
                      <tbody>
                        <tr>
                          <th scope="row"><?= $row['id'];?></th>
                          <td><?= $row['full_names'];?></td>
                          <td><?= $row['gender'];?></td>
                          <td><?= $row['contact_no'];?></td>
                          <td><?= $row['email'];?></td>
                          <td><?= $row['city'];?></td>
                          <td><?= $row['country'];?></td>
                        </tr>
                      </tbody>
                    </table>
            <?php  }
            }
            ?>
          <br>
          <h2>All Users</h2>
          <table class="table">
              <thead class="thead-dark">
                <tr>
                  <th scope="col">ID</th>
                  <th scope="col">full_names</th>
                  <th scope="col">gender</th>
                  <th scope="col">contact_no</th>
                  <th scope="col">email</th>
                  <th scope="col">city</th>
                  <th scope="col">country</th>
                  <th scope="col">edit</th>
                  <th scope="col">delete</th>
                </tr>                   
              </thead>

              <tbody>
              <?php 
                    $sql_stmt = "SELECT * FROM my_personal_contacts"; 
                    $result = mysqli_query($dbh,$sql_stmt);
                    if (!$result)
                      die("Database access failed: " . mysqli_error($dbh));

                    $rows = mysqli_num_rows($result);
                  if ($rows) {
                  while ($row = mysqli_fetch_array($result)) {
                    echo '<tr><td>' . $row['id'] . '</td>';
                    echo '<td>' . $row['full_names'] . '</td>';
                    echo '<td>' . $row['gender'] . '</td>';
                    echo '<td>' . $row['contact_no'] . '</td>';
                    echo '<td>' . $row['email'] . '</td>';
                    echo '<td>' . $row['city'] . '</td>';
                    echo '<td>' . $row['country'] . '</td>';
                    ?>
                  <td>
                    <form action="edit-user.php" method="POST">
                      <input type="hidden" name="client_id" value="<?= $row['id']; ?>" />
                      <input type="submit" class="btn btn-link" name="edit" value="Edit" />
                    </form>
                  </td>
                    <td>
                      <form action="index.php" method="POST">
                        <input type="hidden" name="client_id" value="<?= $row['id']; ?>" />
                        <input type="submit" class="btn btn-link" onclick=" return myFunction();" name="delete" value="Delete" />
                        <script>
                          function myFunction() {
                              var x = confirm("Are you sure you want to delete?");
                              if (x)
                                  return true;
                              else
                                return false;
                          }
                          </script>
                      </form>
                    </td>
                  </tr>
                   <?php }
                } ?>              
              </tbody>
          </table> 
         
          <?php
              if(isset($_POST['delete'])) {
                $id = $_POST['client_id'];          
                $sql_stmt = "DELETE FROM `my_personal_contacts` WHERE `id` = '$id'";                              
                $result = mysqli_query($dbh,$sql_stmt);
                if (!$result)     
                  die("Deleting record failed: " . mysqli_error($dbh));

                header("Location: http://localhost/projectone/index.php");
                }
          ?>
    </div>
 <?php require_once('./include/footer.php');?>