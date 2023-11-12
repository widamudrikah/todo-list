<?php
include 'db.php';

// Select data yang akan diedit
$q_select = "SELECT * FROM task WHERE task_id = '".$_GET['id']."'"; //id diambil dari url
$run_q_select = mysqli_query($conn, $q_select);
$d = mysqli_fetch_object($run_q_select);


// Proses update data
if(isset($_POST['edit'])) {
    $q_update = "UPDATE task SET task_lable = '".$_POST['task']."' WHERE task_id = '".$_GET['id']."' ";
    $run_q_update = mysqli_query($conn, $q_update);

    header('Refresh:0; url=index.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ToDo List</title>
    <!-- Box icon -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="style.css">

</head>

<body>
    <div class="container">
        <div class="header">
            <div class="title">
                <a href="index.php"><i class='bx bx-chevron-left' style='color:#f5d506'></i></a>
                <span>Back</span>
            </div>

            <div class="description">
                <?= date("l, d M Y") ?>
            </div>
        </div>

        <div class="content">
            <div class="card">
                <form action="" method="post">
                    <input type="text" name="task" class="input-control" placeholder="Edit Task" value="<?= $d->task_lable?>">
                    <div class="text-right">
                        <button type="submit" name="edit">Edit</button>
                    </div>
                </form>
            </div>
<!-- ingat penutupnya ada di bawah, buat if else nya dulu, baru diisi blok kode yang akan di eksekusi -->

        </div>
    </div>
</body>

</body>

</html>