<?php

namespace Application\Controller;

use CleanPhp\Domain\Repository\Contracts\ICustomerRepository;
use Zend\Mvc\Controller\AbstractActionController;

class CustomersController extends AbstractActionController
{
  /**
   * @var ICustomerRepository
   */
  public $customersRepository;

  /**
   * CustomersController constructor.
   *
   * @param ICustomerRepository $customersRepository
   */
  public function __construct(ICustomerRepository $customersRepository)
  {
    $this->customersRepository = $customersRepository;
  }

  /**
   * @return array|\Zend\View\Model\ViewModel
   */
  public function indexAction()
  {
    return [
      'customers' => $this->customersRepository->getAll()
    ];
  }
}
