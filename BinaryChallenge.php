<html lang="en-GB">
    <head>
        <meta charset="utf-8">
        <title>Fence Length Calculator</title>
    </head>

    <body>


    <form method="get">
        <label for="postNumber">Number of Posts: </label>
        <input type="number" name="postNumber" id="postNumber">
        <br>
        <label for="railNumber">Number of Railings: </label>
        <input type="number" name="railNumber" id="railNumber">
        <br>
        <label for="targetLength">Desired Fence Length: </label>
        <input type="number" step="0.1" name="targetLength" id="targetLength">m
        <br>
        <input type="submit" name="Submit">
    </form>

        <?php

        require_once 'includes.php';

        if (isset($_GET['postNumber']) || isset($_GET['railNumber']) || isset($_GET['targetLength'])) { 
           
            $postNumber = $_GET['postNumber'];

            if ($postNumber > 0) {
                $railNumber = $postNumber - 1;
                $fenceLength = postsAndRailingsToLength($postNumber, $railNumber, $railingLength, $postLength);
                echo 'A fence with ' . $postNumber . ' posts will have ' . $railNumber . ' railings and will be ' . $fenceLength . ' metres Long<br><br>';
            }

            $railNumber = $_GET['railNumber'];

            if ($railNumber > 0) {
                $postNumber = $railNumber + 1;
                $fenceLength = postsAndRailingsToLength($postNumber, $railNumber, $railingLength, $postLength);
                echo 'A fence with ' . $railNumber . ' railings will have ' . $postNumber . ' posts and will be ' . $fenceLength . ' metres Long<br><br>';
            }

            $targetLength = $_GET['targetLength'];

            if ($targetLength > 0) {
                $fenceData = lengthToPostsAndRailings($targetLength, $railingLength, $postLength);
                echo 'In order to make a fence at least ' . $targetLength . ' metres long, you will need ' . $fenceData['Railings'] . ' railings and ' . $fenceData['Posts'] . ' posts';
            }
        }

        ?>

    </body>
</html>
