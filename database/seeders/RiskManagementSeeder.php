<?php

namespace Database\Seeders;

use App\Models\Configuration;
use App\Models\ConsequenceLevel;
use App\Models\GapRating;
use App\Models\RiskRating;
use App\Models\SecurityControl;
use App\Models\ThreatLevel;
use Illuminate\Database\Seeder;

class RiskManagementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Configuration::updateOrCreate(
            [
                "name" => "threat_level"
            ],
            [
                "value" => ".8"
            ]
        );
        Configuration::updateOrCreate(
            [
                "name" => "consequence_level"
            ],
            [
                "value" => ".8"
            ]
        );

        ThreatLevel::updateOrCreate(
            [
                "name" => "Very Low"
            ],
            [
                "value" => .2
            ]
        );

        ThreatLevel::updateOrCreate(
            [
                "name" => "Low"
            ],
            [
                "value" => .4
            ]
        );

        ThreatLevel::updateOrCreate(
            [
                "name" => "Medium"
            ],
            [
                "value" => .6
            ]
        );

        ThreatLevel::updateOrCreate(
            [
                "name" => "High"
            ],
            [
                "value" => .8
            ]
        );

        ThreatLevel::updateOrCreate(
            [
                "name" => "Very High"
            ],
            [
                "value" => 1
            ]
        );

        ConsequenceLevel::updateOrCreate(
            [
                "name" => "Minor"
            ],
            [
                "value" => .2
            ]
        );

        ConsequenceLevel::updateOrCreate(
            [
                "name" => "Some disruption Possible"
            ],
            [
                "value" => .4
            ]
        );

        ConsequenceLevel::updateOrCreate(
            [
                "name" => "Significant time and resources required"
            ],
            [
                "value" => .6
            ]
        );

        ConsequenceLevel::updateOrCreate(
            [
                "name" => "Operations severely damaged"
            ],
            [
                "value" => .8
            ]
        );

        ConsequenceLevel::updateOrCreate(
            [
                "name" => "Business survival at risk"
            ],
            [
                "value" => 1
            ]
        );

        SecurityControl::updateOrCreate(
            [
                "name" => "Very Low criticality"
            ],
            [
                "value" => 1
            ]
        );

        SecurityControl::updateOrCreate(
            [
                "name" => "Low criticality"
            ],
            [
                "value" => 2
            ]
        );

        SecurityControl::updateOrCreate(
            [
                "name" => "Medium criticality"
            ],
            [
                "value" => 3
            ]
        );

        SecurityControl::updateOrCreate(
            [
                "name" => "High criticality"
            ],
            [
                "value" => 4
            ]
        );

        SecurityControl::updateOrCreate(
            [
                "name" => "Very High criticality"
            ],
            [
                "value" => 5
            ]
        );

        GapRating::updateOrCreate(
            [
                "name" => "Fully Implemented"
            ],
            [
                "value" => 1
            ]
        );

        GapRating::updateOrCreate(
            [
                "name" => "Largly Implemented"
            ],
            [
                "value" => 2
            ]
        );

        GapRating::updateOrCreate(
            [
                "name" => "Partially Implemented"
            ],
            [
                "value" => 3
            ]
        );

        GapRating::updateOrCreate(
            [
                "name" => "Not evaluated"
            ],
            [
                "value" => 4
            ]
        );

        GapRating::updateOrCreate(
            [
                "name" => "Not implemented"
            ],
            [
                "value" => 5
            ]
        );

        RiskRating::updateOrCreate(
            [
                "name" => "Very Low"
            ],
            [
                "from" => 1,
                "to" => 5,
                "color" => "#92D050",
            ]
        );

        RiskRating::updateOrCreate(
            [
                "name" => "Low"
            ],
            [
                "from" => 5,
                "to" => 10,
                "color" => "#c6bebe",
            ]
        );

        RiskRating::updateOrCreate(
            [
                "name" => "Medium"
            ],
            [
                "from" => 10,
                "to" => 15,
                "color" => "#f4f414",
            ]
        );

        RiskRating::updateOrCreate(
            [
                "name" => "High"
            ],
            [
                "from" => 15,
                "to" => 20,
                "color" => "#FFC000",
            ]
        );

        RiskRating::updateOrCreate(
            [
                "name" => "Critical"
            ],
            [
                "from" => 20,
                "to" => 25,
                "color" => "#FF0000",
            ]
        );

    }
}
