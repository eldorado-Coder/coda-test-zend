<?php

declare(strict_types=1);

namespace App\Handler;

use Laminas\Diactoros\Response\HtmlResponse;
use Laminas\Diactoros\Response\JsonResponse;
use Mezzio\LaminasView\LaminasViewRenderer;
use Mezzio\Plates\PlatesRenderer;
use Mezzio\Router;
use Mezzio\Template\TemplateRendererInterface;
use Mezzio\Twig\TwigRenderer;
use Mia\Installer\Generate\Mezzio\AbmHandler;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class HomePageHandler implements RequestHandlerInterface
{
    /** @var string */
    private $containerName;

    /** @var Router\RouterInterface */
    private $router;

    /** @var null|TemplateRendererInterface */
    private $template;

    public function __construct(
        string $containerName,
        Router\RouterInterface $router,
        ?TemplateRendererInterface $template = null
    ) {
        $this->containerName = $containerName;
        $this->router        = $router;
        $this->template      = $template;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $data = [];

        switch ($this->containerName) {
            case 'Aura\Di\Container':
                $data['containerName'] = 'Aura.Di';
                $data['containerDocs'] = 'http://auraphp.com/packages/4.x/Di/';
                break;
            case 'Pimple\Psr11\Container':
                $data['containerName'] = 'Pimple';
                $data['containerDocs'] = 'https://pimple.symfony.com/';
                break;
            case 'Laminas\ServiceManager\ServiceManager':
                $data['containerName'] = 'Laminas Servicemanager';
                $data['containerDocs'] = 'https://docs.laminas.dev/laminas-servicemanager/';
                break;
            case 'Northwoods\Container\InjectorContainer':
                $data['containerName'] = 'Auryn';
                $data['containerDocs'] = 'https://github.com/rdlowrey/Auryn';
                break;
            case 'Symfony\Component\DependencyInjection\ContainerBuilder':
                $data['containerName'] = 'Symfony DI Container';
                $data['containerDocs'] = 'https://symfony.com/doc/current/service_container.html';
                break;
            case 'Elie\PHPDI\Config\ContainerWrapper':
            case 'DI\Container':
                $data['containerName'] = 'PHP-DI';
                $data['containerDocs'] = 'http://php-di.org';
                break;
            case 'Chubbyphp\Container\Container':
                $data['containerName'] = 'Chubbyphp Container';
                $data['containerDocs'] = 'https://github.com/chubbyphp/chubbyphp-container';
                break;
        }


        return new JsonResponse([
            'welcome' => 'Congratulations! You have installed the mezzio skeleton application.',
            'docsUrl' => 'https://docs.mezzio.dev/mezzio/',
        ] + $data);
    }
}
