<?php
/**
 * Class IPController
 */
namespace App\Controller;

use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\Routing\Annotation\Route;

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
   *
   * @param Response $response instance of symfony response
   *
   * @return Response
   */
  public function ip(Request $request, Response $response): Response {
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
      $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
      $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
      $ip = $_SERVER['REMOTE_ADDR'];
    }

    $response->headers->add(
        [
            'x-hello-world' => 'I.K.'
        ]
    );
    $json = [
        'ip' => $ip
    ];
    if (($name = $request->get('name'))) {
      $json['greeting'] = 'Hello ' . $name
    }

    return $this->handleView($this->view($json));
  }
}