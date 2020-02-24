<?php


namespace AppBundle\Entity;

class PayDates
{
    private $month;

    private $payDate;

    private $firstExpenseDay;

    private $secondExpenseDay;

    public function __construct($payDate, $firstExpenseDate, $secondExpenseDay)
    {
        $this->month = date("F", strtotime($payDate));
        $this->payDate=$payDate;
        $this->firstExpenseDay = $firstExpenseDate;
        $this->secondExpenseDay = $secondExpenseDay;
    }

    public function getMonth()
    {
        return $this->month;
    }

    public function getPayDate()
    {
        return $this->payDate;
    }

    public function setPayDate($date)
    {
        $this->payDate = $date;
    }

    public function getFirstExpenseDay()
    {
        return $this->firstExpenseDay;
    }

    public function setFirstExpenseDay($date)
    {
        $this->firstExpenseDay = $date;
    }

    public function getSecondExpenseDay()
    {
        return $this->secondExpenseDay;
    }

    public function setSecondExpenseDay($date)
    {
        $this->secondExpenseDay = $date;
    }
}