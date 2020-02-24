<?php

namespace AppBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Translation\IdentityTranslator;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use AppBundle\Services\PayDatesService;

class GetPayDatesCommand extends ContainerAwareCommand
{
    /**
     * @var PayDatesService
     */
    private $service;

    /**
     * @var IdentityTranslator
     */
    private $translator;

    /**
     * GetPayDatesCommand constructor.
     * @param PayDatesService $service
     */
    public function __construct(PayDatesService $service)
    {
        $this->service = $service;
        parent::__construct();
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     */
    protected function initialize(InputInterface $input, OutputInterface $output)
    {
        parent::initialize($input, $output); // TODO: Change the autogenerated stub
        $this->translator = $this->getContainer()->get('translator');
        $this->translator->setLocale("en");
    }

    protected function configure()
    {
        $this
            ->setName('getPayDates')
            ->setDescription('Get pay dates for given year')
            ->setHelp('This command allows you to extract and store all pay dates for given year')
            ->addArgument('year', InputArgument::REQUIRED, 'Year for pay dates')
        ;
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     */
    //todo: get 2nd argument for file path & create file on that location
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        //$translator = $this->getContainer()->get('translator');
        //$translator->setLocale("en");

        $year = $input->getArgument('year');

        $values = $this->service->getDates($year);
        if(! is_numeric($year)) die($this->translator->trans('command.errors.invalidInput'));
        if($year < 1000 || $year > 9999) die($this->translator->trans('command.errors.yearOutOfRange'));


        // create file name
        $fileName = $year.".csv";

        //generate file
        $dataFile = fopen($fileName, "wa+") or die($this->translator->trans('command.errors.fileError'));

        // add title
        fputcsv($dataFile,  array($this->translator->trans('command.FieldHeader.MonthName'),
            $this->translator->trans('command.FieldHeader.1stExpense'),
            $this->translator->trans('command.FieldHeader.2ndExpanse'),
            $this->translator->trans('command.FieldHeader.salaryDay')));

        foreach ($values as $value)
        {
            fputcsv($dataFile,  array($value->getMonth(), $value->getFirstExpenseDay(), $value->getSecondExpenseDay(), $value->getPayDate()));
        }

        // close the file
        fclose($dataFile);
    }
}
