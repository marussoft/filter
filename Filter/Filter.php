<?php 

declare(strict_types=1);

namespace Marussia\Components\Filter;

class Filter
{
    private $filters;
    
    private $task;
    
    private $handle;

    public function __construct(array $filters, $handle)
    {
        $this->filters = $filters;
        
        $this->handle = $handle;
    }
    
    public function run($task)
    {
        $this->task = $task;
        
        reset($this->filters);
        
        $this->runFilter();
    }
    
    public function next()
    {
        if ($this->task === null) {
            return;
        }
    
        if (next($this->filters) === false) {
            $this->nextHandle();
            return;
        }
        
        $this->runFilter();
    }
    
    public function break()
    {
        $this->task = null;
    }
    
    private function runFilter()
    {
        $filter = current($this->filters);

        $filter->run($this->task, $this);
    }
    
    private function nextHandle()
    {
        $this->handle->run($this->task);
    }
    
}
 
