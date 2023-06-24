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
        <form method="post" class="w-1/2 mx-auto space-y-4">
            <!-- firstname -->
            <div class="text-xl">
                <label for="firstname" class="block text-black">
                    Firstname:
                </label>
                <input type="text" id="firstname" name="firstname" class="py-2 px-4 border border-black focus:outline-none focus:border-2 focus:border-sky-400 focus:shadow-md focus:shadow-sky-200 required:bg-red-500 w-full rounded">
            </div>
            <!-- lastname -->
            <div class="text-xl">
                <label for="lastname" class="block text-black">
                    Lastname:
                </label>
                <input type="text" id="lastname" name="lastname" class="py-2 px-4 border border-black focus:outline-none focus:border-2 focus:border-sky-400 focus:shadow-md focus:shadow-sky-200 required:bg-red-500 w-full rounded">
            </div>
            <!-- gender -->
            <div class="text-xl">
                <label for="sex" class="block text-black">
                    Sex:
                </label>
                <select name="sex" id="sex" class="w-full py-2 px-4 border border-black focus:outline-none focus:border-2 focus:border-sky-400 focus:shadow-md focus:shadow-sky-200 required:bg-red-500 rounded">
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select>
            </div>
            <!-- birthday -->
            <div class="text-xl">
                <label for="birthday" class="block text-black">
                    Birthday:
                </label>
                <input type="date" id="birthday" name="birthday" class="py-2 px-4 border border-black focus:outline-none focus:border-2 focus:border-sky-400 focus:shadow-md focus:shadow-sky-200 required:bg-red-500 w-full rounded">
            </div>
            <!-- course -->
            <div class="text-xl">
                <label for="course" class="block text-black">
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
                <button type="submit" class="bg-green-500 py-2 rounded w-full text-white hover:bg-green-600">
                    Submit
                </button>
            </div>
        </form>
    </h1>
</body>
</html>