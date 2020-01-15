<?php
    include ("includes/header.php");

    if(isset($_GET['songId'])){
        $songId = $_GET['songId'];
        $userId = $_GET['userId'];
        $iban = $_GET['iban'];

        $cardAndUserId_get = $pdo->prepare("SELECT cardAndUserId FROM cards WHERE userId=? AND iban=?");
        $cardAndUserId_get->execute([$userId,$iban]);
        $result = $cardAndUserId_get->fetchAll();
        foreach($result as $row){
            $cardAndUserId = $row['cardAndUserId'];
            
            $checkIfPaymentExistsQuery = $pdo->prepare("SELECT * FROM payments WHERE cardAndUserId=? AND songId=?");
            $checkIfPaymentExistsQuery->execute([$cardAndUserId,$songId]);
            $rows = $checkIfPaymentExistsQuery->fetchAll();
            $num_rows = count($rows);
            if($num_rows > 0){
                $selectSongQuery = $pdo->prepare("SELECT * FROM songs WHERE id=?");
                $selectSongQuery->execute([$songId]);
                $songQueryArray = $selectSongQuery->fetchAll();

                foreach($songQueryArray as $song){
                    $fileName = $song['songFile'];
                    $filePath = 'includes/songs/'.$fileName;
                    $fileType = filetype($filePath);
                    $fileBasename = basename($filePath);

                    if(file_exists($filePath)){
                        header("Content-Type: ".$fileType);
                        header("Content-Length: ".filesize($filePath));
                        header("Content-Disposition: attachment; filename=".$fileBasename);
                        readfile($filePath);
                    }else{
                        header("Location: index.php");
                    }
                }
            }else{
                header("Location: index.php");
            }
        }
    
    }else{
       header("Location: index.php");
    }

    ?>