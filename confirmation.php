<?php 
    session_start();
    if(!isset($_SESSION['fromSignUp'])){
        header("location: .");
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./output.css">
</head>
<body>
    <div class="container mx-auto">
        <h1 class="text-3xl font-semibold my-4">You're succesfully enrolled</h1>
        <a href="." class="py-2 px-4 text-center rounded bg-green-500 text-white">enroll another</a>
        <a href="officialList.php" class="py-2 px-4 text-center rounded bg-slate-500 text-white">Go to official list</a>
    </div>
</body>
</html>