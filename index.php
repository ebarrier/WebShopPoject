<?php
include "header.php";
require_once "config.php";
include "dbconn.php";
?>

<div class="header row">
    <div class="col-2">&nbsp;</div>
    <h1 class="col-8">Etienne's webshop</h1>

    <?php
    if (array_key_exists("userid", $_SESSION) && $_SESSION["userid"] != NULL) {
        //If the $_SESSION["userid"] is set we say hello with his name
        //var_dump($_SESSION["userid"]); //This is just to show the content of $_SESSION variable
        $results = $conn->query("
            SELECT * 
            FROM user 
            WHERE id = " . $_SESSION["userid"]);
        $row = $results->fetch(PDO::FETCH_ASSOC);?>
        <div class="greeting col-1">
            <p>Hello <?=$row["fname"]?></p>
        </div>
        <div class="logOut col-1">
            <p><a href="logout.php">Sign out</a></p>
        </div>
    </div> <!--header row finishes here-->
    <div class="menu row">
        <ul class="menu">
            <li class="menu col-2"><a href=#></a>&nbsp;</li>
            <li class="menu col-2"><a href="profile.php">My profile</a></li>
            <li class="menu col-2"><a href="orders.php">My orders</a></li>
            <li class="menu col-2"><a href="cart.php">My cart</a></li>
            <li class="menu col-2"><a href="contact.php">Contact</a></li>
            <li class="menu col-2"><a href=#></a>&nbsp;</li>
        </ul>
    </div>
    <?php
    } else { //else we display the login page
        ?>
        <div class="loginButton col-1">
            <a href=# onclick="showLogin(); return false;">Log in</a>
            <div class="loginPanel" id="loginPanel" style="display:none">
                <form action="login.php" onclick="showAlways(); return false;" method="post">
                    <input type="text" name="username/email" placeholder="username or email" required/>
                    <input type="password" name="password" placeholder="password" required/>
                    <input id="loginPanelSubmit" type="submit" value="Log in!"/>
                </form>
            </div>
        </div>
        <div class="registration col-1">
            <p><a href="registration.php"> Sign up</a></p>
        </div>
    </div> <!--header row finishes here-->
    
    <div class="menu row">
        <ul class="menu">
            <li class="menu col-4"><a href=#></a>&nbsp;</li>
            <li class="menu col-2"><a href="cart.php">My cart</a></li>
            <li class="menu col-2"><a href="contact.php">Contact</a></li>
            <li class="menu col-4"><a href=#></a>&nbsp;</li>
        </ul>
    </div>
    <?php 
    } ?>

<h2>The best smartphones of the year</h2>

<?php 
$statement = $conn->prepare("
    SELECT id, name, price, hash 
    FROM product");
//$result = $conn->query("SELECT id, name, price FROM product");
$statement->execute();
while ($row = $statement->fetch(PDO::FETCH_ASSOC)) { ?>
    <div class="responsive">
        <div class="img">
            <a target="_blank" href="uploads/<?=$row['hash']?>">
              <img src="small/<?=$row['hash']?>" alt="<?=$row["name"]?>" width="300" height="200">
            </a>
            <div class="desc">
                <a href="description.php?id=<?=$row["id"]?>"><?=$row["name"]?></a><span> - <?=$row["price"]?>eur</span>
            </div>
        </div>
    </div>
<?php
}
?>
<div class="clearfix"></div>

<script src="js/myJS.js"></script>
<?php
include "footer.php";
?>
