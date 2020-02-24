<?php


namespace Tests\AppBundle\Controller;

use AppBundle\Services\PayDatesService;
use PHPUnit\Framework\TestCase;
use AppBundle\Entity\PayDates;

class PayDatesServiceTest extends TestCase
{
    public function testGetDates()
    {
        $payDates = array (1=> new PayDates("2019-01-01", "2019-01-15", "2019-01-31"),
            2=> new PayDates("2019-02-01", "2019-02-15", "2019-02-28"),
            3=> new PayDates("2019-03-01", "2019-03-15", "2019-03-29"),
            4=> new PayDates("2019-04-01", "2019-04-15", "2019-04-30"),
            5=> new PayDates("2019-05-01", "2019-05-15", "2019-05-31"),
            6=> new PayDates("2019-06-03", "2019-06-17", "2019-06-28"),
            7=> new PayDates("2019-07-01", "2019-07-15", "2019-07-31"),
            8=> new PayDates("2019-08-01", "2019-08-15", "2019-08-30"),
            9=> new PayDates("2019-09-02", "2019-09-16", "2019-09-30"),
            10=> new PayDates("2019-10-01", "2019-10-15", "2019-10-31"),
            11=> new PayDates("2019-11-01", "2019-11-15", "2019-11-29"),
            12=> new PayDates("2019-12-02", "2019-12-16", "2019-12-31"));

        $service = new PayDatesService();
        $result = $service->getDates(2019);

        $this->assertEqualsCanonicalizing($payDates, $result);
    }
}
