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

class LocationCommand extends Command
{

    /**
     *
     * @var HtmlGetter
     */
    private $htmlGetter;

    private $urlComponents;

    /**
     *
     * @param HtmlGetter $htmlGetter            
     */
    public function __construct(HtmlGetter $htmlGetter, $name = 'get')
    {
        $this->name = $name;
        $this->htmlGetter = $htmlGetter;
        parent::__construct();
    }

    protected function configure()
    {
        $this->setName($this->name)
            ->setDescription('Get an url')
            ->addArgument('url', InputArgument::REQUIRED, 'URL')
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
        $url = $input->getArgument('url');
        $url = $this->sanitize($url);
        
        $output->writeln(print_r($this->urlComponents, 1));
        // get html content
        $html = $this->htmlGetter->execute($url);
        
        $output->writeln(substr($html, 0, 1000));
    }

    public function sanitize($url)
    {
        $str = '';
        if ($this->urlComponents = parse_url($url)) {
            if (array_key_exists('host', $this->urlComponents)) {
                $str = $this->urlComponents['host'];
            }
            if (array_key_exists('path', $this->urlComponents)) {
                $str .= $this->urlComponents['path'];
            }
        }
        return $str;
    }
}