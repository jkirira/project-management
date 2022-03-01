<?php
namespace App\Filters;


use Illuminate\Http\Request;


abstract class Filters
{

    protected $request, $builder;

    protected $filters = [];

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function apply($builder)
    {
        // $builder is the query passed from the 'scopeFilter' method on the thread model in thread.php
        $this->builder = $builder;

        foreach ($this->getFilters() as $filter => $value)
        {
            if(method_exists($this, $filter))
            {
                $this->$filter($value);
            }
        }

        return $this->builder;
    }

    protected function getFilters()
    {
        $filters = array_intersect(array_keys($this->request->all()), $this->filters);
        return $this->request->only($filters);
    }

}
