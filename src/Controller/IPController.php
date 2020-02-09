<?php
/**
 * Class IPController
 */
namespace App\Controller;

use FOS\RestBundle\Controller\{AbstractFOSRestController, Annotations as Rest};
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Request\ParamFetcher;

/**
 * Class IPController
 * @Route("/")
 */
class IPController extends AbstractFOSRestController {
  /**
   * REST action which returns client's IP address.
   * Method: GET, url: /ip.{_format}
   *
   * @Rest\Get("/ip.{_format}")
   * @Rest\QueryParam(name="page", requirements="\d+", default="1", description="Page of the overview.")
   *
   * @param ParamFetcher $paramFetcher  FOR REST bundle param fetcher
   *
   * @return Response
   */
  public function ip(ParamFetcher $paramFetcher): Response {
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
      $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
      $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
      $ip = $_SERVER['REMOTE_ADDR'];
    }

    $json = [
        'ip' => $ip
    ];
    var_dump($paramFetcher->all());die();
    /*if (($name = $paramFetcher->get('name'))) {
      $json['greeting'] = 'Hello ' . $name;
    }*/

    return $this->handleView($this->view($json, Response::HTTP_OK, [
        'x-hello-world' => 'I.K.'
    ]));
  }
}