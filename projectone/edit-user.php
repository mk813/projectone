<?php require_once('./include/header.php'); ?>

    <div class="container">
        <h2 class="pt-4">User Update</h2>
        <?php
            if($_SERVER['REQUEST_METHOD'] == 'GET')
                header("Location: index.php");

            if(isset($_POST['edit'])) {
                $id = $_POST['client_id'];
                $bomb1 = "SELECT * FROM `my_personal_contacts` WHERE `id`=$id";
                $bomb2 = mysqli_query($dbh,$bomb1);
                $bomb = mysqli_fetch_array($bomb2);
                if (!$bomb)
                    die("Editing record failed: " . mysqli_error($dbh));
            }
        ?>
            <?php
                if(isset($_POST['update_user'])) {
                    $id = $_POST['client_id'];
                    $edit = "UPDATE `my_personal_contacts`
                            SET `full_names`='".$_POST['full_names']."',
                                `gender`='".$_POST['gender']."',
                                `contact_no`='".$_POST['contact_no']."',
                                `email`='".$_POST['email']."',
                                `city`='".$_POST['city']."',
                                `country`='".$_POST['country']."'
                            WHERE `id`=$id";
                    $editt = mysqli_query($dbh, $edit);
                    if (!$editt)
                        die("Update record failed: " . mysqli_error($dbh)); 
                    else
                        header("Location: index.php");
                }
            ?>
        
            <form class="py-2" action="edit-user.php" method="POST">
                <div class="form-group">
                    <label for="full_names">full_names</label>
                    <input value="<?= $bomb['full_names'] ?>" name="full_names" type="text" class="form-control" id="full_names" placeholder="Desired full_names">
                </div>
                <div>
                    <tr>
                        <td class="tdLabel">
                            <label for="gender" class="label">Gender:</label>
                        </td>
                        <td> 
                            <input type="radio" name="gender" id="gender" <?php if( $bomb['gender'] == 'male') echo $checked = 'checked';?> value="male" />
                            <label for="gender">male</label>
                            
                            <input type="radio" name="gender" id="gender" <?php if( $bomb['gender'] == 'female') echo $checked = 'checked';?> value="female" />
                            <label for="gender">female</label>
                            
                            <input type="radio" name="gender" id="gender" <?php if( $bomb['gender'] == 'not sure') echo $checked = 'checked';?> value="not sure"/>
                            <label for="gender">not sure</label>
                        </td>
                    </tr>
                </div>
                <div class="form-group">
                    <label for="contact_no">contact_no</label>
                    <input value="<?= $bomb['contact_no']?>" name="contact_no" type="number" class="form-control" id="contact_no" placeholder="Enter new contact_no">
                </div>
                <div class="form-group">
                    <label for="email">email</label>
                    <input value="<?= $bomb['email']?>" name="email" type="email" class="form-control" id="email" placeholder="Enter new email">
                </div>
                <div class="form-group">                    <label for="city">city</label>
                    <input value="<?= $bomb['city']?>" name="city" type="text" class="form-control" id="city" placeholder="Enter new city">
                </div>
                <div class="form-group">                    <label for="country">country</label>
                    <input value="<?= $bomb['country']?>" name="country" type="text" class="form-control" id="country" placeholder="Enter new country">
                </div>
                <input value="<?= $bomb['id'] ?>" name='client_id'  type="hidden">
                <button type="submit" name="update_user" class="btn btn-primary">Submit</button>
            </form>
            </thead>
    </div>

<?php require_once('./include/footer.php'); ?>