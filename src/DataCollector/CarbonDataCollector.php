<?php

/*
 * This file is part of the CarbonProfilerBundle
 *
 * (c) Daniel Gonzalez <dgzaballos@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Dem3trio\Bundle\CarbonProfilerBundle\DataCollector;

use Dem3trio\Bundle\CarbonProfilerBundle\TimeMachine;
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

    public function __construct(TimeMachine $timeMachine, \Twig_Environment $twig, FormFactoryInterface $formFactory, RouterInterface $router)
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

        if ($this->timeMachine->timeIsSet()) {
            $this->data['date'] = $this->timeMachine->getDate()->format('Y-m-d H:i:s');
        }
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

    private function createForm()
    {
        $form = $this->formFactory->create('Dem3trio\Bundle\CarbonProfilerBundle\Form\Type\TravelFormType', null,
            array('action' => $this->router->generate('_time_machine_travel')));

        return $this->twig->render('@CarbonProfiler/Form/form.html.twig', array('form' => $form->createView()));
    }
}
