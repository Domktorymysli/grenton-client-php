<?php

namespace Domktorymysli\Grenton\Cli;

use Domktorymysli\Grenton\Command\CluFunctionCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class ExecCommand
 * @package Domktorymysli\Grenton\Cli
 */
final class ExecCommand extends Command
{
    /**
     * @var AppContainer
     */
    private $appContainer;

    /**
     * @param AppContainer $appContainer
     * @param null $name
     * @internal param AppContainer $appContainer
     */
    public function __construct(AppContainer $appContainer, $name = null)
    {
        parent::__construct($name);
        $this->appContainer = $appContainer;
    }

    protected function configure()
    {
        $this->setName('grenton:exec')
            ->setDescription('Skrypt pozwalający na zdalne wywoływanie funkcji na CLU firmy Grenton.');

        $this->addArgument('c', InputArgument::REQUIRED, "Plik konfiguracyjny. Zobacz przykladowy plik properties-dist.xml" );
        $this->addOption('function', 'f', InputOption::VALUE_REQUIRED, "Nazwa funkcji na CLU" );
        $this->addOption('parameters','p',  InputOption::VALUE_REQUIRED | InputOption::VALUE_IS_ARRAY, "Parametry funkcji, oddzielone spacją");
        $this->addOption('i','i', InputOption::VALUE_REQUIRED, "Ip zwrotne" );
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     *
     * @return void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        try {
            $filename = $input->getArgument('c');
            $functionName = $input->getOption('function');
            $ip = $input->getOption('i');
            $parameters = $input->getOption('parameters');
            $api = $this->appContainer->getApi($filename);
            $command = new CluFunctionCommand($ip, $functionName, $parameters);
            $result = $api->send($command);

            if ($output->isVerbose()) {
                $output->writeln($result->getCommand());
            }

            $output->writeln($result->getBody());
        } catch (\Exception $e) {
            $output->writeln($e->getMessage());
            $this->appContainer->getLogger()->error($e);
        }
    }

}