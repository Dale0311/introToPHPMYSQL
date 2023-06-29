<?php
    session_start();
    if(isset($_POST['login'])){
        $arrError=[];
        $username = htmlspecialchars($_POST['username']);
        $password = htmlspecialchars($_POST['password']);

        // validation
        if(empty($username)){
            $arrError['username']= "required";
        }
        if(empty($password)){
            $arrError['password']= " required";
        }
        if(empty($arrError)){
            require_once "./mysqlCon/openCon.php";
            $strSql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
            if($rs = mysqli_query($con, $strSql)){
               if(mysqli_num_rows($rs) > 0){
                $record = mysqli_fetch_array($rs);
                print_r($record);
               }

            }
            require_once "./mysqlCon/closeCon.php";
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
</head>
<body>
    <form class="w-4/5 mx-auto bg-[#F9FAFB] border rounded py-8 h-screen" method="post">
        <div class="w-1/4 mx-auto border bg-white py-8 px-4 rounded space-y-4 hover:shadow-lg">
            <div class="space-y-1">
                <input type="text" name="username" id="username" class="border rounded w-full py-4 px-4 focus:outline-sky-500 focus:border-sky-500" placeholder="Username or Email">
            </div>
            <div class="space-y-1">
                <input type="text" name="password" id="password" class="border rounded w-full py-4 px-4 focus:outline-sky-500 focus:border-sky-500" placeholder="Password">
            </div>
            <button type="submit" name="login" class="py-2 w-full bg-blue-500 hover:bg-blue-600 text-white rounded font-semibold">Login</button>
        </div>
    </form>
</body>
</html>