<?php
    session_start();
    require "./mysqlCon/openCon.php";
    if(!isset($_GET['k'])){
        header("location: index.php");
    }
    if(isset($_POST['update'])){
        $arrError=[];

        // scrubbing
        $firstname = htmlspecialchars($_POST['firstname']);
        $lastname = htmlspecialchars($_POST['lastname']);
        $sex = htmlspecialchars($_POST['sex']);
        $birthday = htmlspecialchars($_POST['birthday']);
        $course = htmlspecialchars($_POST['course']);
        
        // validation
        if(empty($firstname))
            $arrError[] = "ERROR: please input firstname";
        if(empty($lastname))
            $arrError[] = "ERROR: please input lastname";
        if(empty($sex))
            $arrError[] = "ERROR: please input sex";
        if(empty($birthday))
            $arrError[] = "ERROR: please input birthday";
        if(empty($course))
            $arrError[] = "ERROR: please input course";

        if(!empty($arrError)){
            echo "<div class='w-1/2 text-lg font-semibold text-center mx-auto my-4 flex flex-col py-2 px-4 bg-red-400 text-white'>";
            foreach ($arrError as $key => $value) {
                echo 
                '
                    <h1>'.$value.'</h1>
                ';
            }
            echo "</div>";
        }
        // if empty, means on error
        else{
            $strSql = 
                "UPDATE students SET 
                    firstname='$firstname', 
                    lastname='$lastname',
                    sex='$sex',
                    birthday='$birthday', 
                    course='$course'
                WHERE id=". $_SESSION['k'];
            if(mysqli_query($con, $strSql))
                header("location:officialList.php");
            else
                echo "Update Query Failed";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Item</title>
    <link rel="stylesheet" href="output.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <?php if(isset($_GET['k'])):?>
        <?php 
            $_SESSION['k'] = $_GET['k'];
            
            
            $strSql = "SELECT * FROM students WHERE id=". $_SESSION['k'];
            if($rs = mysqli_query($con, $strSql)){
                if(mysqli_num_rows($rs) >0){
                    $student = mysqli_fetch_array($rs);
                }
            }
            mysqli_free_result($rs);
            require "./mysqlCon/closeCon.php";
        ?>
        <div class="container mx-auto my-4 p-4">
            <form method="post" class="lg:w-1/2 mx-auto my-8 p-4 space-y-4 bg-slate-200 rounded ">
                <h1 class="text-3xl font-semibold text-center">Update Student Info</h1>
                <div class="text-xl space-y-4">
                    <div class="flex justify-between items-center">
                        <label class="" for="firstname">Firstname:</label>
                        <input required type="text" name="firstname" id="firstname" class="border rounded border-slate-500 py-1 px-4 w-4/5" value=" <?php echo $student['firstname'] ?>">
                    </div>

                    <div class="flex justify-between items-center">
                        <label class="" for="lastname">Lastname:</label>
                        <input required type="text" name="lastname" id="lastname" class="border rounded border-slate-500 py-1 px-4 w-4/5" value="<?php echo $student['lastname'] ?>">
                    </div>

                    <div class="flex justify-between items-center">
                        <label class="" for="sex">Sex:</label>
                        <select name="sex" id="sex" class="border rounded border-slate-500 py-1 px-4 w-4/5" required>
                            <option value="male" <?php echo $student['sex'] == "male"? "selected" : "" ?>>Male</option>
                            <option value="female" <?php echo $student['sex'] == "female"? "selected" : "" ?>>Female</option>
                        </select>
                    </div>

                    <div class="flex justify-between items-center">
                        <label class="" for="birthday">Birthday:</label>
                        <input required type="date" name="birthday" id="birthday" class="border rounded border-slate-500 py-1 px-4 w-4/5" value="<?php echo $student['birthday'] ?>">
                    </div>

                    <div class="flex justify-between items-center">
                        <label class="" for="course">Course:</label>
                        <select name="course" id="course" class="border rounded border-slate-500 py-1 px-4 w-4/5" required>
                            <option value="scientist" <?php echo $student['course'] == "scientist"? "selected" : "" ?>>Scientist</option>
                            <option value="chemist" <?php echo $student['course'] == "chemist"? "selected" : "" ?>>Chemist</option>
                            <option value="pilot" <?php echo $student['course'] == "pilot"? "selected" : "" ?>>Pilot</option>
                            <option value="programmer" <?php echo $student['course'] == "programmer"? "selected" : "" ?>>Programmer</option>
                        </select>
                    </div>
                    
                    <div class="flex justify-end space-x-4 text-center text-white">
                        <a href="officialList.php" class="py-2 w-1/4 bg-slate-500 rounded flex-auto lg:flex-initial">Go back</a>
                        <button type="submit" name="update" class="py-2 w-1/4 bg-blue-500 rounded flex-auto lg:flex-initial">Update</button>
                    </div>
                </div>
            </form>
        </div>
    <?php endif ?>
</body>
</html>