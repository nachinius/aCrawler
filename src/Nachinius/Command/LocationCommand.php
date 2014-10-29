<?php

/**
 * @author ignacio
 *
 */
namespace Nachinius\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;


class LocationCommand extends Command
{

    public function __construct($name = NULL)
    {
        parent::__construct($name);
    }

    protected function configure()
    {
        $this->setName('get:location')->setDescription('Get locations')
//         ->addArgument(
//             'name',
//             InputArgument::OPTIONAL,
//             'Who do you want to greet?'
//         )
//         ->addOption(
//             'yell',
//             null,
//             InputOption::VALUE_NONE,
//             'If set, the task will yell in uppercase letters'
//         )
        ;;

        ;
        
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        
    }
}