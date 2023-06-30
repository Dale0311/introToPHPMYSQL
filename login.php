<?php
    session_start();
    if(isset($_POST['login'])){
        $arrError=[];
        require_once "./mysqlCon/openCon.php";
        
        // anti xml and sql injection
        $username = htmlspecialchars($_POST['username']);
        $password = htmlspecialchars($_POST['password']);
        
        $username = stripslashes($username);
        $password = stripslashes($password);
        
        $username = mysqli_real_escape_string($con, $username);
        $password = mysqli_real_escape_string($con, $password);

        // hashing
        $password = md5($password);
        // validation
        if(empty($username)){
            $arrError['username']= "required";
        }
        if(empty($password)){
            $arrError['password']= " required";
        }
        if(empty($arrError)){
            $strSql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
            if($rs = mysqli_query($con, $strSql)){
               if(mysqli_num_rows($rs) > 0){
                    $record = mysqli_fetch_array($rs);
                    $_SESSION['userLoggedIn'] = true;
                    $_SESSION['userData'] = $record;
                    header("location: index.php");
               }
               else{
                    echo "Invalid username/password";
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
    <form class="w-4/5 mx-auto bg-[#F9FAFB] border rounded py-8 h-screen " method="post">
        <div class="w-1/4 mx-auto border bg-white py-8 px-4 rounded space-y-4 hover:shadow-lg relative">
            <div class="space-y-1">
                <input type="text" name="username" invalid id="username" class="border rounded w-full py-4 px-4 focus:outline-sky-500 focus:border-sky-500 invalid:border-red-500 invalid:outline-red-400" placeholder="Username or Email">
            </div>
            <div class="space-y-1">
                <input type="password" name="password" invalid id="password" class="border rounded w-full py-4 px-4 focus:outline-sky-500 focus:border-sky-500 invalid:border-red-500 invalid:outline-red-400" placeholder="Password"> 
            </div>
            <button type="submit" name="login" class="py-2 w-full bg-blue-500 hover:bg-blue-600 text-white rounded font-semibold">Login</button>
        </div>
    </form>
</body>
</html>