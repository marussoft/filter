<?php 

declare(strict_types=1);

namespace Marussia\Components\Filter;

class Filter
{
    // Массив фильтров
    private $filters;
    
    // задача на обработку
    private $task;
    
    // Слудующий обработчик
    private $handle;

    public function __construct(array $filters, $handle)
    {
        $this->filters = $filters;
        
        $this->handle = $handle;
    }
    
    // Запускает фильтрацию задачи
    public function run($task) : void
    {
        $this->task = $task;
        
        reset($this->filters);
        
        $this->runFilter();
    }
    
    // Запускает следующий фильтр
    public function next() : void
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
    
    // Останавливает обработку задачи
    public function break() : void
    {
        $this->task = null;
    }
    
    // Запускает текущий фильтр
    private function runFilter() : void
    {
        $filter = current($this->filters);

        $filter->run($this->task, $this);
    }
    
    // Передает задачу в следующий обработчик
    private function nextHandle() : void
    {
        $this->handle->run($this->task);
    }
    
}
 
