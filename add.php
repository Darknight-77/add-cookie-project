<?php
    include('db_connection.php');

    $email = '';
    $title = '';
    $ingredients = '';

    $errors = array('email'=>'', 'title'=>'', 'ingredients'=>'');

    if (isset($_POST['submit'])) {
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $title = mysqli_real_escape_string($conn, $_POST['title']);
        $ingredients = mysqli_real_escape_string($conn, $_POST['ingredients']);

        //  Validation - check that all fields arent empty with the php empty function
        if (empty($email) ) {
            $errors['email'] = "An email is required";
        } else {
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
                $errors['email'] = 'Email must be a valid email address';
            }
        }
        if (empty($title)) {
            $errors['title'] = "A title is required";
        } else {
            if(!preg_match('/^[a-zA-Z\s]+$/', $title)){
                $errors['title'] = 'Title must be letters and spaces only';
            }
        }
        if (empty($ingredients)) {
            $errors['ingredients'] = "An ingredients is required";
        } else {
            if(!preg_match('/^([a-zA-Z\s]+)(,\s*[a-zA-Z\s]*)*$/', $ingredients)) {
                $errors['ingredients'] = "Must be a comma seperated list only";
            }
        }

        if (array_filter($errors)){

        } else{
            // Query to database
            $sql = "INSERT INTO cookies(email, title, ingredients) VALUES('$email', '$title', '$ingredients')";

            //save to the database
            if(mysqli_query($conn, $sql)){
                header('location: index.php');
            } else {
                echo "query error: " . mysqli_error($conn);
            }
        }

    }   // End of post check


?>

<?php include('components/header.php'); ?>


<section class="">
    <h1 class="text-gray-600 text-center mt-5 mb-4 text-3xl">Add a Cookie</h1>

    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" class="bg-white m-auto max-w-xl p-3">
        <div class=" mb-2">
            <label for="email" class="block mb-2 text-gray-700">Enter Email</label>
            <input type="text" name="email" value="<?php echo htmlspecialchars($email) ?>" class="d-block w-full border-b outline-none">
            <div class="text-red-600 text-sm"><?php echo $errors['email']; ?></div>
        </div>

        <div class=" mb-2">
            <label for="title" class="block mb-2 text-gray-700">Cookie Title</label>
            <input type="text" name="title" value="<?php echo htmlspecialchars($title) ?>" class="d-block w-full border-b outline-none">
            <div class="text-red-600 text-sm"><?php echo $errors['title']; ?></div>
        </div>

        <div class=" mb-2">
            <label for="ingredients" class="block mb-2 text-gray-700">Ingredients (comma seperated)</label>
            <input type="text" name="ingredients" value="<?php echo htmlspecialchars($ingredients) ?>" class="d-block w-full border-b outline-none">
            <div class="text-red-600 text-sm"><?php echo $errors['ingredients']; ?></div>
        </div>

        <div class="flex align-center">
            <button type="submit" name="submit" class="bg-red-300 text-white font-medium py-2 p-4 m-auto">SUBMIT</button>
        </div>
    </form>
</section>


<?php include('components/footer.php'); ?>