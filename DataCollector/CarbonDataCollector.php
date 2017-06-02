<?php

namespace Dem3trio\CarbonProfilerBundle\DataCollector;


use Dem3trio\CarbonProfilerBundle\TimeMachine;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\DataCollector\DataCollector;
use Symfony\Component\Routing\RouterInterface;

class CarbonDataCollector extends DataCollector
{
    protected $timeMachine;
    protected $twig;
    protected $formFactory;
    protected $router;


    function __construct(TimeMachine $timeMachine, \Twig_Environment $twig, FormFactoryInterface $formFactory, RouterInterface $router)
    {
        $this->timeMachine = $timeMachine;
        $this->twig = $twig;
        $this->formFactory = $formFactory;
        $this->router = $router;
    }

    public function collect(Request $request, Response $response, \Exception $exception = null)
    {
        $this->data['date'] = null;
        $this->data['form'] = $this->createForm();

        if($this->timeMachine->timeIsSet()) {
            $this->data['date'] = $this->timeMachine->getDate()->format('Y-m-d H:i:s');
        }
    }

    private function createForm()
    {
        $form = $this->formFactory->create('Dem3trio\CarbonProfilerBundle\Form\TravelFormType', null,
            array('action' => $this->router->generate('_time_machine_travel')));

        return $this->twig->render('@CarbonProfiler/Form/form.html.twig', array('form' => $form->createView()));
    }

    public function getForm()
    {
        return $this->data['form'];
    }

    public function getDate()
    {
        return $this->data['date'];
    }

    public function getName()
    {
        return 'dem3trio.carbon_collector';
    }
}