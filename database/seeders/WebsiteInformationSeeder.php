<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\Product;
use App\Models\ProductFeature;
use App\Models\Service;
use App\Models\TeamMember;
use App\Models\Testimonial;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class WebsiteInformationSeeder extends Seeder
{
    public function run(): void
    {
        $tables = [
            'product_sections',
            'product_features',
            'products',
            'services',
            'clients',
            'testimonials',
            'team_members',
        ];

        Schema::disableForeignKeyConstraints();
        foreach ($tables as $table) {
            DB::table($table)->truncate();
        }
        Schema::enableForeignKeyConstraints();

        $this->seedProducts();
        $this->seedServices();
        $this->seedClients();
        $this->seedTestimonials();
        $this->seedTeamMembers();

        $this->command->info('Website information seeded successfully.');
        $this->command->info('Products: ' . Product::count());
        $this->command->info('Services: ' . Service::count());
        $this->command->info('Clients: ' . Client::count());
        $this->command->info('Testimonials: ' . Testimonial::count());
        $this->command->info('Team Members: ' . TeamMember::count());
    }

    protected function seedProducts(): void
    {
        $modules = [
            [
                'name' => 'Reception',
                'category' => Product::CAT_PATIENT_JOURNEY,
                'tagline' => 'Streamline front-desk patient registration and queue handling.',
                'description' => 'Reception operations are simplified with a digital, role-based workflow that reduces wait times and improves patient experience from the first interaction.',
                'features' => ['Fast check-in', 'Queue visibility', 'Appointment coordination'],
            ],
            [
                'name' => 'OPD Management',
                'category' => Product::CAT_PATIENT_JOURNEY,
                'tagline' => 'Coordinate outpatient services with smart scheduling and tracking.',
                'description' => 'Outpatient workflows are automated to keep consultation, follow-up, and departmental coordination aligned in real time.',
                'features' => ['Appointment scheduling', 'Visit tracking', 'Doctor workflow support'],
            ],
            [
                'name' => 'IPD Management',
                'category' => Product::CAT_PATIENT_JOURNEY,
                'tagline' => 'Manage inpatient care from admission to discharge.',
                'description' => 'Inpatient operations are supported by a unified workflow for bed management, admission, ward activity, and discharge planning.',
                'features' => ['Bed management', 'Admission workflow', 'Discharge planning'],
            ],
            [
                'name' => 'Emergency Management',
                'category' => Product::CAT_CLINICAL,
                'tagline' => 'Support emergency response with fast, coordinated triage.',
                'description' => 'Emergency departments gain rapid visibility into patient arrivals, triage, and treatment coordination for better response times.',
                'features' => ['Triage management', 'Rapid patient intake', 'Department coordination'],
            ],
            [
                'name' => 'Laboratory Management',
                'category' => Product::CAT_DIAGNOSTICS,
                'tagline' => 'Digitize lab workflows for faster reporting and better traceability.',
                'description' => 'The laboratory module helps manage samples, requests, reports, and turnaround time from one connected platform.',
                'features' => ['Sample tracking', 'Result entry', 'Turnaround reporting'],
            ],
            [
                'name' => 'Pharmacy Management',
                'category' => Product::CAT_CLINICAL,
                'tagline' => 'Improve drug dispensing and inventory control from intake to issue.',
                'description' => 'Pharmacy teams benefit from connected dispensing, stock visibility, and order tracking that speeds up service delivery.',
                'features' => ['Prescription handling', 'Inventory control', 'Dispensing audit trail'],
            ],
            [
                'name' => 'Radiology Management',
                'category' => Product::CAT_DIAGNOSTICS,
                'tagline' => 'Coordinate imaging workflows end to end.',
                'description' => 'Radiology operations are streamlined through request management, image tracking, reporting, and integrated diagnostics workflows.',
                'features' => ['Exam requests', 'Image workflow', 'Reporting dashboard'],
            ],
            [
                'name' => 'Billing & Accounts',
                'category' => Product::CAT_ADMINISTRATION,
                'tagline' => 'Automate billing and financial workflows with confidence.',
                'description' => 'Billing and accounts are connected to patient activity and service delivery to support faster financial close and better control.',
                'features' => ['Invoice automation', 'Payment tracking', 'Financial reporting'],
            ],
            [
                'name' => 'Inventory & Procurement',
                'category' => Product::CAT_OPERATIONS,
                'tagline' => 'Control stocks, purchasing, and supplies from one place.',
                'description' => 'Procurement and inventory workflows are simplified for better planning, fewer stockouts, and stronger audits.',
                'features' => ['Stock control', 'Purchase requests', 'Supplier tracking'],
            ],
            [
                'name' => 'HR & Payroll',
                'category' => Product::CAT_ADMINISTRATION,
                'tagline' => 'Manage staff records and payroll with built-in compliance.',
                'description' => 'Human resources and payroll processes are connected to provide structured staff records, attendance, and salary workflows.',
                'features' => ['Staff records', 'Attendance tracking', 'Payroll processing'],
            ],
            [
                'name' => 'Electronic Medical Records',
                'category' => Product::CAT_CLINICAL,
                'tagline' => 'Create a single patient record for complete clinical continuity.',
                'description' => 'Clinical information is consolidated into a unified electronic medical record that improves continuity of care and decision support.',
                'features' => ['Unified patient records', 'Clinical documentation', 'Secure access'],
            ],
            [
                'name' => 'PACS',
                'category' => Product::CAT_DIAGNOSTICS,
                'tagline' => 'Store and share medical imaging securely and efficiently.',
                'description' => 'The PACS module supports image archiving, viewing, and secure distribution across the hospital network.',
                'features' => ['Image archiving', 'Remote access', 'Secure sharing'],
            ],
        ];

        foreach ($modules as $index => $module) {
            $product = Product::create([
                'name' => $module['name'],
                'slug' => Str::slug($module['name']),
                'category' => $module['category'],
                'category_label' => Product::CATEGORIES[$module['category']] ?? ucfirst($module['category']),
                'cat_label' => Product::CATEGORIES[$module['category']] ?? ucfirst($module['category']),
                'icon' => '🏥',
                'tagline' => $module['tagline'],
                'description' => $module['description'],
                'features' => $module['features'],
                'sort_order' => $index + 1,
                'is_active' => true,
                'is_published' => true,
                'badge_bg' => 'bg-crimson-500/10',
                'badge_text' => 'text-crimson-600',
                'card_bg' => 'bg-white',
                'card_text' => 'text-gray-900',
                'accent_bg' => 'bg-crimson-500',
                'seo' => [
                    'title' => $module['name'] . ' | REDSOL HIS',
                    'description' => $module['tagline'],
                ],
            ]);

            foreach ($module['features'] as $featureIndex => $featureText) {
                ProductFeature::create([
                    'product_id' => $product->id,
                    'feature_text' => $featureText,
                    'sort_order' => $featureIndex + 1,
                ]);
            }

            $this->seedProductSections($product);
        }
    }

    protected function seedProductSections(Product $product): void
    {
        $sections = [
            [
                'section_type' => 'hero',
                'sort_order' => 1,
                'settings' => [
                    'show_badge' => true,
                    'show_cta' => true,
                    'cta_label' => 'Request a Demo',
                    'cta_link' => '/contact',
                ],
            ],
            [
                'section_type' => 'overview',
                'sort_order' => 2,
                'settings' => [
                    'heading' => 'Module Overview',
                ],
            ],
            [
                'section_type' => 'features_grid',
                'sort_order' => 3,
                'settings' => [
                    'heading' => 'Key Features',
                    'columns' => 2,
                ],
            ],
            [
                'section_type' => 'integration',
                'sort_order' => 4,
                'settings' => [
                    'heading' => 'Integration Points',
                ],
            ],
            [
                'section_type' => 'cta',
                'sort_order' => 5,
                'settings' => [
                    'heading' => 'Ready to modernise this workflow?',
                    'sub' => 'Talk to our implementation team about deploying this module in your hospital.',
                    'btn_label' => 'Schedule a Demo',
                    'btn_link' => '/contact',
                ],
            ],
        ];

        foreach ($sections as $section) {
            $product->sections()->create($section);
        }
    }

    protected function seedServices(): void
    {
        $items = [
            [
                'name' => 'Hardware Solutions',
                'tagline' => 'Reliable infrastructure deployment for healthcare environments.',
                'description' => 'We install servers, workstations, storage, printers, and barcode systems tailored to hospital operations.',
                'icon' => '🖥️',
                'tag' => Service::TAG_HIS,
                'features' => ['Server installation', 'Printer setup', 'Storage solutions', 'Barcode and label printing'],
                'is_featured' => true,
            ],
            [
                'name' => 'Software Development',
                'tagline' => 'Custom digital systems built for healthcare and business needs.',
                'description' => 'Our team builds hospital management systems, ERP solutions, web applications, mobile apps, and database platforms.',
                'icon' => '💻',
                'tag' => Service::TAG_CUSTOM,
                'features' => ['Hospital management systems', 'Custom ERP solutions', 'Web and mobile applications', 'Database management'],
                'is_featured' => true,
            ],
            [
                'name' => 'Networking',
                'tagline' => 'Secure and scalable connectivity across clinics and hospitals.',
                'description' => 'We provide LAN and WAN design, structured cabling, wireless networking, VPNs, firewall integration, and remote access solutions.',
                'icon' => '🌐',
                'tag' => Service::TAG_SUPPORT,
                'features' => ['LAN/WAN setup', 'Structured cabling', 'VPN and remote access', 'Firewall integration'],
                'is_featured' => false,
            ],
            [
                'name' => 'Security & Support',
                'tagline' => 'Protect systems with access control, hardening, and backup strategy.',
                'description' => 'We provide endpoint security, server hardening, network monitoring, backup, disaster recovery, and security audits.',
                'icon' => '🔐',
                'tag' => Service::TAG_SUPPORT,
                'features' => ['Security audits', 'Access control', 'Backup and recovery', 'Monitoring and hardening'],
                'is_featured' => true,
            ],
        ];

        foreach ($items as $index => $item) {
            Service::create([
                'name' => $item['name'],
                'slug' => Str::slug($item['name']),
                'tagline' => $item['tagline'],
                'description' => $item['description'],
                'icon' => $item['icon'],
                'tag' => $item['tag'],
                'features' => $item['features'],
                'sort_order' => $index + 1,
                'is_active' => true,
                'is_featured' => $item['is_featured'],
                'meta_title' => $item['name'] . ' | REDSOL',
                'meta_description' => $item['tagline'],
            ]);
        }
    }

    protected function seedClients(): void
    {
        $items = [
            ['name' => 'University of Lahore Teaching Hospital', 'city' => 'Lahore', 'province' => 'Punjab', 'type' => Client::TYPE_GOVERNMENT, 'is_featured' => true, 'year_deployed' => null],
            ['name' => 'Hoora Pharma', 'city' => 'Lahore', 'province' => 'Punjab', 'type' => Client::TYPE_PRIVATE, 'is_featured' => false, 'year_deployed' => null],
            ['name' => 'Furqan Hospital Lahore', 'city' => 'Lahore', 'province' => 'Punjab', 'type' => Client::TYPE_PRIVATE, 'is_featured' => false, 'year_deployed' => null],
            ['name' => 'Sahiwal International Hospital', 'city' => 'Sahiwal', 'province' => 'Punjab', 'type' => Client::TYPE_PRIVATE, 'is_featured' => false, 'year_deployed' => null],
            ['name' => 'Zainee\'s Aesthetics (Dental Clinic & Nail Bar)', 'city' => 'Lahore', 'province' => 'Punjab', 'type' => Client::TYPE_PRIVATE, 'is_featured' => false, 'year_deployed' => null],
            ['name' => 'Tahir Medical Center', 'city' => 'Lahore', 'province' => 'Punjab', 'type' => Client::TYPE_PRIVATE, 'is_featured' => false, 'year_deployed' => null],
            ['name' => 'University of Lahore Dental Hospital Thokar Niaz Baig', 'city' => 'Lahore', 'province' => 'Punjab', 'type' => Client::TYPE_PRIVATE, 'is_featured' => false, 'year_deployed' => null],
            ['name' => 'Sehat Medical Complex Lake City', 'city' => 'Lahore', 'province' => 'Punjab', 'type' => Client::TYPE_PRIVATE, 'is_featured' => false, 'year_deployed' => null],
            ['name' => 'Sehat Medical Complex Hanjarwal', 'city' => 'Lahore', 'province' => 'Punjab', 'type' => Client::TYPE_PRIVATE, 'is_featured' => false, 'year_deployed' => null],
            ['name' => 'Amna Inayat Medical College Sheikhupura', 'city' => 'Sheikhupura', 'province' => 'Punjab', 'type' => Client::TYPE_PRIVATE, 'is_featured' => false, 'year_deployed' => null],
            ['name' => 'Kishwar Fazal Teaching Hospital Sheikhupura', 'city' => 'Sheikhupura', 'province' => 'Punjab', 'type' => Client::TYPE_PRIVATE, 'is_featured' => false, 'year_deployed' => null],
            ['name' => 'Faryal Dental Hospital Sheikhupura', 'city' => 'Sheikhupura', 'province' => 'Punjab', 'type' => Client::TYPE_PRIVATE, 'is_featured' => false, 'year_deployed' => null],
            ['name' => 'Mayo Hospital Lahore', 'city' => 'Lahore', 'province' => 'Punjab', 'type' => Client::TYPE_GOVERNMENT, 'is_featured' => true, 'year_deployed' => null],
            ['name' => 'Jinnah Hospital Lahore', 'city' => 'Lahore', 'province' => 'Punjab', 'type' => Client::TYPE_GOVERNMENT, 'is_featured' => false, 'year_deployed' => null],
            ['name' => 'Bahawalpur Victoria Hospital', 'city' => 'Bahawalpur', 'province' => 'Punjab', 'type' => Client::TYPE_GOVERNMENT, 'is_featured' => false, 'year_deployed' => null],
            ['name' => 'Sir Ganga Ram Hospital', 'city' => 'Lahore', 'province' => 'Punjab', 'type' => Client::TYPE_PRIVATE, 'is_featured' => true, 'year_deployed' => null],
            ['name' => 'The Children\'s Hospital Lahore', 'city' => 'Lahore', 'province' => 'Punjab', 'type' => Client::TYPE_GOVERNMENT, 'is_featured' => false, 'year_deployed' => null],
            ['name' => 'Sahiwal Teaching Hospital', 'city' => 'Sahiwal', 'province' => 'Punjab', 'type' => Client::TYPE_GOVERNMENT, 'is_featured' => false, 'year_deployed' => null],
            ['name' => 'Sehat Medical Complex', 'city' => 'Lahore', 'province' => 'Punjab', 'type' => Client::TYPE_PRIVATE, 'is_featured' => false, 'year_deployed' => null],
        ];

        foreach ($items as $index => $item) {
            Client::create([
                'name' => $item['name'],
                'city' => $item['city'],
                'province' => $item['province'],
                'type' => $item['type'],
                'is_featured' => $item['is_featured'],
                'is_active' => true,
                'sort_order' => $index + 1,
                'website_url' => null,
                'year_deployed' => $item['year_deployed'],
            ]);
        }
    }

    protected function seedTestimonials(): void
    {
        Testimonial::create([
            'quote' => 'REDSOL Technologies has transformed our hospital workflow through a reliable HMIS solution and excellent technical support.',
            'author_name' => 'Hospital Leadership Team',
            'author_role' => 'Administrative Leadership',
            'author_initials' => 'HL',
            'hospital' => 'Partner Hospital',
            'avatar_gradient' => 'from-crimson-500 to-crimson-700',
            'rating' => 5,
            'is_active' => true,
            'is_featured' => true,
            'sort_order' => 1,
        ]);
    }

    protected function seedTeamMembers(): void
    {
        $members = [
            [
                'name' => 'Shazil Mahmood',
                'position' => 'Co-Founder / CTO',
                'department' => 'Technology',
                'bio' => 'Leads product architecture and delivery strategy for REDSOL healthcare solutions.',
                'social_links' => ['linkedin' => '#'],
                'is_visible' => true,
                'is_leadership' => true,
                'sort_order' => 1,
            ],
            [
                'name' => 'Ahmer Poswal',
                'position' => 'Co-Founder / CEO',
                'department' => 'Leadership',
                'bio' => 'Drives business growth, partnerships, and client success across healthcare projects.',
                'social_links' => ['linkedin' => '#'],
                'is_visible' => true,
                'is_leadership' => true,
                'sort_order' => 2,
            ],
        ];

        foreach ($members as $index => $member) {
            TeamMember::create([
                'name' => $member['name'],
                'position' => $member['position'],
                'department' => $member['department'],
                'bio' => $member['bio'],
                'social_links' => $member['social_links'],
                'sort_order' => $index + 1,
                'is_visible' => $member['is_visible'],
                'is_leadership' => $member['is_leadership'],
            ]);
        }
    }
}
