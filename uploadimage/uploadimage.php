    <?php
        $conn = mysqli_connect('localhost', 'root', ''); 
        if (!$conn)     
            die("Unable to connect to MySQL: " . mysqli_error($conn)); 
    	if (!mysqli_select_db($conn,'uploadimg'))     
		die("Unable to select database: " . mysqli_error($conn));
        
        if (isset($_POST['uploadfilesub'])) {
            $path = $_FILES['uploadfile']['name'];
            $ext = pathinfo($path, PATHINFO_EXTENSION);
            $filename = uniqid() .".".$ext;
            $filetmpname = $_FILES['uploadfile']['tmp_name'];
            $folder = 'uploadedimagef/';

            move_uploaded_file($filetmpname, $folder.$filename);

        $sql = "INSERT INTO `imgtable`(`imgname`) 
                                    VALUES ('$filename')";

        $qry = mysqli_query($conn, $sql);
        if (!$qry) {
            die("upload error" . mysqli_error($conn));
        } else {
            echo "askdksad";
        }
    }
    ?>
    
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Upload_image</title>
    </head>
    <body>
        <form action="" method="post" enctype="multipart/form-data">
        
            <input type="file" name="uploadfile"/>
            <input type="submit" name="uploadfilesub" value="upload"/>
        </form>

    <?php echo "time: ". time()." = ". uniqid()?>
    <table border="1px">

    <?php
    $sql_stmt = "SELECT * FROM `imgtable`";
    $result = mysqli_query($conn,$sql_stmt);
    $rows = mysqli_num_rows($result);
    if ($rows) {
        while ($row = mysqli_fetch_array($result)) {
            echo '<tr><td>' . $row['id'] . '</td>';
            echo '<td><img width="200px" src="uploadedimagef/'. $row['imgname'] . '" alt="альтернативный текст">';
            echo '<td>' . $row['imgname'] . '</td></tr>';
        }
    }

    ?>
    </table>
    </body>
    </html>