<?php session_start() ?>
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
        <table class="table table-auto rounded w-full my-2">
            <thead class="bg-gray-500 rounded text-white">
                <tr class="">
                    <th class="py-2">Firstname</th>
                    <th class="py-2">Lastname</th>
                    <th class="py-2">Birthday</th>
                    <th class="py-2">Gender</th>
                    <th class="py-2">Course</th>
                    <th class="py-2">Action</th>
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
                            $bgnum = 1;
                            while($rowPerson = mysqli_fetch_array($rs)){
                                $bgColor = $bgnum % 2 == 0? "bg-gray-100": "";
                                echo 
                                    '
                                    <tr class="border rounded '.$bgColor.' hover:bg-gray-200">
                                        <td class="py-2">'.$rowPerson['firstname'].'</td>
                                        <td class="py-2">'.$rowPerson['lastname'].'</td>
                                        <td class="py-2">'.$rowPerson['birthday'].'</td>
                                        <td class="py-2">'.$rowPerson['sex'].'</td>
                                        <td class="py-2">'.$rowPerson['course'].'</td>
                                        <td class="py-2 flex justify-center space-x-4 text-xl">
                                            <a href="update.php?k='.$rowPerson['id'].'" ><i class="fa-solid fa-pen-to-square" style="color: #0f4fbd;" title="Edit Value"></i></a>
                                            <a href="delete.php?k='.$rowPerson['id'].'" ><i class="fa-solid fa-trash" style="color: #d13333;"></i></a>
                                        </td>
                                    </tr> 
                                    ';
                                $bgnum++;
                                }
                            }
                        else{
                            echo 
                                    '<tr class="">
                                        <th>No Record Found</th>
                                    </tr>
                                    ';
                        }
                        
                    require "./mysqlCon/closeCon.php";
                ?>
            </tbody>
        </table>
        <div class="flex justify-end py-2">
            <a href="." class="bg-green-500 py-2 rounded px-4 text-white hover:bg-green-600">Enroll Another Student</a>
        </div>
    </div>
</body>

</html>
