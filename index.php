<?php
include 'db.php';
// Proses insert data
if (isset($_POST['add'])) {
    $q_insert = "INSERT INTO task (task_lable, task_status) VALUE (
        '" . $_POST['task'] . "',
        'open'
    )";
    $run_q_insert = mysqli_query($conn, $q_insert);
    if ($run_q_insert) {
        header('Refresh:0; url=index.php');
    }
}

// Proses show data
$q_select = "SELECT * FROM task ORDER BY task_id DESC";
$run_q_select = mysqli_query($conn, $q_select);

// Proses delete data
if(isset($_GET['delete'])) {
    $q_delete = "DELETE FROM task WHERE task_id = '".$_GET['delete']."'";
    $run_q_delete = mysqli_query($conn, $q_delete);
    header('Refresh:0; url=index.php');
}

// Proses update data (close or open)
if(isset($_GET['done'])) {
    $status = 'close';

    if($_GET['task_status'] == 'open') {
        $status = 'close';
    }else {
        $status = 'open';
    }

    $q_update = "UPDATE task SET task_status = '".$status."' WHERE task_id = '".$_GET['done']."'";
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
                <i class='bx bx-sun' style='color:#f5d506'></i>
                <span>To Do list</span>
            </div>

            <div class="description">
                <?= date("l, d M Y") ?>
            </div>
        </div>

        <div class="content">
            <div class="card">
                <form action="" method="post">
                    <input type="text" name="task" class="input-control" placeholder="Add Task">
                    <div class="text-right">
                        <button type="submit" name="add">Add</button>
                    </div>
                </form>
            </div>
<!-- ingat penutupnya ada di bawah, buat if else nya dulu, baru diisi blok kode yang akan di eksekusi -->
            <?php
            if (mysqli_num_rows($run_q_select) > 0) {
                while($r = mysqli_fetch_array($run_q_select)){
            ?>
                <div class="card">
                    <div class="task-item <?= $r['task_status'] == 'close' ? 'done': ''?>">
                        <div>
                            <input type="checkbox" onclick="window.location.href = '?done=<?= $r['task_id']?>&task_status=<?= $r['task_status']?>'" <?= $r['task_status'] == 'close' ? 'checked':'' ?>>
                            <span><?= $r['task_lable']?></span>
                        </div>
                        <div>
                            <a href="edit.php?id=<?= $r['task_id']?>" class="teks-orange" title="Edit"><i class='bx bxs-edit'></i></a>
                            <a href="?delete=<?= $r['task_id']?>" class="teks-red" title="Remove" onclick="return confirm('Are you sure?')"><i class='bx bxs-trash'></i></a>
                        </div>
                    </div>
                </div>
            <?php } } else { ?>
                <div>Belum ada task</div>
            <?php } ?>


        </div>
    </div>
</body>

</body>

</html>