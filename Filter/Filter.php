<?php 

declare(strict_types=1);

namespace Marussia\Components\Filter;

class Filter
{
    private $filters;
    private $queue;

    public function __construct(array $filters)
    {
        $this->filters = $filters;
    }
    
    public function run()
    {
        while($this->queue->valid()) {
            
        }
    }
    
    public function setQueue($queue)
    {
        $this->queue = $queue;
    }
    
    
}
 
