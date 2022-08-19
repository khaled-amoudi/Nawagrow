<?php

namespace App\QueryFilters;

use Closure;

abstract class Filter {


    public function handle($request, Closure $next){

        if( ! request()->has('isAdmin')){
            return $next($request);
        }

        $builder = $next($request);

        return $builder->where('is_admin', request('isAdmin'));

    }


    protected abstract function applyFilter($builder);


}
