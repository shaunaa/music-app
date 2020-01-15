<?php

class CardValidation{
    public $errorArray;
    public $pdo;

    public function __construct($pdo)
    {
        $this->errorArray = array();
        $this->pdo = $pdo;
    }

    public function validateCard($iban,$expDate,$cvv){
        $this->validateIban($iban);
        $this->validateExpDate($expDate);
        $this->validateCvv($cvv);

        if(empty($this->errorArray)){
            return true;
        }
        
    }

    private function validateIban($iban){
        $ibanPattern = '/^[dk]{2}[\d]{16}$/';
        if(!preg_match($ibanPattern,$iban)){
            array_push($this->errorArray,'The iban code shoudl start with DK followed by 16 digits');
            return;
        }
    }

    private function validateExpDate($expDate){
        $datePattern = '/^[\d]{2}[\/]{1}[\d]{2}$/';
        if(!preg_match($datePattern,$expDate)){
            array_push($this->errorArray,'The expiration date should be in this format 11/11');
            return;
        }
    }

    private function validateCvv($cvv){
        $cvvPattern = '/^[\d]{3}$/';
        if(!preg_match($cvvPattern,$cvv)){
            array_push($this->errorArray,'The cvv code is only 3 digits.');
            return;
        }
    }
}



?>