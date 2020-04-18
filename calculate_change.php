<?php
/*
    Author:         Anopan Kandiah
    Date Created:   18/04/2020
    Date Modified:  18/04/2020
*/

Class Change
{
    private $cents;
    private $centsAmount;
    private $fiveCoin;
    private $tenCoin;
    private $twentyCoin;
    private $fiftyCoin;

    public function __construct()
    {
        $this->cents = 0;
        $this->centsAmount = 0;
        $this->fiveCoin = 0;
        $this->tenCoin = 0;
        $this->twentyCoin = 0;
        $this->fiftyCoin = 0;
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

        }
        else
        {
            echo 'Amount must be greater than 0 and a multiple of 5.';
        }
    }
}

$change = new Change();

$change->set_Cents($_POST["cents"]);

$change->stateChange();

?>