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
     * @param callback|null $lang_callback
     */
    public function __construct(string $path_to_templates, ?string $path_to_cache = null, callable $lang_callback = null)
    {
        $loader = new \Twig\Loader\FilesystemLoader($path_to_templates);
        $this->twig = new \Twig\Environment($loader, array(
            'cache' => $path_to_cache,
            'auto_reload' => ($path_to_cache == false)
        ));
        
        if(!empty($lang_callback)){
            $filter = new \Twig\TwigFilter('lang', function ($string) use($lang_callback) {
                return $lang_callback($string);
            });
            $this->twig->addFilter($filter);
        }
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
