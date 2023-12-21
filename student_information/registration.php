<?php include "important/header.php"; ?>

<?php
    if(isset($_POST['submit_btn'])){
        $msg = '';
        $name = $_POST['name'];
        $email = $_POST['email'];
        $number = $_POST['number'];
        $class = $_POST['class'];
        $gender = $_POST['gender'];
        $hobbies = json_encode($_POST['hobbies']);
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];

        

        if(empty($name) || $name==""){
            $msg = "Your name is empty";
        } elseif(empty($email) || $email==""){
            $msg = "Your email is empty";
        } elseif(empty($number) || $number==""){
            $msg = "Your number is empty";
        } elseif(empty($class) || $class==""){
            $msg = "Your class is empty";
        } elseif(empty($gender) || $gender==""){
            $msg = "Your gender is empty";
        } elseif(empty($hobbies) || $hobbies==""){
            $msg = "Your hobbies is empty";
        } elseif(empty($password) || $password==""){
            $msg = "Your password is empty";
        } elseif(empty($confirm_password) || $confirm_password==""){
            $msg = "Your confirm confirm_password is empty";
        }


        if($password==$confirm_password){
            $password = $password;
        }else{
            $msg = "Password doesn't match!!";
        }

        if(isset($msg) && $msg==''){
            $insert = "INSERT INTO student (`name`,`email`,`phone`,`class`,`gender`,`hobbies`,`password`) VALUES ('$name','$email','$number','$class','$gender','$hobbies','$password')";
            if($conn->query($insert) == true){
                $msg = "Registration successfull";
            } else{
                $msg = $conn->error();
            }
        }
    }
?>
<?php
    if(isset($_GET['edit_id'])){
        $id = $_GET['edit_id'];
        $id_select = "SELECT * FROM student WHERE id=".$id;
        $sql = $conn->query($id_select);
        $array_run = $sql->fetch_array();
    }

    if(isset($_POST['update_btn'])){
        $name = $_POST['name'];
        $email = $_POST['email'];
        $number = $_POST['number'];
        $class = $_POST['class'];
        $gender = $_POST['gender'];
        $hobbies = json_encode($_POST['hobbies']);

        $update = "UPDATE student SET name='$name',email='$email',phone='$number',class='$class',gender='$gender',hobbies='$hobbies' WHERE id=".$id;
        if($conn->query($update) == true){
            header("location: user_list.php");
        }
    }
?>

 <div class="row justify-content-center">
    <div class="col-lg-8">
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
                    <?php if(isset($_GET['edit_id'])): ?>
                        <h4>Registration Update</h4>
                    <?php else: ?>
                        <h4>Registration</h4>
                    <?php endif; ?>
                </div>
                <div class="card-body">

                    <div class="formGroup">
                        <label>Name <span class="error">*</span></label>
                        <input type="text" name="name" class="form-control" value="<?= isset($array_run['name'])? $array_run['name']:''; ?>" placeholder="Enter Your name..">
                    </div>
                    
                    <div class="formGroup">
                        <label>Email <span class="error">*</span></label>
                        <input type="email" name="email" class="form-control" value="<?= isset($array_run['email'])?$array_run['email']:''; ?>" placeholder="Enter Your email..">
                    </div>
                    
                    <div class="formGroup">
                        <label>Phone <span class="error">*</span></label>
                        <input type="number" name="number" class="form-control" value="<?= isset($array_run['phone'])?$array_run['phone']:''; ?>" placeholder="Enter Your number..">
                    </div>
                    
                    <div class="formGroup">
                        <label>Class <span class="error">*</span></label>
                        <input type="class" name="class" class="form-control" value="<?= isset($array_run['class'])?$array_run['class']:''; ?>" placeholder="Enter Your class">
                    </div>

                    <div class="formGroup">
                        <label>Gender <span class="error">*</span></label>
                        <div class="genderGroup">
                            <label><input type="radio" name="gender" value="1" <?= isset($array_run['gender']) && $array_run['gender'] ==1 ?'checked':'';?>>Male</label>
                            <label><input type="radio" name="gender" value="2" <?= isset($array_run['gender']) && $array_run['gender'] ==2 ?'checked':'';?>> Female</label>
                            <label><input type="radio" name="gender" value="3" <?= isset($array_run['gender']) && $array_run['gender'] ==3 ?'checked':'';?>> Others</label>
                        </div><!-- genderGroup -->
                    </div>

                    <div class="formGroup">
                        <label>Hobbies <span class="error">*</span></label>
                        <div class="checkboxGruop">
                            <label><input type="checkbox" name="hobbies[]" value="1" <?= isset($array_run['hobbies']) && !empty($array_run['hobbies']) && in_array(1,json_decode($array_run['hobbies'])) ?"checked":"";?>>Football</label>
                            <label><input type="checkbox" name="hobbies[]" value="2" <?= isset($array_run['hobbies']) && !empty($array_run['hobbies']) && in_array(2,json_decode($array_run['hobbies'])) ?"checked":"";?>>Cricket</label>
                            <label><input type="checkbox" name="hobbies[]" value="3" <?= isset($array_run['hobbies']) && !empty($array_run['hobbies']) && in_array(3,json_decode($array_run['hobbies'])) ?"checked":"";?>>Basketball</label>
                            <label><input type="checkbox" name="hobbies[]" value="4" <?= isset($array_run['hobbies']) && !empty($array_run['hobbies']) && in_array(4,json_decode($array_run['hobbies'])) ?"checked":"";?>>Swimming</label>
                            <label><input type="checkbox" name="hobbies[]" value="5" <?= isset($array_run['hobbies']) && !empty($array_run['hobbies']) && in_array(5,json_decode($array_run['hobbies'])) ?"checked":"";?>>Baseball</label>
                            <label><input type="checkbox" name="hobbies[]" value="6" <?= isset($array_run['hobbies']) && !empty($array_run['hobbies']) && in_array(6,json_decode($array_run['hobbies'])) ?"checked":""; ?>>Table tennis</label>
                        </div><!-- genderGroup -->
                    </div>

                    <?php if(!isset($_GET['edit_id'])): ?>
                    <div class="formGroup">
                        <label>Password <span class="error">*</span></label>
                        <input type="password" name="password" class="form-control" value="" placeholder="Enter Your password">
                    </div>
                    
                    <div class="formGroup">
                        <label>Confirm Password <span class="error">*</span></label>
                        <input type="password" name="confirm_password" class="form-control" value="" placeholder="Enter Your confirm password">
                    </div>
                    <?php endif; ?>
                </div>
                <div class="card-footer">
                    <?php if(isset($_GET['edit_id'])): ?>
                        <a href="user_list.php" class="btn btn-danger">Back</a>
                        <input type="submit" class="btn btn-warning" name="update_btn" value="Update">
                    <?php else: ?>
                        <input type="submit" class="btn btn-danger" name="submit_btn" value="Submit">
                    <?php endif; ?>
                </div>
            </div>
        </form>
    </div>
 </div>

<?php include "important/footer.php"; ?>