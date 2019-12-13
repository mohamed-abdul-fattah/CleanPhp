<?php

namespace Application\Controller;

use CleanPhp\Domain\Repository\Contracts\ICustomerRepository;
use CleanPhp\Domain\Service\CustomerInputFilter;
use Zend\Mvc\Controller\AbstractActionController;
use CleanPhp\Domain\Entity\Customer;
use Zend\Hydrator\HydratorInterface;
use Zend\View\Model\ViewModel;

class CustomersController extends AbstractActionController
{
  /**
   * @var ICustomerRepository
   */
  protected $customersRepository;

    /**
     * @var CustomerInputFilter
     */
  protected $inputFilter;

    /**
     * @var HydratorInterface
     */
  protected $hydrator;

    /**
     * CustomersController constructor.
     *
     * @param ICustomerRepository $customersRepository
     * @param CustomerInputFilter $inputFilter
     * @param HydratorInterface $hydrator
     */
  public function __construct(
      ICustomerRepository $customersRepository,
      CustomerInputFilter $inputFilter,
      HydratorInterface $hydrator
  ) {
    $this->customersRepository = $customersRepository;
    $this->inputFilter         = $inputFilter;
    $this->hydrator            = $hydrator;
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

    /**
     * @return ViewModel
     */
  public function newAction()
  {
      $customer  = new Customer;
      $viewModel = new ViewModel;

      if (! $this->getRequest()->isPost()) {
          /** GET action (most probably :D) */
          $viewModel->setVariable('customer', $customer);
          return $viewModel;
      }

      /** POST action */
      $this->inputFilter->setData($this->params()->fromPost());
      if (! $this->inputFilter->isValid()) {
          $this->hydrator->hydrate($this->params()->fromPost(), $customer);
          $viewModel->setVariable('customer', $customer);
          $viewModel->setVariable('errors', $this->inputFilter->getMessages());
          return $viewModel;
      }

      $customer = $this->hydrator->hydrate(
          $this->inputFilter->getValues(),
          new Customer
      );
      $this->customersRepository
          ->begin()
          ->persist($customer)
          ->commit();
      $this->flashMessenger()->addSuccessMessage('Customer Saved');
      $this->redirect()->toUrl('/customers');
      return $viewModel;
  }
}
