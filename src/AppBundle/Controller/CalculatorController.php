<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Util\Calculator;

class CalculatorController extends Controller
{
    /**
     * @Route("/calculator", name="calculator")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('calculator/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir') . '/..') . DIRECTORY_SEPARATOR,
        ]);
    }

    /**
     * @Route("/calculator/calculate", name="calculate")
     */
    public function calculateAction(Request $request)
    {

        if ( $request->getMethod() !== 'POST' ) {
            return $this->redirectToRoute('calculator');
        }

        $calculator = new Calculator();

        $status = true;
        $a = $request->request->get('a', '0');
        $b = $request->request->get('b', '0');
        $symbol = $request->request->get('symbol', '+');

        switch ($symbol) {
            case '+':
                $calc = $calculator->add($a, $b);
                break;
            case '-':
                $calc = $calculator->sub($a, $b);
                break;
            case '*':
                $calc = $calculator->mul($a, $b);
                break;
            case '/':
                $calc = $calculator->div($a, $b);
                if ( $calc === false ) {
                    $status = false;
                    $calc = 'Cannot divide by 0';
                }
                break;
        }

        // If javascript is disabled we render the page
        if ($request->isXmlHttpRequest()) {
            return new JsonResponse(array('status' => $status, 'result' => $calc));
        } else {
            return $this->render('calculator/result.html.twig', [
                'base_dir' => realpath($this->getParameter('kernel.root_dir') . '/..') . DIRECTORY_SEPARATOR,
                'result' => $calc
            ]);
        }
    }
}
