<?php

use Illuminate\Database\Migrations\Migration;

class CreateAnnualPremiumsViewTable extends Migration
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
        return "CREATE VIEW annual_premiums_view AS
                SELECT
                       state_id,
                       age,
                       gender_id,
                       ROUND(AVG(ap.min_ann_prem),2) as min_ann_prem,
                       ROUND(AVG(ap.max_ann_prem),2) as max_ann_prem,
                       ROUND(AVG((ap.min_ann_prem + ap.max_ann_prem) / 2),2) as avg_ann_prem
                FROM annual_premiums AS ap
                GROUP BY ap.state_id, ap.age, ap.gender_id";
    }

    /**
     * @return string
     */
    protected function dropView(): string
    {
        return "DROP VIEW IF EXISTS `annual_premiums_view`";
    }
}
