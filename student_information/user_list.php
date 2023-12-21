<?php include "important/header.php"; ?>

<?php
    $select = "SELECT * FROM student";
    $result = $conn->query($select);
?>
<?php
    function get_gender ($data){
        if($data==1){
            $data_result = "male";
        } elseif($data==2){
            $data_result = "female";
        } else{
            $data_result = "Others";
        }
        return $data_result;
    }

    function get_hobbies($type){
        $hobby = json_decode($type);
        $hobby_value = [];
        foreach($hobby as $key => $hobby_id){
            if($hobby_id==1){
                $hobby_value[] = 'football';
            }
            if($hobby_id==2){
                $hobby_value[] = 'cricket';
            }
            if($hobby_id==3){
                $hobby_value[] = 'Basketball';
            }
            if($hobby_id==4){
                $hobby_value[] = 'Swimming';
            }
            if($hobby_id==5){
                $hobby_value[] = 'Baseball';
            }
            if($hobby_id==6){
                $hobby_value[] = 'Table tennis';
            }
        }
        return   implode(",",$hobby_value);;
    }

?>
<?php
    if(isset($_GET['delete_id'])){
        $id = $_GET['delete_id'];
        $data_delete = "DELETE FROM student WHERE id=".$id;
        if($conn->query($data_delete) == true){
            header("location: user_list.php");
        }
    }
?>

<div class="row justify-content-center">
    <div class="col-lg-12">
        <h4>User List</h4>
        <table class="table tableStyle">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Number</th>
                    <th>Class</th>
                    <th>Gender</th>
                    <th>Hobbies</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $i =1; ?>
                <?php while($all = $result->fetch_assoc()){ ?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $all['name']; ?></td>
                    <td><?php echo $all['email']; ?></td>
                    <td><?php echo $all['phone']; ?></td>
                    <td><?php echo $all['class']; ?></td>
                    <td><?php echo get_gender($all['gender']); ?></td>
                    <td><?php echo get_hobbies($all['hobbies']); ?></td>
                    <td>
                    <a href="registration.php?edit_id=<?php echo $all['id']; ?>" class="classEditbtn btn btn-primary">Edit</a>
                    <a href="user_list.php?delete_id=<?php echo $all['id']; ?>" class="classDeletebtn btn btn-warning">Delete</a>
                    </td>
                </tr>
                <?php $i++;?>
                <?php };?>
            </tbody>
        </table>
    </div>
</div>

<?php include "important/footer.php"; ?>