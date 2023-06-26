<?php 
    include "./utilities/scrub.php";
    include "./utilities/errorChecking.php";
    if(isset($_POST['submit'])){

        // scrubbing
        $firstname = scrub($_POST['firstname']);
        $lastname = scrub($_POST['lastname']);
        $birthday = $_POST['birthday'];
        $sex = scrub($_POST['sex']);
        $course = scrub($_POST['course']);

        // validation
        $tempArr = [
            "firstname" => $firstname, 
            "lastname" => $lastname, 
            "birthday" => $birthday, 
            "sex" => $sex, 
            "course" => $course
        ];

        $arrErr = validation($tempArr);
        if(!empty($arrErr)){
            echo "<div class='container mx-auto text-center my-4'>";
            foreach ($arrErr as $key => $value) {
                echo '<h5 class="font-bold">'.$value.'</h5> <br>';
            }
            echo "</div>";
        }
        else{
            // opencon
            include "./mysqlCon/openCon.php";
            // prepare statement
            $query = 
            "INSERT INTO students(firstname, lastname, gender, birthday, course)
            VALUES(?,?,?,?,?)
            ";
            $isSuccessful= false;
            // validate
            if($stmt = mysqli_prepare($con, $query)){
                mysqli_stmt_bind_param($stmt, "sssss", $firstname,$lastname,$sex,$birthday,$course);
                mysqli_stmt_execute($stmt);
                $isSuccessful = true;
                header("location: confirmation.php" );
            }   
            else{
                echo "cannot perform prepare statement";
            }
            // closecon
            include "./mysqlCon/closeCon.php";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="output.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <div class="container mx-auto">
        <div class="text-center my-4">
            <h1 class="font-mono font-bold text-3xl"><i class="fa-brands fa-space-awesome"></i> SpaceX School Enrollment System</h1>
        </div>
        <?php 
            if(isset($isSuccessful)){
                $sentence = $isSuccessful? "" : "Something went wrong";
                $bg= $isSuccessful? "" : "bg-red-500";
                echo 
                    '<div class="w-1/2 mx-auto py-2 text-xl font-semibold text-center text-white '.$bg.' rounded">
                        '.$sentence.'
                    </div>';
            }
        ?>
        <form method="post" class="w-1/2 mx-auto space-y-4">
            <!-- firstname -->
            <div class="text-xl">
                <label for="firstname" class="block">
                    Firstname:
                </label>
                <input type="text" id="firstname" name="firstname" class="py-2 px-4 border border-black focus:outline-none focus:border-2 focus:border-sky-400 focus:shadow-md focus:shadow-sky-200 required:bg-red-500 w-full rounded">
            </div>
            <!-- lastname -->
            <div class="text-xl">
                <label for="lastname" class="block">
                    Lastname:
                </label>
                <input type="text" id="lastname" name="lastname" class="py-2 px-4 border border-black focus:outline-none focus:border-2 focus:border-sky-400 focus:shadow-md focus:shadow-sky-200 required:bg-red-500 w-full rounded">
            </div>
            <!-- sex -->
            <div class="text-xl">
                <label for="sex" class="block">
                    Sex:
                </label>
                <select name="sex" id="sex" class="w-full py-2 px-4 border border-black focus:outline-none focus:border-2 focus:border-sky-400 focus:shadow-md focus:shadow-sky-200 required:bg-red-500 rounded">
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select>
            </div>
            <!-- birthday -->
            <div class="text-xl">
                <label for="birthday" class="block">
                    Birthday:
                </label>
                <input type="date" id="birthday" name="birthday" class="py-2 px-4 border border-black focus:outline-none focus:border-2 focus:border-sky-400 focus:shadow-md focus:shadow-sky-200 required:bg-red-500 w-full rounded">
            </div>
            <!-- course -->
            <div class="text-xl">
                <label for="course" class="block">
                    Course:
                </label>
                <select name="course" id="course" class="py-2 px-4 border border-black focus:outline-none focus:border-2 focus:border-sky-400 focus:shadow-md focus:shadow-sky-200 required:bg-red-500 w-full rounded">
                    <option value="scientist">Scientist</option>
                    <option value="chemist">Chemist</option>
                    <option value="pilot">Pilot</option>
                    <option value="programmer">Programmer</option>
                </select>
            </div>
            <div class="text-xl">
                <button name="submit" type="submit" class="bg-green-500 py-2 rounded w-full text-white hover:bg-green-600">
                    Submit
                </button>
            </div>
        </form>
    </h1>
</body>
</html>