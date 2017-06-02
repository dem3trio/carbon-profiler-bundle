<?php

namespace Dem3trio\Bundle\CarbonProfilerBundle\Controller;


use Carbon\Carbon;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class TimeMachineController
 */
class TimeMachineController extends Controller
{
    /**
     * @param Request $request
     * @return JsonResponse|\Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function travelAction(Request $request)
    {
        $form = $this->createForm('Dem3trio\Bundle\CarbonProfilerBundle\Form\TravelFormType');
        $form->handleRequest($request);

        if($form->isValid()) {
            $data = $form->getData();
            $carbonDate = Carbon::instance($data['date']);
            $this->get('dem3trio.time_machine')->travelTo($carbonDate);

            if($request->server->has('HTTP_REFERER')) {
                return $this->redirect($request->server->get('HTTP_REFERER'));
            }

            return new JsonResponse(array('status' => 'ok'));
        }


            return new JsonResponse(array('status' => 'failed'));


    }

    /**
     * @param Request $request
     * @return JsonResponse|\Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function resetAction(Request $request)
    {
        $this->get('dem3trio.time_machine')->backToNow();


        if($request->server->has('HTTP_REFERER')) {
            return $this->redirect($request->server->get('HTTP_REFERER'));
        }

        return new JsonResponse(array('status' => 'ok'));
    }
}