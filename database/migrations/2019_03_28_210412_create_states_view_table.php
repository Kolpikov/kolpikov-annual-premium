<?php

use Illuminate\Database\Migrations\Migration;

class CreateStatesViewTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement($this->dropView());
        DB::statement($this->createView());
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement($this->dropView());
    }

    /**
     * @return string
     */
    protected function createView(): string
    {
        return "CREATE VIEW states_view AS
                SELECT *,
                       ROUND((SELECT AVG((min_ann_prem + max_ann_prem) / 2)
                              FROM annual_premiums
                              WHERE state_id = states.id), 2) as ann_prem
                FROM states";
    }

    /**
     * @return string
     */
    protected function dropView(): string
    {
        return "DROP VIEW IF EXISTS `states_view`";
    }
}
