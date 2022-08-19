<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGetCategoryParts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // $procedure = "DROP PROCEDURE IF EXISTS `get_category_parts`;
        // CREATE PROCEDURE `get_category_parts` (OUT)
        // BEGIN
        // SELECT * FROM categories;
        // END;";


        $procedure = "DROP PROCEDURE IF EXISTS `get_category_by_id`;
            CREATE PROCEDURE `get_category_by_id` (IN idx int)
            BEGIN
            SELECT * FROM categories AS C INNER JOIN parts AS P ON P.category_id=C.id;
            END;";

        // $procedure = "DROP PROCEDURE IF EXISTS `get_category_by_id`;
        // CREATE PROCEDURE `get_category_by_id` (IN idx int)
        // BEGIN
        // SELECT * FROM categories AS C INNER JOIN parts AS P ON P.category_id=C.id WHERE C.id = idx;
        // END;";
        DB::unprepared($procedure);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('get_category_parts');
    }
}
