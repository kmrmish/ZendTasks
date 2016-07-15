<?php
/*
 * Demo email service 
 * 
 */
namespace Email\Service;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Mail\Transport\Smtp as SmtpTransport;
use Zend\Mail\Transport\SmtpOptions;

class EmailService implements ServiceLocatorAwareInterface
{
	protected  $transport;
	protected $serviceLocator;
	/**
	 * Set service locator
	 *
	 * @param ServiceLocatorInterface $serviceLocator
	 */
	public function setServiceLocator(ServiceLocatorInterface $serviceLocator)
	{
		$this->serviceLocator = $serviceLocator;
	}
	
	/**
	 * Get service locator
	 *
	 * @return ServiceLocatorInterface
	*/
	public function getServiceLocator()
	{
		return $this->serviceLocator;
	}
	
	public function setSmtpOption()
	{
		// Setup SMTP transport using LOGIN authentication
		
		$transport = new SmtpTransport();
		
		$config = $this->serviceLocator->get('config');
    	
    	//\Zend\Debug\Debug::dump();
		$options = new SmtpOptions($config['mail_setting']);
		
		
		$transport->setOptions($options);
		$this->transport = $transport;
	}
	
	
	public function sendMail($message)
	{
		
		if (!$this->transport) {
			$this->setSmtpOption();
		}
		$this->transport->send($message);
		return 'Email Send';
	}
} 