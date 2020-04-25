<?php
/*
    Author:         Anopan Kandiah
    Date Created:   18/04/2020
    Date Modified:  25/04/2020
*/

Class Change
{
    private $cents;
    private $centsAmount;
    private $fiveCoin;
    private $tenCoin;
    private $twentyCoin;
    private $fiftyCoin;
    private $oneCoin;
    private $twoCoin;

    public function __construct()
    {
        $this->cents = 0;
        $this->centsAmount = 0;
        $this->fiveCoin = 0;
        $this->tenCoin = 0;
        $this->twentyCoin = 0;
        $this->fiftyCoin = 0;
        $this->oneCoin = 0;
        $this->twoCoin = 0;
    }

    public function set_Cents($c)
    {
        $this->cents = $c;
        $this->centsAmount = $c;  
    }

    public function get_Cents()
    {
        return($this->centsAmount);
    }

    private function calculateChange()
    {
        $valid = true;

        if($this->cents > 0 && !($this->cents % 5))
        {
            while ($this->cents >= 200)
            {
                $this->cents = $this->cents - 200;
                $this->twoCoin++;
            }

            while ($this->cents >= 100)
            {
                $this->cents = $this->cents - 100;
                $this->oneCoin++;
            }

            while($this->cents >= 50)
            {
                $this->cents = $this->cents - 50;
                $this->fiftyCoin++;
            }

            while($this->cents >= 20)
            {
                $this->cents = $this->cents - 20;
                $this->twentyCoin++;
            }

            while($this->cents >= 10)
            {
                $this->cents = $this->cents - 10;
                $this->tenCoin++;
            }

            while($this->cents >= 5)
            {
                $this->cents = $this->cents - 5;
                $this->fiveCoin++;
            }
        }
        else
        {
            $valid = false;
        }

        return($valid);
    }

    public function stateChange()
    {
        if($this->calculateChange())
        {
            echo 'Change given for ' .$this->centsAmount .' cents will consist of:<br><br>';

            if($this->twoCoin == 1)
            {
                echo $this->twoCoin .' - $2 coin.<br>';
            }

            if($this->twoCoin > 1)
            {
                echo $this->twoCoin .' - $2 coins.<br>';
            }

            if($this->oneCoin == 1)
            {
                echo $this->oneCoin .' - $1 coin.<br>';
            }

            if($this->oneCoin > 1)
            {
                echo $this->oneCoin .' - $1 coins.<br>';
            }

            if($this->fiftyCoin == 1)
            {
                echo $this->fiftyCoin .' - 50c coin.<br>';
            }

            if($this->fiftyCoin > 1)
            {
                echo $this->fiftyCoin .' - 50c coins.<br>';
            }

            if($this->twentyCoin == 1)
            {
                echo $this->twentyCoin .' - 20c coin.<br>';
            }

            if($this->twentyCoin > 1)
            {
                echo $this->twentyCoin .' - 20c coins.<br>';
            }

            if($this->tenCoin == 1)
            {
                echo $this->tenCoin .' - 10c coin.<br>';
            }

            if($this->tenCoin > 1)
            {
                echo $this->tenCoin .' - 10c coins.<br>';
            }

            if($this->fiveCoin == 1)
            {
                echo $this->fiveCoin .' - 5c coin.<br>';
            }

            if($this->fiveCoin > 1)
            {
                echo $this->fiveCoin .' - 5c coins.<br>';
            }

            $this->printReceipt();
        }
        else
        {
            echo 'Amount must be greater than 0 and a multiple of 5.';
        }
    }

    private function printReceipt()
    {
        date_default_timezone_set("Australia/Perth");
        $todayDate = date("d/m/Y H:i:s");

        $receiptNo = date("YmdHis") . rand(0,9);

        $receiptFile = fopen("receipt.txt", "w+");

        $saveText = "Receipt No. " .$receiptNo
                    . "\nDate: " . $todayDate
                    . "\n\nChange given for $this->centsAmount cents.\n\n" 
                    .$this->twoCoin .' - $2 coins.'
                    ."\n" .$this->oneCoin .' - $1 coins.'
                    ."\n" .$this->fiftyCoin .' - 50c coins.'
                    ."\n" .$this->twentyCoin .' - 20c coins.'
                    ."\n" .$this->tenCoin .' - 10c coins.'
                    ."\n" .$this->fiveCoin .' - 5c coins.';

        fwrite($receiptFile, $saveText);

        fclose($receiptFile);
    }
}

$change = new Change();

$change->set_Cents($_POST["cents"]);

$change->stateChange();

?>