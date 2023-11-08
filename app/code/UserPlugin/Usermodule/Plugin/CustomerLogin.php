<?php

namespace UserPlugin\Usermodule\Plugin;

use Magento\Customer\Model\AccountManagement;
use Magento\Framework\Logger\Monolog;
use PhpParser\Node\Stmt\TryCatch;
use Psr\Log\LoggerInterface as LoggerInterface;

class CustomerLogin
{
    /**
     * @var Monolog
     */
    protected $logger;

    /**
     * CustomerLoginLogger constructor.
     * @param Monolog $logger
     */
    public function __construct(
        LoggerInterface $logger
    ) {
        $this->logger = $logger;
    }

    public function aroundAuthenticate(AccountManagement $subject, callable $proceed, $email, $password)
    {
        try {

            // Proceed function takes in the credentials for authentication
            $result = $proceed($email, $password); // Proceed function will check the authentication and if it fails the rest of try wont be executed

            // This line of code logs the sign in attempt
            $this->logger->info('Login attsempt for email: ' . $email . 'Success');

            //var_dump($result);

            return $result;
        } catch (\Exception $e) {

            //This line of code logs the error into the log file
            $this->logger->error("Login attempt failed: " . $email . "Error:" . $e->getMessage());

            throw $e;
        }
        // Log customer login attempt
        //$this->logger->info('Login attempt for email: ' . $email);

        // Proceed with the original method
        //return $proceed($email, $password);
    }
}
