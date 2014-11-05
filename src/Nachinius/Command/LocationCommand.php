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
use Symfony\Component\DomCrawler\Crawler;
use Nachinius\Command\Components\HtmlGetter;
use Nachinius\Command\Components\HttpGetter;
use Nachinius\Command\Components\Cache;

class LocationCommand extends Command 
{
    
    /**
     * @var HtmlGetter
     */
    private $htmlGetter;

    /**
     * 
     * @param HtmlGetter $htmlGetter
     */
    public function __construct(HtmlGetter $htmlGetter) {
        
        $this->htmlGetter = $htmlGetter;
        parent::__construct();
    }

    protected function configure()
    {
        $this->setName('get')
            ->setDescription('Get an url')
            ->addArgument('url', InputArgument::REQUIRED, 'URL')
//         ->addOption(
//             'yell',
//             null,
//             InputOption::VALUE_NONE,
//             'If set, the task will yell in uppercase letters'
//         )
        ;;

    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        // get html content
        $html = $this->htmlGetter->execute($input->getArgument('url'));
        
        $output->writeln($html);
    }
    
}