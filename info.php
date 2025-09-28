<?php include('components/header.php'); ?>

<?php

    // check GET request param
    if(isset($_GET['id'])){
        $passed_id = mysqli_real_escape_string($conn, $_GET['id']);

        // query to db
        $sql = "SELECT * FROM cookies WHERE id=$passed_id";

        // fetch the query 
        $result = mysqli_query($conn, $sql);

        // fetch the results in array format
        $cookie = mysqli_fetch_assoc($result);

        mysqli_free_result($result);
        mysqli_close($conn);
    }


?>

<div class="w-xl mt-5 m-auto gap-2 border-2 border-red-300 p-7 rounded shadow-xl/30 text-center">

    <?php if($cookie): ?>
        <h2  class="font-semibold text-slate-800 text-xl">Cookie Title: <span class="text-blue-500"><?php echo htmlspecialchars($cookie['title']); ?></span></h2>
        <small class="text-right font-sm mb-5">Created by: <?php echo htmlspecialchars($cookie['email']); ?></small>
        <h3 class="mt-2 font-semibold">Ingredients:</h3>
        <ul>
            <?php foreach(explode(',', $cookie['ingredients'] )as $ing): ?>
                <li><?php echo htmlspecialchars($ing); ?></li>
            <?php endforeach; ?>
        </ul>
        <small class="text-right font-sm">Date uploaded: <?php echo htmlspecialchars($cookie['created_at']); ?></small>
    <?php else: ?>
        <h2 class="text-red-800 font-xl">No such cookie exists!</h2>
    <?php endif; ?>

</div>

<?php include('components/footer.php'); ?>