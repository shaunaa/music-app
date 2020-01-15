<?php


if(isset($_POST['buyButton'])){

    $iban = cleanInput($_POST['iban']);
    $expDate = cleanInput($_POST['expDate']);
    $cvv = cleanInput($_POST['cvv']);
    
    $dateTime = date("Y-m-d h:i:sa");

    if($cardValidationClass->validateCard($iban,$expDate,$cvv)){
        
        $ifCardExistsQuery = $pdo->prepare("SELECT cardAndUserId FROM cards WHERE iban = ? AND userId = ?");
        $ifCardExistsQuery->execute([$iban, $userId]);
        $rows = $ifCardExistsQuery->fetchAll();
        $num_rows = count($rows);
        if($num_rows > 0){
      
            $pdo->beginTransaction();
            try{
                //update card
                $cardUpdateQuery = $pdo->prepare("UPDATE cards SET paidMoney=paidMoney+? WHERE iban=? AND userId=?");
                $cardUpdateQuery->execute([$songPrice, $iban,$userId]);
                //get cardAndUserId
                $cardAndUserId_get = $pdo->prepare("SELECT cardAndUserId FROM cards WHERE userId=? AND iban=?");
                $cardAndUserId_get->execute([$userId,$iban]);
                $aCardAndUserId = $cardAndUserId_get->fetchAll();

                foreach($aCardAndUserId as $result){
                    $cardAndUserId = $result['cardAndUserId'];

                    //PaymentProcedure
                    $paymentProcedure = $pdo->prepare("CALL insertIntoPayments(?,?,?,?)");
                    //$paymentProcedure->execute($cardAndUserId,$songId,$dateTime,$songPrice);
                    $paymentProcedure->bindParam(1, $cardAndUserId, PDO::PARAM_STR);
                    $paymentProcedure->bindParam(2, $songId, PDO::PARAM_STR);
                    $paymentProcedure->bindParam(3, $dateTime, PDO::PARAM_STR);
                    $paymentProcedure->bindParam(4, $songPrice, PDO::PARAM_STR);
                    $paymentProcedure->execute();

                    //Update user monetary ammount
                    $userMonetaryAmountQuery = $pdo->prepare("UPDATE users SET paidMoney=paidMoney+? WHERE id=?");
                    $userMonetaryAmountQuery->execute([$songPrice,$userId]);
                }
            
                if($pdo->commit()){
                    header("Location: download.php?songId=$songId&userId=$userId&iban=$iban");
                }
            }
            catch(PDOException $e){
                $pdo->rollBack();
            }
            
        }else{
            $pdo->beginTransaction();
            try{
                //insert into card
                $cardUpdateQuery = $pdo->prepare("INSERT INTO cards VALUES(?,?,?,?,?,?)");
                $cardUpdateQuery->execute(['',$iban,$expDate,$cvv,$songPrice,$userId]);
                //get cardAndUserId
                $cardAndUserId_get = $pdo->prepare("SELECT cardAndUserId FROM cards WHERE userId=? AND iban=?");
                $cardAndUserId_get->execute([$userId,$iban]);
                $aCardAndUserId = $cardAndUserId_get->fetchAll();

                foreach($aCardAndUserId as $result){
                    $cardAndUserId = $result['cardAndUserId'];

                    //PaymentProcedure
                    $paymentProcedure = $pdo->prepare("CALL insertIntoPayments(?,?,?,?)");
                    //$paymentProcedure->execute($cardAndUserId,$songId,$dateTime,$songPrice);
                    $paymentProcedure->bindParam(1, $cardAndUserId, PDO::PARAM_STR);
                    $paymentProcedure->bindParam(2, $songId, PDO::PARAM_STR);
                    $paymentProcedure->bindParam(3, $dateTime, PDO::PARAM_STR);
                    $paymentProcedure->bindParam(4, $songPrice, PDO::PARAM_STR);
                    $paymentProcedure->execute();

                    //Update user monetary ammount
                    $userMonetaryAmountQuery = $pdo->prepare("UPDATE users SET paidMoney=paidMoney+? WHERE id=?");
                    $userMonetaryAmountQuery->execute([$songPrice,$userId]);
                }
            
                if($pdo->commit()){
                    header("Location: download.php?songId=$songId&userId=$userId&iban=$iban");
                }
            }
            catch(PDOException $e){
                $pdo->rollBack();
            }
     
        }
    }else{
        echo 'card validation failed';
    }
}

function cleanInput($input){
    $inputValue = strip_tags($input);

    return $inputValue;
}
