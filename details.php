<?php

    include('config/db_connect.php');

    if(isset($_POST['delete'])) {

        $id_to_delete = mysqli_real_escape_string($conn, $_POST['id_to_delete']);

        $sql = "DELETE FROM pizzas WHERE id = $id_to_delete";

        //for edit: "UPDATE pizzas SET title = 'new title', ingredients = 'new ingredients' WHERE id = $id_to_delete"

        if(mysqli_query($conn, $sql)) {
            header('Location: index.php');
        } else {
            echo 'query error: ' . mysqli_error($conn);
        }

    }

    // check GET request if param
    if(isset($_GET['id'])) {

        $id = mysqli_real_escape_string($conn, $_GET['id']);

        // make sql
        $sql = "SELECT * FROM pizzas WHERE id = $id";

        //get the query results
        $result = mysqli_query($conn, $sql);

        //fetch result in array format
        $pizza = mysqli_fetch_assoc($result);

        //CLEAN UP

        //free the results for memory
        mysqli_free_result($result);

        //close connection to database
        mysqli_close($conn);

    }

?>

<!DOCTYPE html>
<html lang="en">

    <?php include('templates/header.php'); ?>
    
    <div class="container center grey-text">
        <?php if($pizza): ?>

            <h4><?php echo htmlspecialchars($pizza['title']); ?></h4>
            <p>Created by: <?php echo htmlspecialchars($pizza['email']); ?></p>
            <p><?php echo date($pizza['created_at']); ?></p>
            <h5>Ingredients:</h5>
            <p><?php echo htmlspecialchars($pizza['ingredients']); ?></p>

            <!-- DELETE FORM -->
            <form action="details.php" method="POST">
                <input type="hidden" name="id_to_delete" value="<?php echo $pizza['id']; ?>">
                <input type="submit" name="delete" value="DELETE" class="btn brand z-depth-0">
            </form>

        <?php else: ?>

            <h5>No such pizza exist!</h5>

        <?php endif; ?>
    </div>

    <?php include('templates/footer.php'); ?>

</html>