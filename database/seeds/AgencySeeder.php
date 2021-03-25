<?php

use Illuminate\Database\Seeder;
use App\agency;

class AgencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('agency')->delete();
        $json = File::get("database/data/agencies.json");
        $data = json_decode($json);
        foreach ($data as $obj) {
          Agency::create(array(
            'id' => $obj->id,
            'name' => $obj->name,
            'code' => $obj->code,
            'agencygroup' => $obj->agencygroup,
            'agencyhead' => $obj->agencyhead,
            'emailhead' => $obj->emailhead
          ));
        }
    }
}
