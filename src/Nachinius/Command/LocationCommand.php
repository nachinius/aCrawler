<?php

/**
 * @author ignacio
 *
 */
namespace Nachinius\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Nachinius\Command\Components\HtmlGetter;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\DependencyInjection\Container;

/**
 * A console command for symfony console compoenent
 * that can retrieive the content of a page
 */
class LocationCommand extends Command
{

    /**
     *
     * @var HtmlGetter
     */
    private $htmlGetter;

    /**
     * Name of the console command
     * 
     * @param
     *            string
     */
    private $_name;

    /**
     *
     * @param HtmlGetter $htmlGetter            
     * @param string $name
     *            Name of the console command
     * @param Container $container
     *            DI container
     */
    public function __construct(HtmlGetter $htmlGetter, $name = 'get')
    {
        $this->_name = $name;
        $this->htmlGetter = $htmlGetter;
        parent::__construct();
    }

    protected function configure()
    {
        $this->setName($this->_name)
            ->setDescription('Get an url')
            ->addArgument('url', InputArgument::REQUIRED, 'URL')
            ->addOption('flush', null, InputOption::VALUE_NONE, 'If set, the cache will be wipe it out before use');
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        // if we want to flush all the cache's content
        if ($input->getOption('flush')) {
            $this->htmlGetter->cleanCache();
        }
        
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
