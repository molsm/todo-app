<?php declare(strict_types = 1);

namespace Todo\Provider;

use League\Container\ServiceProvider\AbstractServiceProvider;
use League\Container\ServiceProvider\BootableServiceProviderInterface;
use Todo\Contracts\ViewInterface;
use Todo\Services\View;

class AppServiceProvider extends AbstractServiceProvider implements BootableServiceProviderInterface
{
    /** @var string $basePath */
    private $basePath;
    /** @var array $config */
    private $config;

    protected $provides = [
        View::class
    ];

    public function boot()
    {
        $this->basePath = $this->getContainer()->get('basePath');
        $this->config = $this->getContainer()->get('config');
    }

    public function register()
    {
        $this->registerView();
    }

    protected function registerView()
    {
        $this->getContainer()
            ->share(View::class, function() {
                $twig = new \Twig_Environment(new \Twig_Loader_Filesystem($this->basePath.'/../'.$this->config['templatePath']));
                return new View($twig);
            });
        $this->getContainer()->add(ViewInterface::class, View::class);
    }
}