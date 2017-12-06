<?php

class LogToDatabase 
{
    public function execute($message)
    {
        var_dump('log the message to a database :'.$message);
    }
}

class LogToFile 
{
    public function execute($message)
    {
        var_dump('log the message to a file :'.$message);
    }
}

class UsersController 
{ 
    protected $logger;
    
    public function __construct(LogToFile $logger)
    {
        $this->logger = $logger;
    }
    
    public function show()
    { 
        $user = 'nahid';
        $this->logger->execute($user);
    }
}

$controller = new UsersController(new LogToFile);
$controller->show();
