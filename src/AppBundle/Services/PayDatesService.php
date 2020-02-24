<?php


namespace AppBundle\Services;

use AppBundle\Entity\PayDates;

class PayDatesService
{
    /**
     * @param $year Integer
     * @return $payDates array
     */
    public function getDates($year)
    {
        $payDates = [];
        for ($m=1; $m<=12; $m++) {
            $payDates[$m] = new PayDates($this->GetPayDateForMonth($m, $year), $this->GetFirstExpenseDay($m, $year), $this->GetSecondExpenseDay($m, $year));
        }

        return $payDates;
    }

    /**
     * @param $monthNumber integer
     * @param $year integer
     * @return date
     */
    private function GetPayDateForMonth($monthNumber, $year)
    {
        // get month name
        $month = date('F', mktime(0, 0, 0, $monthNumber, 10));
        return date('Y-m-d', strtotime('last weekday ' . date("F Y", strtotime('next month ' . $month . ' ' . $year))));
    }

    /**
     * @param $monthNumber integer
     * @param $year integer
     * @return date|string
     */
    private function GetFirstExpenseDay($monthNumber, $year)
    {
        // get month name
        $month =  date('F', mktime(0, 0, 0, $monthNumber, 10));
        return  date('Y-m-d', strtotime('+0 weekday '.$month .$year));
    }

    /**
     * @param $monthNumber integer
     * @param $year integer
     * @return date|string
     */
    private function GetSecondExpenseDay($monthNumber, $year)
    {
        //get month name
        $month =  date('F', mktime(0, 0, 0, $monthNumber, 10));

        //get the 2nd week date
        $workDay = date('l', strtotime('+2 week '.$month .$year));

        if($workDay == 'Saturday' || $workDay == 'Sunday') {
            $date = date('Y-m-d', strtotime('next Monday '.  date('Y-m-d', strtotime('+2 week '.$month .$year))));
        } else {
            $date =  date('Y-m-d', strtotime('+2 week '.$month .$year));
        }
        return $date;
    }
}