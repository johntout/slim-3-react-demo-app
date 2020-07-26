<?php

namespace App\Services;

use App\Interfaces\Services;
use Illuminate\Support\Arr;
use \Slim\Views\PhpRenderer;
use \Psr\Http\Message\ResponseInterface as Response;

class ViewService implements Services
{
    /**
     * @var null
     */
    protected $renderer = NULL;

    /**
     * @var string
     */
    protected $template;

    /**
     * @var string
     */
    protected $templatePath;

    /**
     * @var mixed
     */
    protected $attributes;

    /**
     * @var int
     */
    protected $status = 200;

    /**
     * ViewService constructor.
     */
    private function __construct()
    {
        if ($this->renderer == NULL) {
            $this->renderer = new PhpRenderer(app_dir()."/app/Views/");
        }

        return $this->renderer;
    }

    /**
     * @return ViewService
     */
    public static function boot() :ViewService
    {
        return new self();
    }

    /**
     * @param string $template
     * @param array $attributes
     * @param int $status
     * @return $this
     */
    public function make(string $template, array $attributes, int $status = 200)
    {
        $this->status = $status;
        $this->attributes = $attributes;
        $this->template = str_replace('.','/', $template).'.php';
        $this->templatePath = $this->renderer->getTemplatePath().$this->template;

        return $this;
    }

    /**
     * @return Response
     */
    public function render() :Response
    {
        $data = array_merge($this->attributes, array(
            'messages' =>  session()->flash()->getMessages(),
        ));

        return $this->renderer->render(response(), $this->template, $data)
            ->withStatus($this->status)
            ->withHeader('Content-Type', 'text/html');
    }

    /**
     * @return mixed
     */
    public function raw()
    {
        return $this->renderer->fetch($this->template, $this->attributes);
    }
}