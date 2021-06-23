<?php
    define("filepath", "data.json");
    $category = $to = $amount = "";
    $categoryErr = $toErr = $amountErr = "";
    $toNumberErr = "";
    $amountNegative = "";
    $sMessage = $eMessage = "";
    $flag = true;
    if($_SERVER['REQUEST_METHOD'] === "POST")
    {
        $category = test_input($_POST["category"]);
        $to = test_input($_POST["to"]);
        $amount = test_input($_POST["amount"]);
        if (empty($category))
        {
            $CategoryErr = "Category Cannot Be Empty!";
            $flag = false;
        }
        if (empty($to))
        {
            $toErr = "Please write mobile number!";
            $flag = false;
        }
        if (strlen($to) != 11)
        {
            $toNumberErr = "Number is not valid";
            $flag = false;
        }
        if (empty($amount) or $amount==0)
        {
            $amountErr = "Amount Cannot Be Empty!";
            $flag = false;
        }
        if ($amount < 0)
        {
            $amountNegative = "Amount Cannot Be Negative";
            $flag = false;
        }

        if ($flag == true)
        {
            $data = array("TransactionCategory"=>$category, "To"=>$to, "Amount"=>$amount);
            $data_encode = json_encode($data);
            $result = write($data_encode);
            if ($result)
            {
                $sMessage = "Successfully Submitted!";

            }   
            else
            {
                $eMessage = "Erroe While Saving Data!";
            }

        }

    }

    function write($content) {
        $resource = fopen(filepath, "a");
        $fw = fwrite($resource, $content . "\n");
        fclose($resource);
        return $fw;
}



    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>
<body>
    <h1>Page 1 [Home]</h1>
    <h2>Digital Wallet</h2>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
        1. <a href="home.php">Home</a>
        2. <a href="history.php">Transaction History</a>
        <br><br>
        <h2>Fund Transfer: </h2>
        <br>
        <label for="category">Select Category: </label>
        <select name="category" id="category">
            <option value="">Select An Option</option>
            <option value="mobile_recharge">Mobile Recharge</option>
            <option value="send_money">Send Money</option>
            <option value="merchant_pay">Merchant Pay</option>
        </select>
        <span style="color: red;"><?php echo $categoryErr;?></span>
        <br><br>

        <label for="to">To: </label>
        <input type="text" id="to" name="to" value="<?php echo $to;?>"> <span style="color: red;"><?php echo $toErr;?></span> <span style="color: red;"><?php echo $toNumberErr;?></span>
        <br><br>
        <label for="amount">Amount: </label>
        <input type="number" id="amount" name="amount" value="<?php echo $amount;?>"> <span style="color: red;"><?php echo $amountErr;?></span> <span style="color: red;"><?php echo $amountNegative;?></span>

        <br><br>
        <input type="submit" name="submit" value="Submit">
    </form>
    <span style="color: green;"><?php echo $sMessage;?></span>
    <span style="color: red;"><?php echo $eMessage;?></span>

</body>
</html>