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

class LocationCommand extends Command
{

    /**
     *
     * @var HtmlGetter
     */
    private $htmlGetter;

    private $urlComponents;

    private $_name;

    /**
     *
     * @param HtmlGetter $htmlGetter            
     */
    public function __construct(HtmlGetter $htmlGetter, $name = 'get', Container $container = NULL)
    {
        $this->_name = $name;
        $this->htmlGetter = $htmlGetter;
        $this->container = $container;
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
        if($input->getOption('flush')) {
            $this->container->get('cache')->flush();
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
