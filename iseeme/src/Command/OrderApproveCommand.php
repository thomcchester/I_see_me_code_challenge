<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use App\Controller\BookOrderController;
use Symfony\Component\DependencyInjection\Definition;


class OrderApproveCommand extends Command
{
    protected static $defaultName = 'app:order-approve';

    protected function configure()
    {
        $this
            ->setDescription('turn errors to fresh and new!')
            // ->addArgument('arg1', InputArgument::OPTIONAL, 'Argument description')
            // ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
       
        $book_orders = new BookOrderController();
     

        $book_orders->fix_statuses();

        $io->success("changed");
    }
}
