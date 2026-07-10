<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Project;
use App\Models\Service;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Faker\Factory as Faker;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('en_PK'); // Pakistani locale for realistic data

        $hospitalNames = [
            'Sheikh Zayed Hospital',
            'Bahawal Victoria Hospital',
            'Civil Hospital',
            'PIMS - Pakistan Institute of Medical Sciences',
            'Services Hospital',
            'Jinnah Hospital',
            'Allied Hospital',
            'DHQ Hospital',
            'Nishtar Hospital',
            'CMH - Combined Military Hospital',
            'Mayo Hospital',
            'Holy Family Hospital',
            'Lady Reading Hospital',
            'Khyber Teaching Hospital',
            'Rehman Medical Institute',
            'Aga Khan University Hospital',
            'Shaukat Khanum Memorial Cancer Hospital',
            'Indus Hospital',
            'National Institute of Cardiovascular Diseases',
            'Children Hospital',
        ];

        $cities = [
            'Lahore',
            'Karachi',
            'Islamabad',
            'Rawalpindi',
            'Faisalabad',
            'Multan',
            'Peshawar',
            'Quetta',
            'Sialkot',
            'Gujranwala',
            'Hyderabad',
            'Sukkur',
            'Bahawalpur',
            'Rahim Yar Khan',
            'Sargodha',
        ];

        $provinces = ['Punjab', 'Sindh', 'Khyber Pakhtunkhwa', 'Balochistan', 'Islamabad Capital Territory'];

        $clientTypes = [
            Project::TYPE_GOVERNMENT,
            Project::TYPE_PRIVATE,
            Project::TYPE_SEMI_GOVERNMENT,
            Project::TYPE_NGO,
        ];

        // Module slugs (must match Product::slug values in your DB)
        $moduleSlugs = [
            'patient-registration',
            'appointment-system',
            'emergency-management',
            'opd-management',
            'ipd-management',
            'pharmacy-management',
            'laboratory-lims',
            'radiology-ris',
            'pacs-integration',
            'billing-invoicing',
            'inventory-management',
            'hr-payroll',
            'telemedicine',
            'mobile-app',
            'analytics-dashboard',
            'voice-reporting',
            'icd10-coding',
            'dicom-compression',
        ];

        // Service slugs (must match Service::slug values)
        $serviceSlugs = [
            'his-implementation',
            'custom-development',
            'amc-support',
            'consulting',
        ];

        $outcomesPool = [
            'Reduced patient wait time by 60%',
            'Digitized 100% of patient records',
            'Integrated 15+ hospital departments',
            'Enabled real-time bed availability tracking',
            'Automated billing reduced revenue leakage by 35%',
            'Improved diagnostic report turnaround by 70%',
            'Achieved 99.9% system uptime',
            'Trained 200+ hospital staff members',
            'Reduced paper consumption by 90%',
            'Enabled remote consultations for rural patients',
            'Streamlined pharmacy inventory management',
            'Implemented ICD-10 compliant coding system',
            'Integrated PACS for instant image access',
            'Deployed mobile app for patient portal access',
            'Achieved HIPAA-equivalent data security standards',
        ];

        $statsPool = [
            ['beds' => '500+'],
            ['patients_daily' => '2,000+'],
            ['departments' => '25+'],
            ['doctors' => '150+'],
            ['modules' => '18'],
            ['uptime' => '99.9%'],
            ['staff_trained' => '300+'],
            ['go_live' => '6 months'],
            ['cost_savings' => '40%'],
            ['satisfaction' => '95%'],
        ];

        Project::truncate(); // Optional: clear existing data

        for ($i = 1; $i <= 20; $i++) {
            $clientType = $faker->randomElement($clientTypes);
            $city = $faker->randomElement($cities);
            $province = in_array($city, ['Lahore', 'Faisalabad', 'Multan', 'Sialkot', 'Gujranwala', 'Bahawalpur', 'Rahim Yar Khan', 'Sargodha'])
                ? 'Punjab'
                : (in_array($city, ['Karachi', 'Hyderabad', 'Sukkur'])
                    ? 'Sindh'
                    : (in_array($city, ['Peshawar'])
                        ? 'Khyber Pakhtunkhwa'
                        : ($city === 'Quetta' ? 'Balochistan' : 'Islamabad Capital Territory')));

            $startDate = Carbon::parse($faker->dateTimeBetween('-3 years', '-6 months'));
            $completionDate = Carbon::parse($faker->dateTimeBetween($startDate, 'now'));
            $durationMonths = $startDate->diffInMonths($completionDate) ?: $faker->numberBetween(3, 18);

            $title = $faker->randomElement($hospitalNames) . ' — ' .
                $faker->randomElement(['HIS Implementation', 'Digital Transformation', 'Module Deployment', 'System Upgrade']);

            // Ensure unique slug
            $slugBase = Str::slug($title);
            $slug = $slugBase;
            $counter = 1;
            while (DB::table('projects')->where('slug', $slug)->exists()) {
                $slug = $slugBase . '-' . $counter++;
            }

            Project::create([
                'title' => $title,
                'slug' => $slug,
                'client_name' => $faker->randomElement($hospitalNames) . ' ' . $faker->randomElement(['', 'Main Campus', 'Satellite Unit', 'Specialist Wing']),
                'client_city' => $city,
                'client_province' => $province,
                'client_type' => $clientType,

                'summary' => $faker->randomElement([
                    "Complete HIS deployment across {$city}'s leading public hospital, digitizing patient workflows from registration to discharge.",
                    "Custom software solution enabling seamless integration of laboratory, radiology, and pharmacy systems for improved care coordination.",
                    "End-to-end digital transformation reducing administrative overhead by 45% while improving patient satisfaction scores.",
                    "Scalable HIS architecture supporting multi-branch operations with centralized reporting and decentralized workflows.",
                    "Modernization initiative replacing legacy systems with cloud-ready, ICD-10 compliant healthcare management platform.",
                ]),

                'description' => "<p>{$faker->paragraph(3)}</p>\n\n" .
                    "<h4>Key Deliverables</h4>\n<ul>" .
                    collect(range(1, 4))->map(fn() => "<li>{$faker->sentence(8)}</li>")->implode("\n") .
                    "</ul>\n\n<p>{$faker->paragraph(2)}</p>",

                'modules_deployed' => $faker->randomElements($moduleSlugs, $faker->numberBetween(5, 12)),
                'services_provided' => $faker->randomElements($serviceSlugs, $faker->numberBetween(1, 3)),

                'outcomes' => $faker->randomElements($outcomesPool, $faker->numberBetween(3, 6)),
                'stats' => collect($faker->randomElements($statsPool, $faker->numberBetween(2, 4)))
                    ->collapse()
                    ->toArray(),

                'featured_image' => $faker->numberBetween(1, 10) <= 7
                    ? 'projects/hospital-' . $faker->numberBetween(1, 8) . '.jpg'
                    : null,
                'featured_image_alt' => $title . ' - REDSOL Healthcare Project',

                'gallery' => $faker->numberBetween(1, 10) <= 5
                    ? collect(range(1, $faker->numberBetween(2, 5)))
                        ->map(fn($n) => 'projects/gallery/' . $slug . '-' . $n . '.jpg')
                        ->toArray()
                    : [],

                'start_date' => $startDate,
                'completion_date' => $faker->boolean(80) ? $completionDate : null,
                'duration_months' => $durationMonths,


                'meta_title' => $faker->boolean(70) ? null : $title . ' | REDSOL HIS Success Story',
                'meta_description' => $faker->boolean(70) ? null : Str::limit("Learn how REDSOL transformed {$city}'s healthcare delivery with our integrated HIS solution.", 155),

                'is_active' => true,
                'is_featured' => $faker->boolean(25),
                'sort_order' => $i,
            ]);
        }

        $this->command->info('✓ Seeded 20 random Project entries');
    }
}