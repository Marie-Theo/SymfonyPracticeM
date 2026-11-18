<?php
// src/Controller/LuckyController.php
namespace App\Controller;

use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

class WelcomeController extends AbstractController
{
    #[Route('/', name: 'app_welcome')]
    public function index(LoggerInterface $logger, TranslatorInterface $translator, Request $request): Response
    {
        $logger->info('Application is starting');

        $currentDate = new \DateTimeImmutable('now', new \DateTimeZone('Europe/Paris'));

        $appName = $translator->trans('DigitalFirstSteps');

        dump($request->getSession()->all());
        
        return $this->render('welcome/index.html.twig', [
            'player' => $request->getSession()->get('player'),
            'session' => $request->getSession()->get('session'),
        ]);
    }
}