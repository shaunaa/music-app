<?php
    include ("includes/header.php");
    include("includes/classes/Song.php");
    include("includes/classes/CardValidation.php");
    $cardValidationClass = new CardValidation($pdo);   

    if(isset($_GET['id'])){
        $songId = $_GET['id'];
        $songClass = new Song($pdo, $songId); 
        $songPrice = $songClass->getPrice();

        include("includes/apis/api-buy.php");
    }else{
        header('Location: index.php');
    }

?>

<form method="post">
<div class="errorMessage">
            <?php if(!empty($cardValidationClass->errorArray)){
                        echo $cardValidationClass->errorArray[0];
                    } 
            ?>
        </div>
   <p>
    <label>card iban</label>
    <input type="text" name="iban" placeholder="iban code">
   </p>

   <p>
       <label>expiration date</label>
       <input type="text" name="expDate">
   </p>

   <p>
       <label>CVV</label>
       <input type="text" name="cvv">
   </p>
   <input type="submit" name="buyButton" value="buy">
</form>