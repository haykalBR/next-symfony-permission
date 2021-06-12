<?php
namespace next\SymfonyPermissionBundle\Command;
use next\SymfonyPermissionBundle\Manipulator\RoleManipulator;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;
use Symfony\Component\Console\Style\SymfonyStyle;

class CreateRoleCommand extends AbstractCommand
{
    protected static $defaultName = 'next:role:create';
    /**
     * @var RoleManipulator
     */
    private RoleManipulator $roleManipulator;

    public function __construct(RoleManipulator $roleManipulator)
    {
        parent::__construct();
        $this->roleManipulator = $roleManipulator;
    }
    protected function configure()
    {
        $this
            ->setDescription('Create a role.')
            ->setDefinition([
                new InputArgument('name', InputArgument::REQUIRED, 'The email'),
            ]);
    }
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        $name = $input->getArgument('name');
        $this->roleManipulator->create($name);
        $output->writeln(sprintf('Created role <comment>%s</comment>', $name));
        return Command::SUCCESS;
    }
    protected function interact(InputInterface $input, OutputInterface $output){
        $questions = [];
        if (!$input->getArgument('name')) {
            $question = new Question('Please choose a name:');
            $question->setValidator(function ($password) {
                if (empty($password)) {
                    throw new \Exception('Name can not be empty');
                }
                return $password;
            });
            $questions['name'] = $question;
        }
        foreach ($questions as $name => $question) {
            $answer = $this->getHelper('question')->ask($input, $output, $question);
            $input->setArgument($name, $answer);
        }
    }
}