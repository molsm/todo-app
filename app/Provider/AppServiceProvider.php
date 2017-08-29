<?php declare(strict_types = 1);

namespace Todo\Provider;

use League\Container\ServiceProvider\AbstractServiceProvider;
use League\Container\ServiceProvider\BootableServiceProviderInterface;
use Twig_Environment;
use Twig_Loader_Filesystem;

class AppServiceProvider extends AbstractServiceProvider implements BootableServiceProviderInterface
{
    /** @var string $basePath */
    private $basePath;
    /** @var array $config */
    private $config;

    protected $provides = [
        'view'
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
        $loader = new Twig_Loader_Filesystem($this->basePath.'/../'.$this->config);
        $twig = new Twig_Environment($loader);

        $this->getContainer()->add('view', $twig);
    }
}