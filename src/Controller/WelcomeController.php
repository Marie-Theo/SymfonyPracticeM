<?php
// src/Controller/LuckyController.php
namespace App\Controller;

use App\Service\Calculate;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\Loader\Configurator\App;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

class WelcomeController extends AbstractController
{
    #[Route('/', name: 'app_welcome')]
    public function index(Calculate $c, LoggerInterface $logger, TranslatorInterface $translator): Response
    {
        $logger->info('Application is starting');

        $currentDate = new \DateTimeImmutable('now', new \DateTimeZone('Europe/Paris'));

        $appName = $translator->trans('DigitalFirstSteps');

        $calc = $c->sum(8, 5);

        return $this->render('welcome/index.html.twig', [
            'currentDate' => $currentDate->format('d/m/Y'),
            'appName' => $appName,
            'calc' => $calc,
        ]);
    }
}