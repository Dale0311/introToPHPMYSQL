<?php session_start() ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="output.css">
</head>

<body>
    <div class="container mx-auto my-4">
        <h1 class="text-3xl font-semibold text-center font-mono my-4">List Of Enrolled Students</h1>
        <form method="get" class="my-4 space-x-2 w-full flex justify-end items-center">
            <label for="query" class="font-semibold">Search:</label>
            <input type="text" name="query" id="query" placeholder="lastname.." class="py-2 px-4 border">
            <label for="sort" class="font-semibold">Sort By:</label>
            <select type="text" name="sort" id="sort" class="py-2 px-4 border rounded">
                <option value="">Default</option>
                <option value="firstname">firstname</option>
                <option value="lastname">lastname</option>
                <option value="birthday">birthday</option>
                <option value="sex">gender</option>
                <option value="course">course</option>
            </select>
            <button type="submit" name="submit" class="bg-slate-500 hover:bg-slate-600 py-2 px-4 rounded text-white">Filter</button>
        </form>
        <table class="table-auto rounded w-full my-2">
            <thead class="bg-slate-500 rounded text-white">
                <tr class="">
                    <th class="py-2">Firstname</th>
                    <th class="py-2">Lastname</th>
                    <th class="py-2">Birthday</th>
                    <th class="py-2">Gender</th>
                    <th class="py-2">Course</th>
                </tr>
            </thead>
            <tbody class="font-semibold text-center">
                <?php  
                    require "./mysqlCon/openCon.php";
                    $strSql = "SELECT * FROM students";
                    $tempQuery = "";
                    $tempSort= "";
                    if(isset($_GET['submit'])){
                        if(isset($_GET['query'])){
                            if($_GET['query']){
                                $tempQuery = $_GET['query'];
                                $tempStr = $strSql. ' WHERE lastname LIKE '. '"%' . $tempQuery . '%"'; 
                                $strSql = $tempStr; 
                            }
                        }
                        if(isset($_GET['sort'])){
                            if($_GET['sort']){
                                $tempSort = $_GET['sort'];
                                $tempStr = $strSql. ' ORDER BY '. $tempSort;
                                $strSql = $tempStr;
                            }
                        }
                        $_SESSION['tempquery'] = $tempQuery;
                    }
                    if($rs = mysqli_query($con, $strSql));
                        if(mysqli_num_rows($rs) > 0){
                            while($rowPerson = mysqli_fetch_array($rs)){
                                echo 
                                    '
                                    <tr class="border rounded">
                                        <td class="py-2">'.$rowPerson['firstname'].'</td>
                                        <td class="py-2">'.$rowPerson['lastname'].'</td>
                                        <td class="py-2">'.$rowPerson['birthday'].'</td>
                                        <td class="py-2">'.$rowPerson['sex'].'</td>
                                        <td class="py-2">'.$rowPerson['course'].'</td>
                                    </tr> 
                                    ';
                                }
                            }
                        else{
                            echo 
                                    '
                                    <th class="py-2">No Record Found</th>
                                    ';
                        }
                        
                    require "./mysqlCon/closeCon.php";
                ?>
            </tbody>
        </table>
        <div class="flex justify-end py-2 border">
            <a href="." class="bg-green-500 py-2 rounded px-4 text-white hover:bg-green-600">Enroll Another Student</a>
        </div>
    </div>
</body>

</html>
