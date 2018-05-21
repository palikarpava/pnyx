<?php

abstract class Map
{
    const REGION_EUROPE = 'Europe';
    const REGION_AFRICA = 'Africa';
    const REGION_ASIA = 'Asia';
    const REGION_AUSTRALIA = 'Australia';
    const REGION_AMERICA = 'America';
    const REGION_NORTH_AMERICA = 'NAmerica';

    abstract function getViewParams();

    abstract function getTemplateFile();

    private $poll_id;

    public function setPollId($id)
    {
        $this->poll_id = $id;
    }

    protected function getPollId()
    {
        return $this->poll_id;
    }

    protected function getResults()
    {
        $continent = get_post_meta($this->getPollId(), 'continent', true);
        return is_array($continent) ? $continent : [];
    }

    protected function renderFile($filename, $params)
    {
        if (is_array($params) && !empty($params)) {
            extract($params);
        }

        ob_start();

        $template_filename = __DIR__ . '/views/' . $filename . '.php';

        if (!is_file($template_filename)) {
            echo 'Template not found';
        } else {
            include $template_filename;
        }

        return ob_get_clean();
    }

    public function render()
    {
        echo $this->renderFile($this->getTemplateFile(), $this->getViewParams());
    }
}