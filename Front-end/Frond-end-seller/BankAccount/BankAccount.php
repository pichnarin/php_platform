<?php

class BankAccount {
    public $accountNumber;
    public $accountName;
    public $accountType;
    private $balance = 0; 

    public function __construct($accountNumber, $accountName, $accountType) {
        $this->accountNumber = $accountNumber;
        $this->accountName = $accountName;
        $this->accountType = $accountType;
    }
    //I made this cause balance is private so it's hard to manage balance 
    public function setBalance($balance){
        $this->balance = $balance;
    }

    //for the base class I just check if the account is correct and do simple deposit and keep most handling in sub class
    public function depositFund($balance, $accountNumber) {
        if ($this->accountNumber === $accountNumber) {
            $this->balance += $balance;
            echo $balance . " has been deposited."."<br>";
        } else {
            echo "Account not found.";
        }
    }

    // same thing here simple and most handling in sub class
    public function withdrawFund($balance, $accountNumber) {
        if ($this->accountNumber === $accountNumber) {
                $this->balance -= $balance;
                return $balance;
        } else {
            echo "Account not found.";
        }
    }

    // simple handling cause this function is only to check the balance 
    public function checkBalance($accountNumber) {
        if ($this->accountNumber === $accountNumber) {
            return $this->balance;
        } else {
            echo "Account not found";
        }
    }

    //i just display the main detail of the account 
    public function displayDetail() {
        echo "Account Number: " . $this->accountNumber . "<br>";
        echo "Account Name: " . $this->accountName . "<br>";
        echo "Account Type: " . $this->accountType . "<br>";
        echo "Balance: " . $this->balance . "<br>";
    }
}

//this class is for general deposit account so it's the basic bank account but with validation and handling 
class DepositAccount extends BankAccount{
    public function depositFund($balance, $accountNumber)
    {
        if($balance > 0){
            parent::depositFund($balance,$accountNumber);
        }
        else{
            echo "You can only deposit positive balance." . "<br>";
        }
    }
    public function withdrawFund($balance, $accountNumber)
    {
        if(parent::checkBalance($accountNumber) >= $balance AND $balance > 0){
             parent::withdrawFund($balance,$accountNumber);
        }
        else{
            echo "Insufficient balance or withdraw amount need to be positive." . "<br>";
        }
    }
     
}

//this is just normal account but with feature like overdraft which can let you withdraw even when you have incifficient amount in the bank but it will
// charge you back with interest
class CheckingAccount extends BankAccount {
    private $fee = 0;
    
    public function withdrawFund($balance, $accountNumber) {
        if ($this->accountNumber === $accountNumber) {
            $currentBalance = parent::checkBalance($accountNumber);
            if ($currentBalance >= $balance) {
                parent::withdrawFund($balance, $accountNumber);
            } else {
                $this->fee = 25 + abs($balance - $currentBalance);
                parent::setBalance(0);
                return $balance;
            }
        } else {
            echo "Account not found.";
        }
    } 

    public function displayDetail() {
        parent::displayDetail();
        echo "Fee to pay: " . $this->fee . "<br>";
    }
}

//this is more special cause saving account mostly has limit withdraw in 1 month(6 withdraw) and it give interestrate back so we can earn money
//on top of the money we have in the account 
class SavingAccount extends BankAccount{
    protected $interestRate;
    protected $withdrawLimit;

    public function __construct($accountNumber, $accountName, $accountType, $interestRate,$withdrawLimit) {
        parent::__construct($accountNumber, $accountName, $accountType);
        $this->interestRate = $interestRate;
        $this->withdrawLimit = $withdrawLimit;
    }

    //the interest in real saving bank is alot of calculation and time period supppose we already calculate the APY 
    // and only relied on the interest we set normal saving account will give out the cash in designated time like the APY it's annually 
    public function returnInterest(){
        $interest = parent::checkBalance($this->accountNumber) * ($this->interestRate/100);
        return $interest;
    }
    public function withdrawFund($balance, $accountNumber)
    {
        if($this->withdrawLimit > 0){
            if(parent::checkBalance($accountNumber) >= $balance){
                parent::withdrawFund($balance,$accountNumber);
                $this->withdrawLimit -=1;
            }
        }
        else{
            echo "You have meet the limit of withdraw in this month";
        }
        
    }
    public function displayDetail() {
        parent::displayDetail();
        echo "withdraw Limit: ". $this->withdrawLimit. "<br>";
        echo "Interest rate: ".$this->interestRate . "<br>";
    }

}

?>
