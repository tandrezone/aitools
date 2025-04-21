<?php
namespace tandrezone\Aitools\tests;

class AbstractBenchmark
{
    protected $model;
    protected $parameters;
    protected $modelName;
    protected $modelList;
    protected $modelListPASS;
    protected $modelListFAIL;
    protected $modelListFAILPASS;
    protected $modelListFAILFAIL;

    public function __construct($model, $parameters)
    {
        $this->model = $model;
        $this->parameters = $parameters;
        $this->modelName = get_class($this->model);
        $this->modelList = [];
        $this->modelListPASS = [];
        $this->modelListFAIL = [];
        $this->modelListFAILPASS = [];
        $this->modelListFAILFAIL = [];
    }
}