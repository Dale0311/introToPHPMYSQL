<?php
    session_start();
    require "./mysqlCon/openCon.php";
    if(!isset($_GET['k'])){
        header("location: index.php");
    }
    if(isset($_POST['delete'])){
        $strSql = "DELETE FROM students WHERE id=". $_SESSION['k'];
        if(mysqli_query($con, $strSql))
            header("location:officialList.php");
        else
            echo "Delete Query Failed";
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Item</title>
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
            <form method="post" class="lg:w-1/2 mx-auto my-8 p-4 space-y-4 bg-red-200 rounded ">
                <h1 class="text-3xl font-semibold text-center">Delete Student</h1>
                <div class="text-xl space-y-4">
                    <div class="flex justify-between items-center">
                        <label class="font-semibold" for="firstname">Firstname:</label>
                        <input type="text" name="firstname" id="firstname" class="border rounded cursor-not-allowed py-1 px-4 w-4/5 disabled:bg-slate-50" value=" <?php echo $student['firstname'] ?>" disabled>
                    </div>

                    <div class="flex justify-between items-center">
                        <label class="font-semibold" for="lastname">Lastname:</label>
                        <input type="text" disabled name="lastname" id="lastname" class="border rounded cursor-not-allowed py-1 px-4 w-4/5 disabled:bg-slate-50" value="<?php echo $student['lastname'] ?>">
                    </div>

                    <div class="flex justify-between items-center">
                        <label class="font-semibold" for="sex">Sex:</label>
                        <input disabled name="sex" id="sex" class="border rounded cursor-not-allowed py-1 px-4 w-4/5 disabled:bg-slate-50" value="<?php echo $student['sex']?>">
                    </div>

                    <div class="flex justify-between items-center">
                        <label class="font-semibold" for="birthday">Birthday:</label>
                        <input disabled type="date" name="birthday" id="birthday" class="border rounded cursor-not-allowed py-1 px-4 w-4/5 disabled:bg-slate-50" value="<?php echo $student['birthday'] ?>">
                    </div>

                    <div class="flex justify-between items-center">
                        <label class="font-semibold" for="course">Course:</label>
                        <input disabled name="course" id="course" class="border rounded cursor-not-allowed py-1 px-4 w-4/5 disabled:bg-slate-50" value="<?php echo $student['course']?>">
                    </div>
                    
                    <div class="flex justify-end space-x-4 text-center text-white">
                        <a href="officialList.php" class="py-2 w-1/4 bg-slate-500 hover:bg-slate-600 rounded flex-auto lg:flex-initial">Go back</a>
                        <button type="submit" name="delete" class="py-2 w-1/4 bg-blue-500 hover:bg-blue-600 rounded flex-auto lg:flex-initial">Delete</button>
                    </div>
                </div>
            </form>
        </div>
    <?php endif ?>
</body>
</html>