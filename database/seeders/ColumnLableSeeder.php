<?php

namespace Database\Seeders;

use App\Models\ColumnLables;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ColumnLableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tables = Schema::getAllTables();
        foreach ($tables as $key => $table) {
            $label = "Tables_in_" . env('DB_DATABASE');
            $name = $label;
            $table_columns = Schema::getColumnListing($name);
            $exclude_columns = [
                'id',
            ];
            $app = array_diff($table_columns, (array) $exclude_columns);

            foreach ($app as $value){
                $newUser = ColumnLables::updateOrCreate([
                    'key'   => $value,
                ],[
                    'table_name'     =>$name,
                    'value'     => '',
                ]);
            }
        }
    }
}
