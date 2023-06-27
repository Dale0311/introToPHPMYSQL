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
        <h1 class="text-3xl font-semibold text-center font-mono my-4">List of Enrolled Students</h1>
        <table class="table-auto rounded w-full">
            <thead class="bg-slate-500 rounded text-white">
                <tr class="">
                    <th class="py-2">Firstname</th>
                    <th class="py-2">Lastname</th>
                    <th class="py-2">Gender</th>
                    <th class="py-2">Birthday</th>
                    <th class="py-2">Course</th>
                </tr>
            </thead>
            <tbody class="font-semibold text-center">
                <?php  
                    require "./mysqlCon/openCon.php";
                    $strSql = "SELECT * FROM students WHERE lastname LIKE 'P%'";
                    if($rs = mysqli_query($con, $strSql));
                        if(mysqli_num_rows($rs) > 0){
                            while($rowPerson = mysqli_fetch_array($rs)){
                                echo 
                                    '
                                    <tr class="border rounded">
                                        <td class="py-2">'.$rowPerson['firstname'].'</td>
                                        <td class="py-2">'.$rowPerson['lastname'].'</td>
                                        <td class="py-2">'.$rowPerson['gender'].'</td>
                                        <td class="py-2">'.$rowPerson['birthday'].'</td>
                                        <td class="py-2">'.$rowPerson['course'].'</td>
                                    </tr> 
                                    ';
                                }
                            }
                        else{
                            echo "no record found";
                        }
                        
                    require "./mysqlCon/closeCon.php";
                ?>
                <!-- 
                    <tr class="border-2 border-gray-400 flex justify-center">
                        <td class="border border-gray-400 py-2">Dale</td>
                        <td class="border border-gray-400 py-2">Cabarle</td>
                        <td class="border border-gray-400 py-2">Male</td>
                        <td class="border border-gray-400 py-2">11/07/2001</td>
                        <td class="border border-gray-400 py-2">Scientist</td>
                    </tr> 
            -->

            </tbody>
        </table>
    </div>
</body>

</html>
