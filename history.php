<?php
    define("filepath", "data.json");
    $fileData = read();
    $fileExplode = explode("\n", $fileData);
    $c = count($fileExplode) - 1;
    function read() 
    {
        $fo = fopen(filepath, "r");
        $fs = filesize(filepath);
        $fr = "";
        if ($fs > 0)
        {
            $fr = fread($fo,$fs);
        }
        fclose($fo);
        return $fr;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>History</title>
</head>
<body>
    <h1>Page 2 [Transaction History]</h1>
    <h2>Digital Wallet</h2>
    <form action="action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST"">
        1. <a href="home.php">Home</a>
        2. <a href="history.php">Transaction History</a>
        <br><br>
        <span><b>Total Records: (<?php echo $c;?>)</b></span>
        <br><br>
    </form>

    <?php
        echo "<table border =1px solid black;>";
        echo "<tr>";
        echo "<th>" . "Transaction Category" . "</th>";
        echo "<th>" . "To" . "</th>";
        echo "<th>" . "Amount" . "</th>";
        echo "</tr>";

        for ($i = 0; $i < $c; $i++)
        {
            echo "<tr>";
            $info = json_decode($fileExplode[$i]);
            echo "<td>" . $info->TransactionCategory . "</td>";
            echo "<td>" . $info->To . "</td>";
            echo "<td>" . $info->Amount . "</td>";
            echo "</tr>";
        }
        
        echo "</table>";
    ?>
    
</body>
</html>