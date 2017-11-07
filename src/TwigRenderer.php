<?php

namespace VekaServer\TwigRenderer;

use VekaServer\Interfaces\RendererInterface;

class TwigRenderer implements RendererInterface
{

    private $twig;

    /**
     * constructor.
     * @param string $path_to_templates
     * @param null|string $path_to_cache
     */
    public function __construct(string $path_to_templates, ?string $path_to_cache = null)
    {
        $loader = new \Twig_Loader_Filesystem($path_to_templates);
        $this->twig = new \Twig_Environment($loader, array(
            'cache' => $path_to_cache,
            'auto_reload' => ($path_to_cache == false)
        ));
    }

    /**
     * @param string $templatePath
     * @param array|null $data
     * @return string
     */
    public function render(string $templatePath, array $data = array()): string
    {
        return (string) $this->twig->render($templatePath, $data);
    }
}
