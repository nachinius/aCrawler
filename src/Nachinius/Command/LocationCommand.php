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
use Nachinius\Command\Components\HtmlGetter;
use Nachinius\Command\Components\HttpGetter;
use Nachinius\Command\Components\Cache;

class LocationCommand extends Command
{
    /**
     * 
     * @var Cache
     */
    private $cache;

    public function __construct(Cache $cache = NULL) {
        $this->cache = $cache;
        parent::__construct();
    }
    
    protected function configure()
    {
        $this->setName('get')->setDescription('Get an url')
         ->addArgument(
             'url',
             InputArgument::REQUIRED,
             'URL'
         )
//         ->addOption(
//             'yell',
//             null,
//             InputOption::VALUE_NONE,
//             'If set, the task will yell in uppercase letters'
//         )
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $httpGetter = new HttpGetter();
        $htmlGetter = new HtmlGetter($httpGetter, $this->cache);
        
        // get html
        $html = $htmlGetter->execute($input->getArgument('url'));
        
        // html->dom
        // dom->filtercss
        // grab data from table
        // to json
        // write to file
    }
}