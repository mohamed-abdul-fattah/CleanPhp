<?php

namespace CleanPhp\Domain\Service;

use Zend\InputFilter\Input;
use Zend\InputFilter\InputFilter;
use Zend\Validator\EmailAddress;

class CustomerInputFilter extends InputFilter
{
    /**
     * CustomerInputFilter constructor.
     */
    public function __construct()
    {
        $name  = (new Input('name'))->setRequired(true);
        $email = (new Input('email'))->setRequired(true);

        $email->getValidatorChain()->attach(new EmailAddress);
        $this->add($name);
        $this->add($email);
    }
}
