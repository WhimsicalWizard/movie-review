<?php
include_once("dbcon.php");
include_once("header.html");
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}
if (isset($_GET['id'])) {
    $movieId = $_GET['id'];

    $sql = "SELECT * FROM movie WHERE movie_id = $movieId";
    $result = mysqli_query($con, $sql);

    

    $row = mysqli_fetch_assoc($result);
} else {
    $con->close();

    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Movie</title>

    <style>
        body {
            background-color: #042425;
    color: #ffffff;
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;


        h1 {
            text-align: center;
            margin-top: 20px;
        }

        img {
            max-width: 100%;
            max-height: 200px;
            padding: 10px;
            width: auto;
            height: auto;
            margin: 0 auto;
            display: block;
        }

        .real {
            padding: 20px;
            border-radius: 5px;
            background-color: #040f25;
            box-shadow: 0 0 5px rgba(200, 255, 100, 0.21);
            width: 40%;
            margin: 10px auto;

        }
        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        input[type="text"] {
            width: 98%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 10px;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>

</head>

<body>
    <h1>Edit Movie</h1>
    <div class="real">
    <img src="<?php echo "../image/" . $row['img_name'] ?>" alt="idk">
    <form action="update.php" method="post" onsubmit="return validate()">
        <input type="hidden" name="movie_id" value="<?php echo $row['movie_id']; ?>">
        <label>Movie Name</label>
        <input type="text" name="name" value="<?php echo $row['movie_name']; ?>" required><br>
        <label>Released Year</label>
        <input type="text" id="year" name="year" value="<?php echo $row['released']; ?>" required><br>
        <p id="year_error"></p>
        <label>Available</label>
        <input type="text" id="available" name="available" value="<?php echo $row['about_movie']; ?>" required><br>
        <p id="disk_error"></p>

        <label>Genre</label>
        <select name="genre">
            <option value="<?php echo $row['genre']; ?>"><?php echo $row['genre']; ?></option>
        </select>
        <input type="submit" value="Update" name="submit">
    </form>
    </div>
    <script>
        function validate() {
            const year = document.getElementById("year").value;

            const available = document.getElementById("available").value;
            var b_year = yearVal(year);
            var b_available = diskVal(available);

            if (!(b_available && b_year)) {
                return false;
            } else {
                return true;
            }
        }

        function yearVal(year) {
            if (isNaN(year)) {
                document.getElementById("year_error").innerHTML = "Year must be a number";
                return false;

            } else if (year.length != 4) {
                document.getElementById("year_error").innerHTML = "Year must of 4 digit";
                return false;

            } else {
                document.getElementById("year_error").innerHTML = "";
                return true;
            }
        }

      
    </script>

</body>

</html>