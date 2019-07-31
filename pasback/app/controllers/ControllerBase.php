<?php

use Phalcon\Mvc\Controller;

class ControllerBase extends Controller
{
    public function afterExecuteRoute(\Phalcon\Mvc\Dispatcher $dispatcher)
    {
        $content = $dispatcher->getReturnedValue();

        if (is_array($content)) {
            $this->response->setJsonContent($content);
        }
    }
}
