<?php include "important/header.php"; ?>

<?php
if(isset($_POST['submit_btn'])){
    $msg = '';
    $name = $_POST['class'];

    if(empty($name) || $name==''){
        $msg = "Your class name is empty";
    }
    if(isset($msg) && $msg==''){
        $sql = "INSERT INTO class_name(`name`) VALUE ('$name')";
        if($conn->query($sql) == true){
            $msg = "Your class add successfull";
        } else{
            $msg =$conn->error();
        }
    }
}
?>
<?php
    $select = "SELECT * FROM class_name";
    $result = $conn->query($select);

    if(isset($_GET['delete_id'])){
        $id = $_GET['delete_id'];
        $delete ="DELETE FROM class_name WHERE id=".$id;
       if($conn->query($delete) == true){
            header("location: class_name.php");
       }
    }
?>
<?php
    
    if(isset($_GET['edit_id'])){
        $edit_id = $_GET['edit_id'];
        $id_seclect = "SELECT * FROM class_name WHERE id=".$edit_id;
        $query_select = $conn->query($id_seclect);
        $fetch_run = $query_select->fetch_array();
    }

    if(isset($_POST['update_btn'])){
        $name = $_POST['class'];
        $update = "UPDATE class_name SET name='$name' WHERE id=".$edit_id;
        if($conn->query($update) == true){
            header("location: class_name.php");
        }
    }

?>

<div class="row justify-content-center">
    <div class="col-lg-4">
        <?php if(isset($msg)): ?>
            <!-- error msg-->
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong></strong><?php echo $msg; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <!-- error msg -->
        <?php endif; ?>
        <form action="" method="POST">
            <div class="card">
                <div class="card-header">
                    <h4>Add Class Name</h4>
                </div>
                <div class="card-body">
                    <label>Class Name :</label>
                    <input type="text" name="class" value="<?= isset($fetch_run['name'])?$fetch_run['name']:''; ?>" placeholder="Class...">
                </div>
                <div class="card-footer">
                    <?php if(isset($_GET['edit_id'])): ?>
                        <a href="class_name.php" class="btn btn-danger">Back</a>
                        <input type="submit" class="submit_btnstyle" name="update_btn" value="Update">
                    <?php else: ?>
                        <input type="submit" class="submit_btnstyle" name="submit_btn" value="Submit">
                    <?php endif; ?>
                </div>
            </div>
        </form>
    </div>
</div>
<section class="tableSection">
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Class Name</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?php $i=1;?>
        <?php while($all = $result->fetch_assoc()){ ?>
            <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo $all['name']; ?></td>
                <td>
                    <a href="class_name.php?edit_id=<?php echo $all['id']; ?>" class="classEditbtn btn btn-primary">Edit</a>
                    <a href="class_name.php?delete_id=<?php echo $all['id']; ?>" class="classDeletebtn btn btn-warning">Delete</a>
                </td>
            </tr>
        <?php $i++;?>
        <?php };?>
        </tbody>
    </table>
</section>

<?php include "important/footer.php"; ?>