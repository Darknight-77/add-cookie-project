
<?php include('components/header.php'); ?>
<?php

    // Fetching data from the database (sql)
    $retrieve = "SELECT id, title, ingredients FROM cookies ORDER BY created_at";
    
    //quering the sql
    $result = mysqli_query($conn, $retrieve);

    $cookies = mysqli_fetch_all($result, MYSQLI_ASSOC);

    // Free results from memory, not always neccesary but for best practice
    mysqli_free_result($result);

    // close the connection to db
    mysqli_close($conn);

?>

<section>

    <h1 class="text-gray-600 text-center mt-5 mb-4 text-3xl">Cookies!</h1>

    <div class="flex flex-wrap w-xl m-auto gap-2">
        <?php foreach($cookies as $cookie): ?>
            <div class="relative w-3xs bg-white text-center rounded-xs hover:shadow-2xl">
                <img src="images/cookie-img.png" alt="cookie image" class="cookie-img">
                <!--htmlspecialchars to prevent xss attacks-->
                <h2 class="m-4 font-semibold text-slate-800"><?php echo htmlspecialchars($cookie['title']); ?></h2>
                <ul>
                    <!--exploding the cookies ingredients to show them as lists-->
                    <?php foreach(explode(',', $cookie['ingredients']) as $ing): ?>
                        <li><?php echo htmlspecialchars($ing) ?></li>
                    <?php endforeach; ?>
                </ul>

                <div class="border-t-1 border-red-100 p-2 text-right">
                    <a href="info.php?id=<?php echo htmlspecialchars($cookie['id']); ?>" class="text-red-300 font-semibold">More Info</a>
                </div>

            </div>
        <?php endforeach; ?>
        
    </div>
    
</section>


<?php include('components/footer.php'); ?>
    