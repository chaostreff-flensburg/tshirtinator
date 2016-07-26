<?php
session_start();
//check if item has been added before last refresh
if(time() - $_SESSION['lastAdded'] < 3) {
    echo "<b>Order added!</b>";
}
//buffer all html output
ob_start();

//check if user is already logged in
if($_SESSION['loggedIn'] == true) {
    displayForms();
} else {
    //create sign-in form
    echo '<div id="Sign-In">
        <fieldset style="width:30%"><legend>Login</legend>
            <form method="POST" action="">
                User <br><input type="text" name="user" size="40" autofocus="true" required="true"><br>
                Password <br><input type="password" name="pass" size="40" required="true"><br>
                <input type="submit" name="submit" value="Log-In">
            </form>
        </fieldset>
    </div>';
}

//display orders
$orders = getOrders();
$orderHTML = "<ul>";
foreach($orders as $order) {
    $status = ($order['status'] == 1 ? "true" : "false");
    $orderHTML .= "<li>Order Number: $order[orderNumber] Status: $status Motive: $order[motive]</li>";
}
$orderHTML .= "<ul>";

echo $orderHTML;

//start login
if(isset($_POST['submit']))
{
    if($_POST["user"] == "user" && $_POST["pass"] == "pass") {
        //login successful, save login
        $_SESSION['loggedIn'] = true;
        displayForms();
    } else {
        echo "Login failed!";
    }
}

function displayForms() {
     //clean page
        ob_get_clean();
        //add order form
        echo '<fieldset><legend>Create order</legend>
            <form method="POST" action="">
                Order-Nummer: <input type="text" name="ordernumber" autofocus="true" required="true">
                <br>Motive: <input type="text" name="motive">
                <br>Status: <select name="statusAdd[]"><option value="1">Finished</option><option value="0">Not finished</option></select>
                <br><input type="submit" name="addButton" value="Bestätigen">
            </form>
        </fieldset>';
        //set order status form
        echo '<fieldset><legend>Set order status</legend>
            <form method="POST" action="">
                Order-Number: <input type="text" name="ordernumber2" required="true">
                <br>Status: <select name="status[]"><option value="1">Finished</option><option value="0">Not finished</option></select>
                <br><input type="submit" name="setButton" value="Bestätigen">
            </form>
        </fieldset>';
}

//check scan input
if(isset($_POST['addButton']))
{
    if(isset($_POST['ordernumber']) && !empty($_POST['ordernumber'])) {
        //write order as successful
        if(addOrder($_POST['ordernumber'], $_POST["motive"], $_POST["statusAdd"][0])){
            //write current time
            $_SESSION['lastAdded'] = time();
            //refresh page
            header("Refresh:0");
        } else {
            echo $res;
        }
    }
}

//check finish input
if(isset($_POST['setButton']))
{
    if(isset($_POST['ordernumber2']) && !empty($_POST['ordernumber2'])) {
        //set order state
        if($res = setOrder($_POST['ordernumber2'], $_POST["status"][0])){
            //write current time
            $_SESSION['lastAdded'] = time();
            //refresh page
            //header("Refresh:0");
        } else {
            echo $res;
        }
    }
}

    function setOrder($nr, $status) {
        //establish connection
        $con = new mysqli(getenv('IP'), getenv('C9_USER'), "", "c9") or die("Failed to connect to MySQL: " . mysql_error());
        //insert new order
        $res = $con->query("UPDATE Orders SET status = $status WHERE orderNumber = $nr");
        //return result
        return $res;
    }

function addOrder($nr, $motive = NULL, $status) {
        //establish connection
        $con = new mysqli(getenv('IP'), getenv('C9_USER'), "", "c9") or die("Failed to connect to MySQL: " . mysql_error());
        //insert new order
        $res = $con->query("INSERT INTO Orders VALUES($nr, $status, '$motive')");
        //return result
        return $res;
    }

    function getOrders() {
        //establish connection
        $con = new mysqli(getenv('IP'), getenv('C9_USER'), "", "c9") or die("Failed to connect to MySQL: " . mysql_error());
        //search order
        $res = $con->query("SELECT * FROM Orders");
        $row = resultToArray($res);
        //return result
        return $row;
    }

    //put all rows of the result in an array
    function resultToArray($result) {
        $rows = array();
        while($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }
        return $rows;
    }
?>
