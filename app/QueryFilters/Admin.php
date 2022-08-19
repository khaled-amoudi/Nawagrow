<?php

namespace App\QueryFilters;

use Closure;
use Filter;

class Admin extends Filter{


    public function handle($request, Closure $next){

        if( ! request()->has('isAdmin')){
            return $next($request);
        }

        $builder = $next($request);

        return $builder->where('is_admin', request('isAdmin'));

    }

}
