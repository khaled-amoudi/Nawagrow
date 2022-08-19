<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateViewCategoryParts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // $procedure = "CREATE VIEW category_parts
        // SELECT c.name, p.name
        // FROM categories AS c INNER JOIN parts AS p
        // WHERE c.id = p.category_id
        // ";
        $procedure = "CREATE VIEW view_category_parts
        AS
        SELECT p.*, c.name as category_name FROM categories AS c INNER JOIN parts AS p ON p.category_id = c.id";

        DB::unprepared($procedure);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('view_category_parts');
    }
}
