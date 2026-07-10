<?php

namespace Database\Seeders;

// database/seeders/HisModuleExpandedSectionsSeeder.php

use App\Models\HisModule;
use App\Models\HisModuleSection;
use Illuminate\Database\Seeder;

class HisModuleExpandedSectionsSeeder extends Seeder
{
    public function run(): void
    {
        $this->seedLims();
        $this->seedRadiology();
        $this->seedPacs();
        $this->seedPharmacy();
        $this->seedPatientRegistration();
        $this->seedBilling();
        $this->seedEmergency();
        $this->seedAdmissionDischarge();
        $this->seedNursingWards();
        $this->seedOT();
        $this->seedOPD();
        $this->seedAppointment();
        $this->seedQueue();
        $this->seedWelfare();
        $this->seedInventory();
        $this->seedGynecology();
        $this->seedDialysis();
        $this->seedDoctorShare();
        $this->seedSystemSecurity();
        $this->seedFrontDesk();
        $this->seedStatsDashboard();
        $this->seedHR();
        $this->seedAssets();
        $this->seedVoiceReporting();
    }

    private function addSections(string $slug, array $sections): void
    {
        $module = HisModule::where('slug', $slug)->first();
        if (!$module)
            return;

        // Set starting sort_order after existing sections
        $maxOrder = $module->sections()->max('sort_order') ?? 5;

        foreach ($sections as $i => $section) {
            $section['sort_order'] = $maxOrder + $i + 1;
            $module->sections()->create($section);
        }
    }

    private function seedLims(): void
    {
        $this->addSections('laboratory-lims', [
            [
                'section_type' => 'image_banner',
                'is_active' => true,
                'settings' => [
                    'heading' => 'Laboratory Dashboard',
                    'image_url' => 'https://images.unsplash.com/photo-1579165466741-7f35e4755660?w=1200&q=80',
                    'image_alt' => 'Laboratory Information Management System Dashboard',
                    'caption' => 'Real-time specimen tracking, worklist management, and result verification in a single workflow.',
                ],
            ],
            [
                'section_type' => 'stats',
                'is_active' => true,
                'settings' => [
                    'heading' => 'Laboratory Performance at a Glance',
                    'stats' => [
                        ['value' => '40%', 'label' => 'Reduction in result turnaround time'],
                        ['value' => '99.8%', 'label' => 'Sample identification accuracy with barcodes'],
                        ['value' => '0', 'label' => 'Manual re-entry between analyzer and HIS'],
                        ['value' => '24/7', 'label' => 'Web-based report access for patients'],
                    ],
                ],
            ],
            [
                'section_type' => 'workflow',
                'is_active' => true,
                'settings' => [
                    'heading' => 'Laboratory Workflow — From Order to Report',
                    'subheading' => 'Every step of the specimen lifecycle is tracked, timestamped, and auditable.',
                    'steps' => [
                        [
                            'title' => 'Test Order Entry',
                            'description' => 'A clinician submits a test request from OPD, Emergency, Ward, or an external collection center. The request is validated against the patient\'s record and billing category before proceeding.',
                            'note' => 'Orders from wards include bed number and ward location automatically.',
                        ],
                        [
                            'title' => 'Sample Accession & Barcoding',
                            'description' => 'The LIMS groups related tests into a single accession number. Barcoded sticker labels are printed per tube type (e.g., red top, EDTA, citrate). The phlebotomist scans labels with a wand at the time of collection to confirm identity.',
                        ],
                        [
                            'title' => 'Specimen Routing & Worklist Assignment',
                            'description' => 'Samples are distributed to the appropriate section — biochemistry, haematology, microbiology, histopathology, etc. Digital worklists update automatically when samples arrive at each bench.',
                        ],
                        [
                            'title' => 'Analyzer Processing & Interface',
                            'description' => 'Results are captured directly from automated analyzers via a bidirectional computer interface. The LIMS can suppress parameters that are not relevant to the ordered test profile, reducing noise in result entry.',
                        ],
                        [
                            'title' => 'QC Validation & Delta Checks',
                            'description' => 'Before any result is approved, the system runs QC rule checks. Delta values (absolute and percentage change from prior results) are evaluated. If a critical value threshold is crossed, an alert is raised immediately.',
                        ],
                        [
                            'title' => 'Verification & Electronic Sign-off',
                            'description' => 'The pathologist or senior technologist reviews the result list, adds comments or opinions where needed, and applies an electronic signature. Once verified, reports are locked — only addendums are permitted thereafter.',
                        ],
                        [
                            'title' => 'Report Delivery',
                            'description' => 'Verified reports are instantly available to the requesting clinician via the HIS, and to the patient via the online portal using their unique login generated at registration. Phlebotomy turn numbers are printed on invoices for patient reference.',
                        ],
                    ],
                ],
            ],
            [
                'section_type' => 'user_roles',
                'is_active' => true,
                'settings' => [
                    'heading' => 'Roles & Responsibilities in the Laboratory',
                    'roles' => [
                        [
                            'role' => 'Lab Receptionist',
                            'icon' => '📋',
                            'responsibilities' => [
                                'Accept walk-in and online test orders',
                                'Register patients and assign UMRN if new',
                                'Print barcoded tube labels and patient slips',
                                'Manage collection center coordination',
                            ],
                        ],
                        [
                            'role' => 'Phlebotomist',
                            'icon' => '💉',
                            'responsibilities' => [
                                'Collect specimens using barcoded tube labels',
                                'Scan tubes with wand to confirm identity',
                                'Transport specimens to relevant sections',
                                'Record specimen adequacy notes',
                            ],
                        ],
                        [
                            'role' => 'Lab Technologist',
                            'icon' => '🔬',
                            'responsibilities' => [
                                'Process samples and run analyzer tests',
                                'Enter and verify results in the LIMS',
                                'Manage QC controls and instrument calibration',
                                'Flag and escalate critical values immediately',
                            ],
                        ],
                        [
                            'role' => 'Pathologist',
                            'icon' => '👨‍⚕️',
                            'responsibilities' => [
                                'Review complex or critical results',
                                'Apply electronic signature to verified reports',
                                'Add clinical comments and interpretations',
                                'Manage department QC and audit compliance',
                            ],
                        ],
                        [
                            'role' => 'Lab Administrator',
                            'icon' => '⚙️',
                            'responsibilities' => [
                                'Configure tests, reference ranges, and tube codes',
                                'Manage analyzer interfaces and instrument settings',
                                'Set QC rules, delta thresholds, and critical values',
                                'Generate TAT, workload, and productivity reports',
                            ],
                        ],
                        [
                            'role' => 'IT / Interface Engineer',
                            'icon' => '🖥️',
                            'responsibilities' => [
                                'Maintain analyzer-to-LIMS bidirectional interfaces',
                                'Manage LIMS-HIS integration and HL7 messaging',
                                'Oversee backup and disaster recovery systems',
                                'Handle user access and terminal configuration',
                            ],
                        ],
                    ],
                ],
            ],
            [
                'section_type' => 'benefits',
                'is_active' => true,
                'settings' => [
                    'heading' => 'Why REDSOL LIMS Transforms Laboratory Operations',
                    'benefits' => [
                        [
                            'icon' => '⚡',
                            'title' => 'Faster Turnaround Times',
                            'description' => 'Automated analyzer interfaces eliminate manual transcription of results. Critical values trigger instant alerts so clinicians act without delay.',
                            'metric' => 'Up to 40% faster',
                        ],
                        [
                            'icon' => '🔒',
                            'title' => 'Zero Sample Mix-Up',
                            'description' => 'Barcoded tubes scanned at every handling step create an unbroken chain of custody from collection to result, eliminating identity errors that put patients at risk.',
                            'metric' => '99.8% accuracy',
                        ],
                        [
                            'icon' => '📊',
                            'title' => 'Real-Time Quality Control',
                            'description' => 'Built-in QC rules, delta checks, and control limit monitoring ensure that lab-defined standards are met before any result reaches a clinician.',
                            'metric' => 'Auto QC validation',
                        ],
                        [
                            'icon' => '🌐',
                            'title' => 'Anywhere Report Access',
                            'description' => 'Patients access reports via a secure web portal using their unique credentials. Clinicians see results live from any HIS workstation the moment they are verified.',
                            'metric' => '24/7 web access',
                        ],
                        [
                            'icon' => '📁',
                            'title' => 'Full Audit Compliance',
                            'description' => 'Every result edit, verification, and report access is logged with user identity and timestamp. Post-verification changes are only possible as addendums — the original record is immutable.',
                            'metric' => '100% traceable',
                        ],
                        [
                            'icon' => '🔗',
                            'title' => 'External Collection Center Support',
                            'description' => 'The LIMS manages orders from external collection points — tracking samples from remote sites through testing to report delivery without data loss.',
                            'metric' => 'Multi-location ready',
                        ],
                    ],
                ],
            ],
            [
                'section_type' => 'technical_specs',
                'is_active' => true,
                'settings' => [
                    'heading' => 'Technical Specifications',
                    'specs' => [
                        ['label' => 'Architecture', 'value' => 'Client-server with centralized database; web-based report portal'],
                        ['label' => 'Analyzer Interface', 'value' => 'Bidirectional RS-232/TCP-IP interfaces per CLSI standards'],
                        ['label' => 'Coding Systems', 'value' => 'LOINC for observation identifiers; SNOMED CT for histopathology'],
                        ['label' => 'Interoperability', 'value' => 'HL7 v2.x messaging with HIS, RIS, and EMR systems'],
                        ['label' => 'Backup', 'value' => 'Automated disaster recovery with configurable backup schedules'],
                        ['label' => 'Access', 'value' => 'Role-based; terminal/IP/MAC-bound workstation security'],
                        ['label' => 'Reporting', 'value' => 'Thermal, Half-A4, and full-page report formats; barcode labels'],
                        ['label' => 'Languages', 'value' => 'English (additional languages available on client request)'],
                    ],
                    'standards' => [
                        'LOINC',
                        'SNOMED CT',
                        'HL7 v2.x',
                        'CLSI',
                        'IHE LAW',
                        'ISO 15189',
                        'GLP',
                        'HIPAA-aligned',
                        'ICD-10',
                    ],
                    'requirements' => [
                        'Windows Server 2016+ or Linux (Ubuntu 20.04+)',
                        'Minimum 16 GB RAM for the application server',
                        'SQL Server 2019+ or compatible RDBMS',
                        'Dedicated gigabit LAN for analyzer interfaces',
                        'Thermal and laser printer support at workstations',
                    ],
                ],
            ],
            [
                'section_type' => 'documentation',
                'is_active' => true,
                'settings' => [
                    'heading' => 'User Guide & Quick Reference',
                    'intro' => 'This guide covers the most common workflows for each role. A full user manual is provided during implementation and staff training.',
                    'sections' => [
                        [
                            'title' => 'First-Time Setup: Configuring Tests & Reference Ranges',
                            'content' => 'Before going live, the Lab Administrator must configure the test master, including specimen types, tube codes, reference ranges by age and gender, QC control limits, and critical value thresholds. These are set from the administration menu and do not require IT involvement.',
                            'steps' => [
                                'Navigate to Setup → Test Parameters → Test Master',
                                'Add each test with its LOINC code, tube type, and turnaround time',
                                'Set reference ranges per gender/age group in the Range Setup tab',
                                'Configure delta check percentages and critical value limits',
                                'Activate the test and assign it to the relevant section worklist',
                            ],
                        ],
                        [
                            'title' => 'Processing a Walk-In Order',
                            'content' => 'Walk-in patients are handled at the lab reception counter. If the patient is already registered in the HIS, their MRN is used directly. New patients are registered with basic demographics before the order is processed.',
                            'steps' => [
                                'Search patient by MRN, name, CNIC, or phone number',
                                'Select the tests requested and confirm billing category',
                                'System generates accession number and prints tube labels',
                                'Phlebotomist collects specimens and scans barcodes with wand',
                                'Samples delivered to bench; worklist updated automatically',
                            ],
                        ],
                        [
                            'title' => 'Handling Critical Values',
                            'content' => 'When a result crosses a defined critical threshold, the system raises an alert before allowing verification. The lab technologist must acknowledge the alert and notify the ordering physician before the result can be released. This acknowledgement is logged in the audit trail.',
                            'steps' => [
                                'System flags the result in red on the verification screen',
                                'Technologist reads the critical value alert and accepts',
                                'Phone notification is made to the requesting doctor',
                                'Notification details (time, contact person) are recorded',
                                'Result is verified with critical flag visible on the report',
                            ],
                        ],
                        [
                            'title' => 'Adding an Addendum to a Verified Report',
                            'content' => 'Once a report is electronically verified and signed, it cannot be edited directly. Corrections or additional findings must be added as an addendum, which is appended to the original report with a new timestamp and the authorizing user\'s identity. The original verified content remains visible and unmodified.',
                        ],
                        [
                            'title' => 'External Collection Center Management',
                            'content' => 'The LIMS supports receiving orders from satellite collection centers. Each center is registered in the system with its own location code. Orders can be placed remotely, and sample arrival is confirmed by scanning at the main lab receiving counter. Reports are available to the collection center via the web portal.',
                        ],
                    ],
                    'note' => 'A comprehensive printed and PDF user manual is provided to all lab staff during the implementation and training phase. On-site training sessions cover all roles from phlebotomist to lab administrator.',
                ],
            ],
            [
                'section_type' => 'faq',
                'is_active' => true,
                'settings' => [
                    'heading' => 'Frequently Asked Questions — Laboratory Module',
                    'items' => [
                        [
                            'question' => 'Can the LIMS interface with any brand of laboratory analyzer?',
                            'answer' => 'Yes. The LIMS supports bidirectional interfaces via RS-232 and TCP/IP following CLSI standards, and has been integrated with major analyzer brands from Roche, Siemens, Abbott, Mindray, Sysmex, and others. A full list of validated interfaces is available from the implementation team.',
                        ],
                        [
                            'question' => 'How does the system prevent a lab result from being changed after verification?',
                            'answer' => 'Once a pathologist or senior technologist applies an electronic signature to a result, the record is locked. No further edits are permitted — only addendums can be appended, and these are clearly marked with the addendum date, time, and the identity of the user who made the change.',
                        ],
                        [
                            'question' => 'Can patients view their lab results online?',
                            'answer' => 'Yes. Each patient receives a unique username and password at the time of registration. They can log into the secure patient portal to view and download all verified lab reports — no further setup is required by the hospital.',
                        ],
                        [
                            'question' => 'What happens to lab results if the system goes offline?',
                            'answer' => 'The LIMS includes a built-in disaster recovery and backup system with configurable schedules. If the main server becomes unavailable, the backup system maintains operational continuity. Results entered during the offline period are reconciled once connectivity is restored.',
                        ],
                        [
                            'question' => 'How are critical values communicated to the requesting doctor?',
                            'answer' => 'The system flags results that breach defined critical value thresholds and prevents verification until the technologist acknowledges the alert. The notification process (phone call details, time, and contact) is recorded in the audit trail alongside the result.',
                        ],
                        [
                            'question' => 'Can multiple procedures be batched into one tube label?',
                            'answer' => 'Yes. The LIMS supports bundling multiple test procedures into a single accession number based on specimen type. If a panel of tests requires only one EDTA tube, a single barcode label is printed — there is no need to label separate tubes for each individual test.',
                        ],
                    ],
                ],
            ],
        ]);
    }

    private function seedPharmacy(): void
    {
        $this->addSections('pharmacy', [
            [
                'section_type' => 'image_banner',
                'is_active' => true,
                'settings' => [
                    'heading' => 'Pharmacy Dispensing Interface',
                    'image_url' => 'https://images.unsplash.com/photo-1631549916768-4119b2e5f926?w=1200&q=80',
                    'image_alt' => 'Hospital pharmacy dispensing system',
                    'caption' => 'Pharmacists see CPOE prescriptions in real time — no paper slips, no transcription errors.',
                ],
            ],
            [
                'section_type' => 'stats',
                'is_active' => true,
                'settings' => [
                    'heading' => 'Pharmacy Impact Metrics',
                    'stats' => [
                        ['value' => '0', 'label' => 'Paper prescription slips in the dispensing workflow'],
                        ['value' => '100%', 'label' => 'Real-time integration with HIS prescriptions (CPOE)'],
                        ['value' => '60%', 'label' => 'Reduction in dispensing errors with policy enforcement'],
                        ['value' => 'Live', 'label' => 'Stock visibility for prescribing doctors at point of order'],
                    ],
                ],
            ],
            [
                'section_type' => 'workflow',
                'is_active' => true,
                'settings' => [
                    'heading' => 'Prescription-to-Dispensing Workflow',
                    'subheading' => 'From the moment a doctor prescribes to the moment a patient receives medicine, every step is tracked.',
                    'steps' => [
                        [
                            'title' => 'Prescription Generated via CPOE',
                            'description' => 'The prescribing doctor selects medicines from the formulary in the OPD, Emergency, or Ward module. Real-time stock levels are visible at the point of prescription. The prescription is transmitted instantly to the pharmacy — no paper slip is needed.',
                        ],
                        [
                            'title' => 'Policy Validation at Pharmacy Counter',
                            'description' => 'The pharmacist sees the prescription on their workstation. The system validates it against formulary rules, restricted medicine policies, day-limit restrictions, and patient category (general, panel, welfare). Non-compliant orders are flagged before dispensing can proceed.',
                        ],
                        [
                            'title' => 'Stock Check & Availability',
                            'description' => 'The system checks real-time stock levels. If a medicine is out of stock at the dispensing counter, the pharmacist is notified and can request a stock transfer from the main pharmacy store or a ward sub-store.',
                        ],
                        [
                            'title' => 'Dispensing & Label Printing',
                            'description' => 'Once confirmed, the pharmacist dispenses the medicine and the system deducts stock in real time. A dispensing label is printed with patient name, MRN, dosage, frequency, and prescribing doctor details.',
                        ],
                        [
                            'title' => 'Billing Integration',
                            'description' => 'The dispensed quantities are automatically posted to the patient\'s billing account. Panel and welfare discounts are applied based on the patient\'s registered category. No separate billing entry is required.',
                        ],
                        [
                            'title' => 'Returns & Refunds',
                            'description' => 'If a patient returns unused medicine (e.g., on discharge from IPD), the pharmacist processes a return. Stock is credited back, and the billing account is adjusted. All return transactions are logged for audit.',
                        ],
                    ],
                ],
            ],
            [
                'section_type' => 'user_roles',
                'is_active' => true,
                'settings' => [
                    'heading' => 'Pharmacy Team Roles',
                    'roles' => [
                        [
                            'role' => 'Pharmacist',
                            'icon' => '💊',
                            'responsibilities' => [
                                'Verify and approve CPOE prescriptions',
                                'Apply formulary and policy rules at dispensing',
                                'Edit prescriptions within configured rights',
                                'Process medicine returns and refunds',
                                'Manage patient queue at the pharmacy counter',
                            ],
                        ],
                        [
                            'role' => 'Pharmacy Dispenser',
                            'icon' => '📦',
                            'responsibilities' => [
                                'Physically pick and hand out medicines',
                                'Print dispensing labels for each prescription item',
                                'Handle ward medicine requests from nursing staff',
                                'Manage disposables issuance alongside medicines',
                            ],
                        ],
                        [
                            'role' => 'Pharmacy Manager',
                            'icon' => '📊',
                            'responsibilities' => [
                                'Configure formulary, restricted drugs, and day limits',
                                'Set doctor-based and patient-type ordering configurations',
                                'Monitor daily stock stats and initiate demand requests',
                                'Approve stock transfers between stores',
                                'Generate medicine-wise receiving and issuance reports',
                            ],
                        ],
                        [
                            'role' => 'Store Manager',
                            'icon' => '🏪',
                            'responsibilities' => [
                                'Manage main pharmacy warehouse stock',
                                'Process demand requests and approve issuance',
                                'Track reserved stock and stock transfers',
                                'Monitor expiry dates and flag near-expiry items',
                            ],
                        ],
                    ],
                ],
            ],
            [
                'section_type' => 'benefits',
                'is_active' => true,
                'settings' => [
                    'heading' => 'Benefits of the REDSOL Pharmacy Module',
                    'benefits' => [
                        [
                            'icon' => '📄',
                            'title' => 'Paperless Prescription Workflow',
                            'description' => 'Doctor prescriptions flow directly from CPOE to the pharmacy workstation. Paper slips that get lost, misread, or duplicated are eliminated entirely.',
                            'metric' => 'Zero paper slips',
                        ],
                        [
                            'icon' => '🛡️',
                            'title' => 'Policy-Enforced Dispensing',
                            'description' => 'Formulary rules, restricted drug policies, day limits, and patient category restrictions are automatically enforced at the point of dispensing — not as a checklist, but as system-level gates.',
                            'metric' => '60% fewer errors',
                        ],
                        [
                            'icon' => '📈',
                            'title' => 'Real-Time Stock Visibility',
                            'description' => 'Prescribing doctors see live stock levels at the point of order entry. If a drug is unavailable, they know before writing the prescription — not after the patient reaches the counter.',
                            'metric' => 'Live inventory',
                        ],
                        [
                            'icon' => '💰',
                            'title' => 'Automatic Billing Integration',
                            'description' => 'Every dispensed item posts to the patient account instantly. Panel, welfare, and cash discounts are applied automatically. Revenue is captured accurately with no billing gaps.',
                            'metric' => 'No revenue leakage',
                        ],
                    ],
                ],
            ],
            [
                'section_type' => 'technical_specs',
                'is_active' => true,
                'settings' => [
                    'heading' => 'Pharmacy Module Technical Details',
                    'specs' => [
                        ['label' => 'Integration', 'value' => 'Full CPOE integration with OPD, Emergency, and Ward modules'],
                        ['label' => 'Drug Database', 'value' => 'Generic + brand master with dosage, strength, and adverse effects'],
                        ['label' => 'Stock Control', 'value' => 'Real-time, batch-level tracking with expiry management'],
                        ['label' => 'Policy Engine', 'value' => 'Per-doctor, per-drug, per-patient-type dispensing rule sets'],
                        ['label' => 'Queue System', 'value' => 'Integrated patient queue management at pharmacy counter'],
                        ['label' => 'Reports', 'value' => 'Daily receiving/issuance, stock status, drug-wise reports'],
                    ],
                    'standards' => [
                        'ICD-10',
                        'WHO Essential Medicines',
                        'HL7 v2.x',
                        'CPOE-integrated',
                    ],
                    'requirements' => [
                        'Barcode scanner at dispensing counters',
                        'Label printer (thermal recommended)',
                        'LAN connectivity to main HIS server',
                    ],
                ],
            ],
            [
                'section_type' => 'faq',
                'is_active' => true,
                'settings' => [
                    'heading' => 'Frequently Asked Questions — Pharmacy',
                    'items' => [
                        [
                            'question' => 'Can the pharmacist edit a prescription received from the doctor?',
                            'answer' => 'Yes, pharmacists can be given prescription edit rights by the administrator. When a pharmacist edits a prescription (e.g., substituting a brand for a generic), the change is logged with the pharmacist\'s identity and timestamp for audit purposes.',
                        ],
                        [
                            'question' => 'What happens when a medicine is out of stock?',
                            'answer' => 'The system alerts the pharmacist in real time during dispensing. The pharmacist can initiate a stock transfer request from the main warehouse or another sub-store. The doctor can also see stock availability at the point of prescription and consider alternatives.',
                        ],
                        [
                            'question' => 'How are restricted or controlled medicines managed?',
                            'answer' => 'Restricted medicines are configured with specific dispensing policies — they may require a supervisor\'s approval, a doctor-specific authorization, or may only be dispensed to specific patient categories. The system enforces these rules automatically.',
                        ],
                        [
                            'question' => 'Can the same system handle indoor and outdoor pharmacy?',
                            'answer' => 'Yes. The pharmacy module supports multiple dispensing counters — OPD pharmacy, IPD indoor pharmacy, emergency pharmacy, and ward sub-stores. Stock levels, transfers, and issuance reports are tracked separately per counter.',
                        ],
                        [
                            'question' => 'How are medicine returns from discharged IPD patients handled?',
                            'answer' => 'When an IPD patient is discharged, the pharmacist can process a return for any unused medicines still sealed and in saleable condition. The system credits stock back to the pharmacy counter and adjusts the patient\'s final bill automatically.',
                        ],
                    ],
                ],
            ],
        ]);
    }

    private function seedRadiology(): void
    {
        $this->addSections('radiology-ris', [
            [
                'section_type' => 'image_banner',
                'is_active' => true,
                'settings' => [
                    'heading' => 'Radiology Reporting Workstation',
                    'image_url' => 'https://images.unsplash.com/photo-1516549655169-df83a0774514?w=1200&q=80',
                    'image_alt' => 'Radiology Information System reporting interface',
                    'caption' => 'Each radiologist works from a personalised, filterable worklist with full audit trail of every report action.',
                ],
            ],
            [
                'section_type' => 'stats',
                'is_active' => true,
                'settings' => [
                    'heading' => 'RIS Performance Metrics',
                    'stats' => [
                        ['value' => '3×', 'label' => 'Faster report creation with voice recognition templates'],
                        ['value' => '100%', 'label' => 'Timestamp audit trail from order entry to report print'],
                        ['value' => '0', 'label' => 'Manual re-entry of patient data at modality machine'],
                        ['value' => '∞', 'label' => 'Diagnostic workstation licences — no per-seat fees'],
                    ],
                ],
            ],
            [
                'section_type' => 'workflow',
                'is_active' => true,
                'settings' => [
                    'heading' => 'Radiology Workflow — Order to Verified Report',
                    'subheading' => 'The RIS tracks every step from the moment an imaging order is placed to when the report reaches the requesting clinician.',
                    'steps' => [
                        [
                            'title' => 'Online Order Entry',
                            'description' => 'A clinician enters an imaging order from the HIS (OPD, IPD, or Emergency). The ordering physician\'s identity is recorded at entry. Charges are generated at the point of order, and patient preparation instructions are automatically printed.',
                        ],
                        [
                            'title' => 'Technologist Worklist Assignment',
                            'description' => 'The order appears on the technologist\'s worklist automatically. Patient information flows to the modality machine via DICOM/HL7 — no manual re-entry, eliminating typographical errors. The worklist updates in real time if orders are added, modified, or cancelled.',
                        ],
                        [
                            'title' => 'Image Acquisition',
                            'description' => 'The technologist performs the examination and records timestamps (exam start and completion), films used, size, and number of repeats with reasons. Contrast agent or film issuance is recorded against the order.',
                        ],
                        [
                            'title' => 'Radiologist Reporting',
                            'description' => 'The radiologist opens their personalised worklist and selects the study. Reports can be created using drop-down coded templates, voice recognition dictation, or conventional phone dictation. The text editor includes spell-checking, and personal shortcut word libraries accelerate common phrases.',
                        ],
                        [
                            'title' => 'Resident Review & Attending Approval',
                            'description' => 'Where resident-based workflows are in use, a resident submits a draft report for attending radiologist review. The attending can send the report back with corrections for teaching purposes, or approve it with a second electronic signature.',
                        ],
                        [
                            'title' => 'Electronic Verification & Automatic Printing',
                            'description' => 'Once the radiologist applies their electronic signature, the report is locked and its status changes to "Final". It prints automatically at defined locations (e.g., the nursing station or OPD counter) without requiring any further radiologist action.',
                        ],
                    ],
                ],
            ],
            [
                'section_type' => 'user_roles',
                'is_active' => true,
                'settings' => [
                    'heading' => 'Radiology Department Roles',
                    'roles' => [
                        [
                            'role' => 'Radiologist',
                            'icon' => '🩻',
                            'responsibilities' => [
                                'Review imaging studies on personalised worklist',
                                'Dictate or type reports using templates or voice',
                                'Apply electronic signature to verified reports',
                                'Review resident readings and provide feedback',
                                'Access prior studies for comparison reporting',
                            ],
                        ],
                        [
                            'role' => 'Radiology Technologist',
                            'icon' => '📷',
                            'responsibilities' => [
                                'Manage and work from modality-specific worklists',
                                'Perform examinations and record exam details',
                                'Document film usage, repeats, and reasons',
                                'Record contrast agent and consumable issuance',
                            ],
                        ],
                        [
                            'role' => 'Transcriptionist',
                            'icon' => '⌨️',
                            'responsibilities' => [
                                'Transcribe dictated radiology reports',
                                'Without re-entering patient or physician demographic data',
                                'Submit transcribed reports for radiologist verification',
                            ],
                        ],
                        [
                            'role' => 'Radiology Admin',
                            'icon' => '📊',
                            'responsibilities' => [
                                'Generate performance, productivity, and financial reports',
                                'Manage user rights and workstation access',
                                'Configure report delivery time settings',
                                'Handle order cancellation approval requests',
                            ],
                        ],
                    ],
                ],
            ],
            [
                'section_type' => 'technical_specs',
                'is_active' => true,
                'settings' => [
                    'heading' => 'RIS Technical Specifications',
                    'specs' => [
                        ['label' => 'Modality Integration', 'value' => 'DICOM Modality Worklist (MWL) and DICOM Store SCP/SCU'],
                        ['label' => 'Reporting Methods', 'value' => 'Drop-down templates, voice recognition (10 workstations), phone dictation'],
                        ['label' => 'PACS Integration', 'value' => 'Tightly coupled on single database; images called directly from reporting module'],
                        ['label' => 'Dual Monitor', 'value' => 'Supported for side-by-side image and report viewing'],
                        ['label' => 'Audit Trail', 'value' => 'Full timestamps: order entry, arrival, exam start/end, transcription, verification, print'],
                        ['label' => 'Report Status', 'value' => 'Transcribed → Unverified → Final; addendum support post-verification'],
                        ['label' => 'Printing', 'value' => 'Automatic on verification at defined locations; manual on-demand multi-copy'],
                    ],
                    'standards' => ['DICOM 3.0', 'HL7 v2.x', 'IHE Radiology', 'ICD-10'],
                    'requirements' => [
                        'DICOM-compliant modalities for automatic worklist population',
                        'Microphone and voice profile for voice recognition reporting',
                        'Dual monitors recommended for reporting workstations',
                        'High-speed LAN for image transfer from PACS to RIS viewer',
                    ],
                ],
            ],
            [
                'section_type' => 'faq',
                'is_active' => true,
                'settings' => [
                    'heading' => 'Frequently Asked Questions — Radiology',
                    'items' => [
                        [
                            'question' => 'Can multiple radiologists report on the same study?',
                            'answer' => 'Yes. The RIS supports multiple attending radiologists on a single report. Second opinions, joint reports, and resident-attending workflows are all accommodated within the same study record.',
                        ],
                        [
                            'question' => 'How does voice recognition work for radiologists who speak differently?',
                            'answer' => 'Each radiologist has a personalised voice profile that the system builds and refines over time. Personal shortcut word libraries allow each user to define common phrases that expand automatically during dictation. Accuracy improves the more the system is used.',
                        ],
                        [
                            'question' => 'What if a report needs to be corrected after verification?',
                            'answer' => 'Once a report is electronically verified, it is locked. Corrections can only be made as addendums, which are clearly marked with a new date, time, and the identity of the user making the change. The original verified text remains intact and visible.',
                        ],
                        [
                            'question' => 'Can radiologists access their worklist from home or remotely?',
                            'answer' => 'Yes. The RIS supports remote workstation access, allowing radiologists to review and verify reports from any authorized workstation. Teleradiology workflows are fully supported.',
                        ],
                    ],
                ],
            ],
        ]);
    }

    private function seedPatientRegistration(): void
    {
        $this->addSections('patient-registration', [
            [
                'section_type' => 'image_banner',
                'is_active' => true,
                'settings' => [
                    'heading' => 'Patient Registration Interface',
                    'image_url' => 'https://images.unsplash.com/photo-1504439468489-c8920d796a29?w=1200&q=80',
                    'image_alt' => 'Hospital patient registration counter',
                    'caption' => 'A single patient record follows the patient across every department, visit, and branch.',
                ],
            ],
            [
                'section_type' => 'stats',
                'is_active' => true,
                'settings' => [
                    'heading' => 'Registration Module in Numbers',
                    'stats' => [
                        ['value' => '1', 'label' => 'Unique Medical Record Number per patient — across all branches'],
                        ['value' => '< 2m', 'label' => 'Average time to register a returning patient'],
                        ['value' => '100%', 'label' => 'Of departments share the same patient record in real time'],
                        ['value' => '∞', 'label' => 'Past visit history accessible in the patient vault'],
                    ],
                ],
            ],
            [
                'section_type' => 'workflow',
                'is_active' => true,
                'settings' => [
                    'heading' => 'Registration Workflow',
                    'subheading' => 'Whether a patient is brand new or returning after five years, the process is fast and accurate.',
                    'steps' => [
                        [
                            'title' => 'Patient Search',
                            'description' => 'The registration clerk searches for the patient by name, CNIC/national ID, phone number, MRN, or any combination. The system returns phonetically similar names to catch misspellings. If a match is found, the existing record is used — no duplicate is created.',
                        ],
                        [
                            'title' => 'New Patient Registration',
                            'description' => 'If the patient is not found, a new UMRN is generated — linked to their National Identity Number where available. All demographic fields are captured: name, date of birth, gender, address, contact numbers, emergency contact, and blood group.',
                        ],
                        [
                            'title' => 'Category Assignment',
                            'description' => 'The patient is assigned a billing category: General, Private, Panel (with panel card validation), Entitled, or Welfare. Category determines the price list, discount rules, and documentation requirements that apply to all their transactions in the HIS.',
                        ],
                        [
                            'title' => 'Document Capture',
                            'description' => 'Relevant supporting documents are scanned and attached to the patient record: CNIC, panel card, referral letter, insurance card, or welfare approval. All documents are stored digitally and accessible from any HIS workstation.',
                        ],
                        [
                            'title' => 'Wristband & Card Printing',
                            'description' => 'The system prints the patient\'s registration card (for outpatient use) and barcoded wristband (for inpatient use). Separate labels are also generated for lab, radiology, and OT use — all pre-filled with patient details and MRN barcode.',
                        ],
                        [
                            'title' => 'Portal Access Generation',
                            'description' => 'A unique username and password are generated for the patient\'s online portal at registration. The patient can use these credentials to access their lab reports, appointment history, and billing records remotely at any time.',
                        ],
                    ],
                ],
            ],
            [
                'section_type' => 'user_roles',
                'is_active' => true,
                'settings' => [
                    'heading' => 'Who Operates the Registration Module',
                    'roles' => [
                        [
                            'role' => 'Registration Clerk',
                            'icon' => '👤',
                            'responsibilities' => [
                                'Register new patients and retrieve existing records',
                                'Assign billing category and capture documents',
                                'Print registration cards, wristbands, and labels',
                                'Merge duplicate records under supervisor approval',
                                'Update demographic information on patient request',
                            ],
                        ],
                        [
                            'role' => 'Front Desk Supervisor',
                            'icon' => '👨‍💼',
                            'responsibilities' => [
                                'Approve category changes for existing patients',
                                'Authorize duplicate record merging',
                                'Review registration audit logs',
                                'Manage clerk access rights and shifts',
                            ],
                        ],
                        [
                            'role' => 'Emergency Receptionist',
                            'icon' => '🚨',
                            'responsibilities' => [
                                'Rapid partial registration for emergency arrivals',
                                'Complete demographic details when patient is stabilised',
                                'Generate emergency wristband and ID labels immediately',
                            ],
                        ],
                        [
                            'role' => 'Information Counter Staff',
                            'icon' => 'ℹ️',
                            'responsibilities' => [
                                'Look up patient status and location for family inquiries',
                                'Confirm appointment status and consultant details',
                                'Direct visitors to correct department or ward',
                            ],
                        ],
                    ],
                ],
            ],
            [
                'section_type' => 'benefits',
                'is_active' => true,
                'settings' => [
                    'heading' => 'Why a Unified Patient Registry Matters',
                    'benefits' => [
                        [
                            'icon' => '🔗',
                            'title' => 'One Record Across the Entire Hospital',
                            'description' => 'The UMRN follows the patient through every department, visit, and billing transaction. No department operates on a separate ID — there is one single source of truth for every patient interaction.',
                            'metric' => 'Enterprise-wide',
                        ],
                        [
                            'icon' => '⚡',
                            'title' => 'Sub-2-Minute Return Registration',
                            'description' => 'Returning patients are found in seconds by scanning their card barcode or searching by any identifier. All previous visits, lab results, and billing history are available immediately.',
                            'metric' => '< 2 minutes',
                        ],
                        [
                            'icon' => '🛡️',
                            'title' => 'Duplicate Prevention at Source',
                            'description' => 'The system checks for phonetic name matches, ID card matches, and phone number duplicates before creating a new record — preventing the data quality problems that plague manual registration systems.',
                            'metric' => 'Zero duplicates',
                        ],
                        [
                            'icon' => '📱',
                            'title' => 'Patient Portal from Day One',
                            'description' => 'Every patient receives portal credentials at registration — no extra signup required. They can access lab reports and appointment history online from the first visit.',
                            'metric' => 'Instant access',
                        ],
                    ],
                ],
            ],
            [
                'section_type' => 'documentation',
                'is_active' => true,
                'settings' => [
                    'heading' => 'Registration Staff Quick Guide',
                    'sections' => [
                        [
                            'title' => 'Registering a New Patient',
                            'content' => 'New patient registration is completed at any registration counter — OPD, Emergency, or information desk. All registration counters share the same patient database in real time.',
                            'steps' => [
                                'Search by name, CNIC, or phone to confirm the patient does not already exist',
                                'Click "New Registration" and enter all available demographic data',
                                'Select the appropriate patient category (General, Private, Panel, etc.)',
                                'Attach scanned documents as required for the selected category',
                                'Save the record — UMRN is auto-generated and displayed',
                                'Print registration card, wristband, and any required labels',
                            ],
                        ],
                        [
                            'title' => 'Changing a Patient\'s Category',
                            'content' => 'A patient\'s billing category can be changed when their circumstances change — for example, when a general patient presents a panel card, or when a patient qualifies for welfare. Category changes require supervisor-level access and are logged in the audit trail.',
                            'steps' => [
                                'Open the patient record and navigate to the Category tab',
                                'Select the new category from the dropdown',
                                'Attach supporting documentation for the new category',
                                'Submit for supervisor approval if required by hospital policy',
                                'Confirm — all future transactions use the new category pricing',
                            ],
                        ],
                        [
                            'title' => 'Merging Duplicate Records',
                            'content' => 'If a patient has been registered more than once, their records must be merged under one UMRN. All visit history, lab results, and billing records from both MRNs are consolidated. The secondary MRN is deactivated but remains searchable — redirecting to the primary record.',
                        ],
                    ],
                    'note' => 'Emergency registrations should always use the "Rapid Registration" mode, which captures only the minimum fields required to generate a wristband. Full demographic details can be completed while the patient is being treated.',
                ],
            ],
            [
                'section_type' => 'faq',
                'is_active' => true,
                'settings' => [
                    'heading' => 'Frequently Asked Questions — Patient Registration',
                    'items' => [
                        [
                            'question' => 'What happens if a patient arrives at Emergency without any ID?',
                            'answer' => 'The emergency rapid registration mode allows a record to be created with whatever demographic information is available at the time — even just "Unknown Male, approximate age 40". A temporary wristband is printed immediately. The record is updated with full details once the patient is stabilised or family members arrive.',
                        ],
                        [
                            'question' => 'Can a patient be registered under a family group?',
                            'answer' => 'Yes. Family and dependent registration allows related patients — such as spouses and children — to be linked under one household record. Each member retains their own UMRN and individual clinical record, but billing and panel category can be managed at the household level.',
                        ],
                        [
                            'question' => 'How does the system prevent the same patient being registered twice?',
                            'answer' => 'During new patient registration, the system performs a multi-criteria duplicate check — comparing name, date of birth, CNIC, and phone number against existing records. Phonetically similar names are flagged. The clerk must confirm the patient is genuinely new before a new UMRN is issued.',
                        ],
                        [
                            'question' => 'Can registration cards be reprinted if a patient loses theirs?',
                            'answer' => 'Yes. Registration cards, wristbands, and barcode labels can be reprinted at any time from the patient\'s record. Each reprint is logged with the user identity and timestamp.',
                        ],
                    ],
                ],
            ],
        ]);
    }

    // Following the same pattern for all other modules

    private function seedBilling(): void
    {
        $this->addSections('patient-billing-system', [
            [
                'section_type' => 'image_banner',
                'is_active' => true,
                'settings' => [
                    'image_url' => 'https://images.unsplash.com/photo-1563013544-824ae1b704d3?w=1200&q=80',
                    'image_alt' => 'Hospital billing and finance system',
                    'caption' => 'Every service rendered is captured automatically — no charge line is ever missed.',
                ],
            ],
            [
                'section_type' => 'stats',
                'is_active' => true,
                'settings' => [
                    'heading' => 'Billing System Impact',
                    'stats' => [
                        ['value' => '0', 'label' => 'Manual charge entry for integrated services'],
                        ['value' => '100%', 'label' => 'Service capture from lab, OT, pharmacy, and wards'],
                        ['value' => 'Auto', 'label' => 'Doctor share calculation per billing transaction'],
                        ['value' => 'Daily', 'label' => 'Income statements generated with and without tax'],
                    ],
                ],
            ],
            [
                'section_type' => 'workflow',
                'is_active' => true,
                'settings' => [
                    'heading' => 'Revenue Cycle Workflow',
                    'steps' => [
                        ['title' => 'Service Rendering', 'description' => 'A clinical or diagnostic service is performed — a consultation, lab test, X-ray, OT procedure, bed day, or medicine dispensed. Each event automatically posts a charge line to the patient\'s account without any manual billing entry by clinical staff.'],
                        ['title' => 'Account Review', 'description' => 'The billing officer or cashier opens the patient\'s account and reviews all accumulated charge lines. Panel or welfare discounts are visible and applied automatically based on the patient\'s registered category.'],
                        ['title' => 'Payment Collection', 'description' => 'Payment is collected (cash, card, panel credit, or insurance) and a fee collection slip is printed. For IPD patients, interim billing can be generated at any point during the stay without affecting the final bill.'],
                        ['title' => 'Doctor Share Calculation', 'description' => 'At each billing transaction, the system calculates the consultant\'s share based on pre-configured rates per service type. If the doctor supplied their own equipment, the cost is adjusted. Dual ledgers handle multi-doctor scenarios.'],
                        ['title' => 'Daily Reconciliation', 'description' => 'The daily income statement — with and without tax — is generated automatically from cash collection data. The accounts department receives a reconciled view of all transactions without manual data entry.'],
                    ],
                ],
            ],
            [
                'section_type' => 'user_roles',
                'is_active' => true,
                'settings' => [
                    'heading' => 'Billing Department Roles',
                    'roles' => [
                        ['role' => 'Cashier', 'icon' => '💳', 'responsibilities' => ['Collect patient payments', 'Apply panel/welfare discounts', 'Print fee collection slips', 'Handle refunds and adjustments']],
                        ['role' => 'Billing Officer', 'icon' => '📋', 'responsibilities' => ['Review and finalise IPD discharge bills', 'Manage package billing and bundle pricing', 'Reconcile accounts with clinical services', 'Generate daily income reports']],
                        ['role' => 'Billing Administrator', 'icon' => '⚙️', 'responsibilities' => ['Configure service price lists', 'Set up service packages with financial impact', 'Manage discount policies and approval rules', 'Configure doctor share rates per service']],
                        ['role' => 'Accounts Officer', 'icon' => '📊', 'responsibilities' => ['Review daily income statements', 'Track outstanding balances', 'Reconcile cash collection with billing', 'Generate financial summary reports']],
                    ],
                ],
            ],
            [
                'section_type' => 'faq',
                'is_active' => true,
                'settings' => [
                    'heading' => 'Frequently Asked Questions — Billing',
                    'items' => [
                        ['question' => 'Does the billing system handle both OPD and IPD billing?', 'answer' => 'Yes. OPD billing handles single-visit transactions with immediate payment. IPD billing accumulates all charges during the stay — bed days, procedures, medicines, and investigations — and generates a consolidated discharge bill when the patient is ready to leave.'],
                        ['question' => 'How are service packages set up?', 'answer' => 'Package billing allows the administrator to bundle multiple services (e.g., a maternity package covering delivery, anaesthesia, and three bed days) into a single price. The system tracks individual service delivery within the package and handles any additional charges outside the package scope.'],
                        ['question' => 'Can interim bills be generated for IPD patients before discharge?', 'answer' => 'Yes. An interim or provisional bill can be generated at any point during an IPD stay without closing the patient\'s account. This is commonly used for patients requesting an estimate or for collecting a deposit payment.'],
                        ['question' => 'How is the doctor share calculated?', 'answer' => 'Doctor share rates are configured per doctor and per service type by the billing administrator. When a service is billed, the system calculates the doctor\'s share automatically — with or without tax as configured. If a doctor provided their own equipment for a procedure, that cost is deducted from the share calculation.'],
                    ],
                ],
            ],
        ]);
    }

    private function seedEmergency(): void
    {
        $this->addSections('emergency-center', [
            ['section_type' => 'image_banner', 'is_active' => true, 'settings' => ['image_url' => 'https://images.unsplash.com/photo-1538108149393-fbbd81895907?w=1200&q=80', 'image_alt' => 'Emergency department workflow', 'caption' => 'From triage to disposition — every ED step is documented, timed, and traceable.']],
            ['section_type' => 'stats', 'is_active' => true, 'settings' => ['heading' => 'Emergency Department Metrics', 'stats' => [['value' => '< 5m', 'label' => 'Registration to triage completion target'], ['value' => '24/7', 'label' => 'Real-time ED occupancy visibility'], ['value' => '100%', 'label' => 'Pharmacy, lab, and imaging integration'], ['value' => 'Zero', 'label' => 'Paper-based medication orders in ED']]]],
            [
                'section_type' => 'workflow',
                'is_active' => true,
                'settings' => [
                    'heading' => 'Emergency Patient Flow',
                    'steps' => [
                        ['title' => 'Rapid Registration', 'description' => 'The patient\'s basic demographics are captured at the ED reception counter — even if incomplete. A wristband and slip are generated immediately. Full details are updated as the patient\'s condition allows.', 'note' => 'Unknown patients can be registered with placeholder data and updated later.'],
                        ['title' => 'Triage Assessment', 'description' => 'The attending nurse or doctor assigns a triage category. Vitals (BP, pulse, temperature, SpO2, GCS) are recorded. The triage category determines queue priority — critical patients bypass the standard queue.'],
                        ['title' => 'Doctor Assessment & Orders', 'description' => 'The ED doctor opens the patient\'s assessment sheet in the system. Clinical notes are entered, diagnostic orders (lab and imaging) are placed, and pharmacy orders for emergency medicines are raised.'],
                        ['title' => 'Nursing Monitoring', 'description' => 'Nurses enter vitals at each shift handover. Intake and output are recorded. The doctor can view real-time vitals trends without leaving the assessment module.'],
                        ['title' => 'Disposition Decision', 'description' => 'The doctor decides: discharge, admit to a ward, transfer to ICU or OT, or refer externally. An ED episode summary is generated automatically from the clinical notes entered during the encounter.'],
                        ['title' => 'Emergency Episode Summary', 'description' => 'A structured summary of the entire ED encounter — registration time, triage category, investigations, treatments, and final disposition — is generated and filed in the patient\'s medical record.'],
                    ]
                ]
            ],
            [
                'section_type' => 'faq',
                'is_active' => true,
                'settings' => [
                    'heading' => 'FAQ — Emergency Center',
                    'items' => [
                        ['question' => 'How are emergency medicines ordered when the patient has no MRN yet?', 'answer' => 'Emergency medicine orders can be placed on a temporary MR# assigned at rapid registration. Once the full registration is completed, all emergency orders and transactions are linked to the patient\'s permanent UMRN automatically.'],
                        ['question' => 'Can zero-cost emergency services be approved?', 'answer' => 'Yes. Hospital administration can configure certain services or service categories to be available at zero cost for emergency patients — for example, trauma cases requiring immediate diagnostics. A flag triggers an administrative approval workflow before the service is rendered.'],
                        ['question' => 'How does the ED integrate with the OT for emergency surgery?', 'answer' => 'The ED doctor can initiate an emergency surgical process directly from the emergency module. This generates a priority surgery booking in the OT module, triggers alerts to the surgeon and anaesthetist, and transfers the patient\'s clinical documentation to the OT team automatically.'],
                    ]
                ]
            ],
        ]);
    }

    private function seedOT(): void
    {
        $this->addSections('operation-theatre', [
            ['section_type' => 'image_banner', 'is_active' => true, 'settings' => ['image_url' => 'https://images.unsplash.com/photo-1559757148-5c350d0d3c56?w=1200&q=80', 'image_alt' => 'Operation theatre management system', 'caption' => 'From surgical scheduling to post-operative notes — the entire perioperative journey is documented digitally.']],
            ['section_type' => 'stats', 'is_active' => true, 'settings' => ['heading' => 'OT Module Performance', 'stats' => [['value' => '100%', 'label' => 'OT cases with pre-surgery checklist compliance'], ['value' => 'Auto', 'label' => 'Surgeon, anaesthetist & patient alerts on scheduling'], ['value' => 'Live', 'label' => 'OT calendar and slot availability'], ['value' => 'Zero', 'label' => 'Patient data re-entry from ward to OT counter']]]],
            [
                'section_type' => 'workflow',
                'is_active' => true,
                'settings' => [
                    'heading' => 'Operation Theatre Workflow',
                    'steps' => [
                        ['title' => 'Surgery Scheduling', 'description' => 'The surgeon advises surgery — elective or emergency. The OT coordinator selects a vacant slot from the surgeon\'s calendar and books the OT. The system sends automatic alerts to the patient, surgeon, and anaesthetist with the scheduled date and time.'],
                        ['title' => 'Pre-operative Preparation', 'description' => 'The anesthetist completes a pre-anesthetic checkup and records findings. A pre-defined surgery checklist is presented to the OT team — preparatory steps must be checked off before the actual OT process can begin in the system.'],
                        ['title' => 'Patient Transfer to OT', 'description' => 'The patient\'s ward record is forwarded automatically to the OT counter dashboard. A barcoded wrist tag is generated if not already present. Intra-operative details are entered: surgeon names, anaesthetic type, procedure performed, and team members.'],
                        ['title' => 'Intra-operative Documentation', 'description' => 'Perfusionist parameters (for cardiac surgery) are captured via single-click options. Sample containers for histopathology or pathology are barcoded and sent to the lab. All consumables used during the procedure are logged.'],
                        ['title' => 'Post-operative Handover', 'description' => 'Post-operative notes and recovery assessment are entered. The patient is transferred to the ward, ICU, or recovery room — the nursing module is updated automatically. All OT charges are posted to the patient\'s IPD billing account.'],
                    ]
                ]
            ],
            [
                'section_type' => 'faq',
                'is_active' => true,
                'settings' => [
                    'heading' => 'FAQ — Operation Theatre',
                    'items' => [
                        ['question' => 'How is an emergency surgery prioritised over elective cases?', 'answer' => 'The OT module allows an emergency surgery to be inserted into the schedule with priority status. The system automatically moves it to the top of the day\'s schedule, updates the OT calendar, and sends alerts to all concerned staff immediately.'],
                        ['question' => 'Can the system track samples sent from OT to the laboratory?', 'answer' => 'Yes. Sample containers for histopathology, pathology, and microbiology can be barcoded directly from the OT module. Lab technicians scan the barcode on receipt, and results are tracked and accessible from within the OT patient record.'],
                        ['question' => 'What happens if a surgery is rescheduled?', 'answer' => 'The OT coordinator can reschedule a surgery from the calendar view. A reason must be entered before the reschedule is saved. The system automatically notifies all affected parties — patient, surgeon, and anaesthetist — with the updated time and slot.'],
                    ]
                ]
            ],
        ]);
    }

    private function seedNursingWards(): void
    {
        $this->addSections('nursing-wards', [
            ['section_type' => 'image_banner', 'is_active' => true, 'settings' => ['image_url' => 'https://images.unsplash.com/photo-1576765608866-5b51046452be?w=1200&q=80', 'image_alt' => 'Nursing ward management system', 'caption' => 'Every bed, every patient, every medication — visible in real time from any ward counter terminal.']],
            ['section_type' => 'stats', 'is_active' => true, 'settings' => ['heading' => 'Ward Management Metrics', 'stats' => [['value' => 'Live', 'label' => 'Bed occupancy and patient status'], ['value' => '100%', 'label' => 'Real-time pharmacy and diagnostics integration'], ['value' => 'Auto', 'label' => 'IPD billing updates on every ward action'], ['value' => 'Zero', 'label' => 'Paper medicine request slips between ward and pharmacy']]]],
            [
                'section_type' => 'workflow',
                'is_active' => true,
                'settings' => [
                    'heading' => 'Ward Nursing Workflow',
                    'steps' => [
                        ['title' => 'Bed Allocation & Admission', 'description' => 'When the admission module approves an IPD admission, the ward nursing station receives the patient assignment. The nurse allocates a specific bed, confirms the provisional diagnosis, and updates the ward census.'],
                        ['title' => 'Shift Handover', 'description' => 'At each nursing shift change, the outgoing nurse documents vitals, intake/output measurements, and any care activities completed. The incoming nurse reviews the current status before assuming responsibility.'],
                        ['title' => 'Medicine & Disposables Orders', 'description' => 'Nurses place medicine and disposable requests online directly to the indoor pharmacy or ward sub-store. The pharmacy receives the request instantly and dispenses against the ward order — no paper slip required.'],
                        ['title' => 'Investigation Orders', 'description' => 'Lab, radiology, cardiology, and other investigation requests are placed from the nursing station and routed to the relevant department. Results return electronically and are filed in the patient\'s ward record.'],
                        ['title' => 'Cost Monitoring', 'description' => 'At any point during the stay, the nurse or ward administrator can view the estimated cost of stay including bed charges, drugs, and procedures. This helps counsel patients and plan discharge timing.'],
                    ]
                ]
            ],
            [
                'section_type' => 'faq',
                'is_active' => true,
                'settings' => [
                    'heading' => 'FAQ — Nursing & Wards',
                    'items' => [
                        ['question' => 'Can a patient be transferred between wards without re-registration?', 'answer' => 'Yes. Patient transfers between beds and wards are handled entirely within the nursing module. The ward census updates automatically, billing continues without interruption, and the patient\'s full record is accessible at the new ward immediately.'],
                        ['question' => 'How does the system manage ward sub-stores for medicines?', 'answer' => 'Each ward can have its own sub-store with a defined stock holding. The nursing module shows real-time stock levels in the sub-store. When stock falls below threshold, the nurse initiates a demand request to the main indoor pharmacy, which is approved and fulfilled digitally.'],
                    ]
                ]
            ],
        ]);
    }

    private function seedAdmissionDischarge(): void
    {
        $this->addSections('admission-discharge', [
            ['section_type' => 'image_banner', 'is_active' => true, 'settings' => ['image_url' => 'https://images.unsplash.com/photo-1519494026892-80bbd2d6fd0d?w=1200&q=80', 'image_alt' => 'Hospital bed management system', 'caption' => 'Real-time bed availability, instant admission, and automatic discharge billing in a single integrated system.']],
            ['section_type' => 'stats', 'is_active' => true, 'settings' => ['heading' => 'IPD Management by the Numbers', 'stats' => [['value' => 'Live', 'label' => 'Bed availability across all wards'], ['value' => 'Auto', 'label' => 'Discharge bill from all accumulated charges'], ['value' => '100%', 'label' => 'Inpatient charges captured without manual entry'], ['value' => 'Zero', 'label' => 'Missed charges on discharge billing']]]],
            [
                'section_type' => 'workflow',
                'is_active' => true,
                'settings' => [
                    'heading' => 'Inpatient Journey',
                    'steps' => [
                        ['title' => 'Admission Decision', 'description' => 'The treating doctor advises admission. The ward clerk checks real-time bed availability from the IPD management screen and selects a bed category appropriate to the patient\'s billing category and clinical need.'],
                        ['title' => 'Barcoded Wristband', 'description' => 'A barcoded wristband is generated with the patient\'s MRN, name, date of admission, ward, bed number, and provisional diagnosis. This wristband is scanned at every subsequent interaction — pharmacy, lab, OT — to confirm identity.'],
                        ['title' => 'Continuous Charge Accumulation', 'description' => 'Every service rendered during the stay — bed days, nursing care, lab tests, radiology, OT procedures, and medicines — posts to the patient\'s IPD account automatically as it occurs. There is no end-of-day batch entry.'],
                        ['title' => 'Discharge Clearance', 'description' => 'When the doctor issues a discharge order, the billing module compiles a complete, itemised bill from all accumulated charges. The ward clerk verifies any outstanding items before finalising.'],
                        ['title' => 'Final Bill & Discharge Summary', 'description' => 'The patient settles the final bill. A discharge summary is generated from the clinical notes, diagnoses, and treatment documented during the stay. Follow-up appointments are scheduled before the patient leaves.'],
                    ]
                ]
            ],
            [
                'section_type' => 'faq',
                'is_active' => true,
                'settings' => [
                    'heading' => 'FAQ — Admission & Discharge',
                    'items' => [
                        ['question' => 'What if a patient needs to be transferred to another ward?', 'answer' => 'Ward transfers are processed from the nursing module. The bed occupancy map updates instantly, the billing continues without interruption, and the patient\'s clinical record is accessible from the new ward immediately. No re-admission is required.'],
                        ['question' => 'Can a provisional bill be generated before discharge?', 'answer' => 'Yes. An interim bill can be generated at any point during the IPD stay — for patient information, deposit collection, or insurance pre-authorisation — without closing the account or affecting subsequent charges.'],
                    ]
                ]
            ],
        ]);
    }

    private function seedOPD(): void
    {
        $this->addSections('outdoor-clinics', [
            ['section_type' => 'image_banner', 'is_active' => true, 'settings' => ['image_url' => 'https://images.unsplash.com/photo-1582750433449-648ed127bb54?w=1200&q=80', 'image_alt' => 'OPD consultation management system', 'caption' => 'Structured SOAP notes, real-time pharmacy stock, and instant referrals — all from one consultation screen.']],
            ['section_type' => 'stats', 'is_active' => true, 'settings' => ['heading' => 'OPD Module Impact', 'stats' => [['value' => '0', 'label' => 'Paper prescription slips with CPOE integration'], ['value' => 'Live', 'label' => 'Pharmacy stock visibility at point of prescription'], ['value' => '100%', 'label' => 'Orders routed directly to lab, radiology, and pharmacy'], ['value' => 'Instant', 'label' => 'Patient referral to any department or external hospital']]]],
            [
                'section_type' => 'workflow',
                'is_active' => true,
                'settings' => [
                    'heading' => 'OPD Clinical Workflow',
                    'steps' => [
                        ['title' => 'Patient Arrives & Queue Entry', 'description' => 'The patient\'s appointment is confirmed at the front desk and they are added to the clinic queue. The doctor sees the patient\'s name, queue number, and brief history in their clinic list.'],
                        ['title' => 'Clinical Documentation (SOAP)', 'description' => 'The doctor opens the consultation screen. Subjective, Objective, Assessment, and Plan notes are entered using specialty-specific templates. Chief complaints, examination findings, and provisional diagnosis are structured fields — not free text.'],
                        ['title' => 'CPOE — Orders to Pharmacy, Lab, Radiology', 'description' => 'Investigations are ordered with a single click. Prescriptions are written from the drug formulary with real-time stock visibility. Orders are routed instantly to the relevant department — lab, radiology, or pharmacy — without any paper slip.'],
                        ['title' => 'Referral Management', 'description' => 'If the patient needs to see another specialist, an internal referral is generated. For external referrals, a formal referral letter is generated and logged. Both types of referral are tracked and follow-up visits are linked.'],
                        ['title' => 'Visit Completion & Billing', 'description' => 'When the consultation is closed, the consultation fee and any ordered services are posted to the patient\'s billing account. The patient proceeds to the pharmacy to collect medicines and to the billing counter to pay.'],
                    ]
                ]
            ],
            [
                'section_type' => 'faq',
                'is_active' => true,
                'settings' => [
                    'heading' => 'FAQ — OPD / Consultant Practice',
                    'items' => [
                        ['question' => 'Can the doctor see previous visit notes from the same clinic?', 'answer' => 'Yes. All previous OPD visits are stored in the patient\'s discharged vault and are accessible to the consulting doctor at any time. The doctor can review past complaints, prescriptions, investigation results, and diagnoses without switching screens.'],
                        ['question' => 'What are clinical templates and how are they managed?', 'answer' => 'Clinical templates are pre-configured consultation note structures tailored to specific specialties or common presentations. An administrator or senior doctor creates templates (e.g., a hypertension follow-up template or a respiratory examination template). Doctors select the appropriate template at the start of a consultation, then modify it as needed.'],
                    ]
                ]
            ],
        ]);
    }

    private function seedAppointment(): void
    {
        $this->addSections('integrated-appointment-system', [
            ['section_type' => 'image_banner', 'is_active' => true, 'settings' => ['image_url' => 'https://images.unsplash.com/photo-1506784983877-45594efa4cbe?w=1200&q=80', 'image_alt' => 'Hospital appointment scheduling system', 'caption' => 'Configurable slot types, per-role booking rights, and automated queue generation in one system.']],
            [
                'section_type' => 'workflow',
                'is_active' => true,
                'settings' => [
                    'heading' => 'Appointment Booking Workflow',
                    'steps' => [
                        ['title' => 'Slot Configuration', 'description' => 'The administrator defines available slots per consultant: slot type (OPD, IPD, VIP, overbooking), maximum patients per slot, and booking rights per staff role. Different rules can apply to different slot types.'],
                        ['title' => 'Appointment Booking', 'description' => 'The front desk or PA searches for the patient, selects the consultant, and sees only genuinely available slots in real time. The appointment is confirmed, and a serial number and queue token are generated automatically.'],
                        ['title' => 'Day-of-Visit Management', 'description' => 'On the appointment date, the patient is checked in at the front desk. Their queue position is confirmed. If they are delayed, the system manages the queue re-insertion.'],
                        ['title' => 'Historical Records', 'description' => 'All past appointments are stored and accessible. The doctor can see a patient\'s appointment history — how often they attend, whether they have a pattern of no-shows, and what services they have previously accessed.'],
                    ]
                ]
            ],
            [
                'section_type' => 'faq',
                'is_active' => true,
                'settings' => [
                    'heading' => 'FAQ — Appointment System',
                    'items' => [
                        ['question' => 'What is the overbooking slot type?', 'answer' => 'Overbooking allows a limited number of additional patients to be booked beyond the consultant\'s normal capacity — for example, for urgent cases or at a consultant\'s specific request. The system tracks overbooked cases separately for scheduling analytics.'],
                        ['question' => 'Can the PA book appointments directly for their consultant?', 'answer' => 'Yes. Each consultant\'s Personal Assistant can be given booking rights restricted to their doctor\'s clinic. They see only the relevant consultant\'s schedule and cannot book into other consultants\' slots without additional permissions.'],
                    ]
                ]
            ],
        ]);
    }

    private function seedQueue(): void
    {
        $this->addSections('queue-management', [
            ['section_type' => 'stats', 'is_active' => true, 'settings' => ['heading' => 'Queue Management Impact', 'stats' => [['value' => 'Live', 'label' => 'Waiting time displayed to patients in real time'], ['value' => 'Auto', 'label' => 'Queue re-routing on doctor or room change'], ['value' => 'Config', 'label' => 'Senior citizen priority — no manual intervention needed'], ['value' => 'Full', 'label' => 'Waiting hall display board integration']]]],
            [
                'section_type' => 'workflow',
                'is_active' => true,
                'settings' => [
                    'heading' => 'Queue Flow',
                    'steps' => [
                        ['title' => 'Token Generation', 'description' => 'When a patient arrives and is checked in for a clinic or service, a queue token is generated automatically. The token includes the patient\'s serial number, expected service, and estimated waiting time.'],
                        ['title' => 'Priority Insertion', 'description' => 'Senior citizens (age threshold is configurable) are automatically inserted ahead of standard queue positions. Emergency patients referred from the ED bypass the standard queue entirely.'],
                        ['title' => 'Hold Queue Management', 'description' => 'If a doctor advises a patient to have an urgent diagnostic test and return for re-consultation, the "Hold" feature saves their queue position. When the test result is available, the patient is re-inserted with priority.'],
                        ['title' => 'Waiting Hall Display', 'description' => 'A live display board shows the current token being served per clinic, the next tokens in queue, and estimated waiting times. Patients can monitor their progress without approaching the counter.'],
                    ]
                ]
            ],
        ]);
    }

    private function seedWelfare(): void
    {
        $this->addSections('patient-welfare', [
            [
                'section_type' => 'workflow',
                'is_active' => true,
                'settings' => [
                    'heading' => 'Welfare Approval & Application Workflow',
                    'steps' => [
                        ['title' => 'Welfare Application', 'description' => 'The patient or their family submits a welfare application at the relevant counter, along with supporting documents (income certificate, medical board recommendation, etc.). Documents are scanned and attached digitally.'],
                        ['title' => 'Category Assessment', 'description' => 'The welfare officer reviews the application and assigns the patient to the appropriate welfare category — for example, 25% discount, 50% discount, or 100% welfare. Each category has pre-configured discount rules.'],
                        ['title' => 'Approval & Vault Entry', 'description' => 'Once approved, the patient is added to the welfare vault. Their record is flagged with the welfare category, validity period, and renewal date. From this point, all their billing transactions apply the configured discounts automatically.'],
                        ['title' => 'Expiry & Renewal', 'description' => 'Welfare approvals have defined validity periods. As expiry approaches, the system flags the patient for renewal. If not renewed, the discount stops applying automatically on the expiry date — no manual intervention required.'],
                    ]
                ]
            ],
            [
                'section_type' => 'faq',
                'is_active' => true,
                'settings' => [
                    'heading' => 'FAQ — Patient Welfare',
                    'items' => [
                        ['question' => 'Can different welfare categories have different discount percentages?', 'answer' => 'Yes. The hospital administrator can define any number of welfare categories, each with its own discount percentage. For example, Category A might receive 50% off all services, while Category B covers only diagnostics at 100%.'],
                        ['question' => 'What happens when a welfare patient\'s approval expires?', 'answer' => 'The system tracks expiry dates for every approved welfare patient. On the expiry date, the discount ceases automatically. The patient must renew their application to continue receiving welfare benefits. Staff are alerted to upcoming expirations in advance.'],
                    ]
                ]
            ],
        ]);
    }

    private function seedInventory(): void
    {
        $this->addSections('inventory', [
            ['section_type' => 'image_banner', 'is_active' => true, 'settings' => ['image_url' => 'https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?w=1200&q=80', 'image_alt' => 'Hospital inventory and warehouse management', 'caption' => 'From purchase order to ward sub-store — every item tracked from procurement to consumption.']],
            [
                'section_type' => 'workflow',
                'is_active' => true,
                'settings' => [
                    'heading' => 'Supply Chain Workflow',
                    'steps' => [
                        ['title' => 'Demand Request', 'description' => 'A department submits a demand request specifying the items and quantities needed. The request is routed to the store manager for approval. Requests exceeding configured limits require additional authorization.'],
                        ['title' => 'Purchase Order Issuance', 'description' => 'Approved demand requests are consolidated into purchase orders and sent to registered vendors. Local purchase orders can also be issued for urgent items.'],
                        ['title' => 'Goods Receipt & Inspection', 'description' => 'When goods arrive, a Goods Receiving Note (GRN) is created. Items are inspected against the purchase order — accepted quantities are entered into stock; rejected items are documented for vendor return.'],
                        ['title' => 'Store & Sub-Store Management', 'description' => 'Accepted stock enters the main warehouse. Departments can request transfers to their sub-stores. All transfers are logged with requesting user, approver, and quantities.'],
                        ['title' => 'Consumption & Condemnation', 'description' => 'As items are used, consumption is recorded against the relevant sub-store. At end-of-life, a formal condemnation process documents the disposal with approver identity and reason.'],
                    ]
                ]
            ],
            [
                'section_type' => 'faq',
                'is_active' => true,
                'settings' => [
                    'heading' => 'FAQ — Inventory',
                    'items' => [
                        ['question' => 'Does the inventory module cover medical consumables as well as general items?', 'answer' => 'Yes. The inventory module covers all non-pharmaceutical hospital consumables — surgical gloves, syringes, sterile dressings, hospital stationery, furniture, and equipment. Pharmaceutical items are managed separately in the pharmacy module.'],
                        ['question' => 'How is stock audited?', 'answer' => 'The system supports periodic, random, and full stock audits. During an audit, physical counts are entered against the system\'s book stock. Discrepancies are flagged for investigation. The audit trail records who conducted the count and when.'],
                    ]
                ]
            ],
        ]);
    }

    private function seedGynecology(): void
    {
        $this->addSections('gynecology', [
            ['section_type' => 'image_banner', 'is_active' => true, 'settings' => ['image_url' => 'https://images.unsplash.com/photo-1631217868264-e5b90bb7e133?w=1200&q=80', 'image_alt' => 'Gynecology and obstetrics management system', 'caption' => 'Integrated prenatal records, fetal ultrasound measurements, and vaccination tracking in a single clinical module.']],
            [
                'section_type' => 'workflow',
                'is_active' => true,
                'settings' => [
                    'heading' => 'Obstetrics & Gynecology Clinical Flow',
                    'steps' => [
                        ['title' => 'Initial Consultation & History', 'description' => 'The gynecologist opens the patient\'s OB/GYN record. Past pregnancy history, parity status, social and family history, and surgical history are reviewed. Pre-defined templates for common complaints (infertility, vaginitis, breast lumps) are selected.'],
                        ['title' => 'Prenatal Registration', 'description' => 'For a new pregnancy, a prenatal record is created. LMP, EDD, and gravida/para status are entered. Subsequent prenatal visits are linked to this record and tracked in a longitudinal flow.'],
                        ['title' => 'Ultrasound Recording', 'description' => 'Fetal ultrasound measurements are entered directly from the ultrasound machine interface. GA, BPD, FL, and other parameters are recorded and compared to standard growth charts automatically.'],
                        ['title' => 'Vaccination Tracking', 'description' => 'The system presents pending vaccination alerts at each visit based on the patient\'s immunization history and gestational age. Administered vaccinations are recorded and removed from the pending list.'],
                        ['title' => 'Treatment Plan & Follow-up', 'description' => 'A treatment plan is selected from standard templates per diagnosis — drug, dosage, days, quantity, and advice are all pre-filled. The next visit date is set and an appointment is booked before the patient leaves.'],
                    ]
                ]
            ],
        ]);
    }

    private function seedDialysis(): void
    {
        $this->addSections('dialysis-center', [
            [
                'section_type' => 'workflow',
                'is_active' => true,
                'settings' => [
                    'heading' => 'Dialysis Session Workflow',
                    'steps' => [
                        ['title' => 'Session Scheduling', 'description' => 'The dialysis coordinator books the patient\'s session on the appropriate machine and shift. Machine assignment accounts for infection control — patients with blood-borne infections are scheduled on dedicated machines.'],
                        ['title' => 'Pre-Dialysis Assessment', 'description' => 'Before the session begins, the nurse records weight, blood pressure, access site condition, and any symptoms since the last session. The dialysis prescription (duration, flow rates, membrane type) is confirmed.'],
                        ['title' => 'Session Execution & Monitoring', 'description' => 'Clinical parameters are recorded at defined intervals during the session. Any complications — hypotension, cramps, access issues — are documented in real time.'],
                        ['title' => 'Post-Dialysis Documentation', 'description' => 'Post-session weight, blood pressure, and any post-session symptoms are recorded. Consumable usage (dialyser, bloodline, needles, solutions) is logged per session for inventory and billing purposes.'],
                    ]
                ]
            ],
        ]);
    }

    private function seedDoctorShare(): void
    {
        $this->addSections('doctor-share', [
            [
                'section_type' => 'workflow',
                'is_active' => true,
                'settings' => [
                    'heading' => 'Doctor Share Calculation Workflow',
                    'steps' => [
                        ['title' => 'Rate Configuration', 'description' => 'The billing administrator defines each consultant\'s share rate per service type — a fixed amount, percentage, or tiered structure. Rates can vary by service category (e.g., a higher share for complex procedures than routine consultations).'],
                        ['title' => 'Automatic Calculation at Billing', 'description' => 'When a service is billed to a patient, the system calculates the doctor\'s share automatically using the pre-configured rate. Tax handling (with or without tax) is applied per hospital policy.'],
                        ['title' => 'Equipment & Material Adjustment', 'description' => 'If the doctor provided their own equipment for a procedure, the cost is entered and deducted from the share calculation before the final share amount is posted to the ledger.'],
                        ['title' => 'Ledger & Reporting', 'description' => 'Each doctor maintains a dual ledger — their share account and the hospital\'s revenue account are tracked separately. Monthly share reports can be generated per doctor, per service type, or for any date range.'],
                    ]
                ]
            ],
        ]);
    }

    private function seedSystemSecurity(): void
    {
        $this->addSections('system-security', [
            ['section_type' => 'stats', 'is_active' => true, 'settings' => ['heading' => 'Security Architecture at a Glance', 'stats' => [['value' => 'RBAC', 'label' => 'Role-Based Access Control for every module and menu item'], ['value' => '100%', 'label' => 'Critical transactions logged with user identity & timestamp'], ['value' => 'MAC', 'label' => 'Terminal-level hardware binding for workstation security'], ['value' => 'Zero', 'label' => 'Unauthorized access to confidential patient records']]]],
            [
                'section_type' => 'workflow',
                'is_active' => true,
                'settings' => [
                    'heading' => 'Access Control Workflow',
                    'steps' => [
                        ['title' => 'User Creation & Role Assignment', 'description' => 'HR creates an employee record. The IT/Admin team creates a HIS user account, assigns the user to a job-wise role group, and maps them to their permitted terminals and locations.'],
                        ['title' => 'Login & Session Validation', 'description' => 'The user logs in with their employee code and password from a registered workstation. The system validates the IP address, MAC address, and physical location against the pre-registered terminal configuration. Unregistered devices are rejected.'],
                        ['title' => 'Access Enforcement per Screen', 'description' => 'For every module, menu item, and data field the user attempts to access, permissions are checked against their role. Read-only, write, approve, and delete rights are individually configurable.'],
                        ['title' => 'Audit Logging', 'description' => 'Every critical action — result entry, billing modification, patient record access, report sign-off — is logged to an immutable audit table with user ID, workstation, timestamp, and the nature of the action.'],
                        ['title' => 'Access Review', 'description' => 'Administrators can run periodic user rights review reports to identify over-privileged accounts, inactive users, or unusual access patterns. Reports can be filtered by user, department, module, or date range.'],
                    ]
                ]
            ],
        ]);
    }

    private function seedFrontDesk(): void
    {
        $this->addSections('front-desk', [
            [
                'section_type' => 'workflow',
                'is_active' => true,
                'settings' => [
                    'heading' => 'Front Desk Interaction Flow',
                    'steps' => [
                        ['title' => 'Inquiry Received', 'description' => 'A patient\'s family member or attendant approaches the front desk — in person or by phone. The front desk officer opens the inquiry interface.'],
                        ['title' => 'Patient Search', 'description' => 'The patient is found by MRN, name, phone number, or CNIC. Full visit status is retrieved: which ward they are in, which doctor is treating them, what tests are pending, and what their appointment status is.'],
                        ['title' => 'Information Provided', 'description' => 'The officer provides the requested information and directs the visitor to the correct department, ward, or counter. Complex queries (billing disputes, test result enquiries) are escalated to the relevant department manager.'],
                    ]
                ]
            ],
        ]);
    }

    private function seedStatsDashboard(): void
    {
        $this->addSections('statistics-dashboard', [
            ['section_type' => 'image_banner', 'is_active' => true, 'settings' => ['image_url' => 'https://images.unsplash.com/photo-1551288049-bebda4e38f71?w=1200&q=80', 'image_alt' => 'Hospital statistics and analytics dashboard', 'caption' => 'Real-time hospital-wide KPIs — from bed occupancy to pharmacy stock alerts — on a single executive dashboard.']],
            [
                'section_type' => 'user_roles',
                'is_active' => true,
                'settings' => [
                    'heading' => 'Who Uses the Statistics Dashboard',
                    'roles' => [
                        ['role' => 'CEO / Medical Director', 'icon' => '👔', 'responsibilities' => ['View hospital-wide performance at a glance', 'Monitor revenue vs operational costs', 'Track patient volume trends over time', 'Identify departmental bottlenecks']],
                        ['role' => 'Department Heads', 'icon' => '🏥', 'responsibilities' => ['Monitor their department\'s specific KPIs', 'Track staff productivity and turnaround times', 'Identify high-demand periods for resource planning']],
                        ['role' => 'Finance Manager', 'icon' => '💰', 'responsibilities' => ['Review daily, weekly, and monthly revenue', 'Monitor outstanding balances and doctor shares', 'Track welfare programme impact on revenue']],
                        ['role' => 'IT Administrator', 'icon' => '🖥️', 'responsibilities' => ['Monitor system usage and active user counts', 'Track workstation activity and login anomalies', 'Review module-wise transaction volumes']],
                    ]
                ]
            ],
        ]);
    }

    private function seedHR(): void
    {
        $this->addSections('hr-management', [
            [
                'section_type' => 'workflow',
                'is_active' => true,
                'settings' => [
                    'heading' => 'HR Management Workflow',
                    'steps' => [
                        ['title' => 'Employee Onboarding', 'description' => 'A new staff member\'s profile is created with full personal, professional, and credential details. Department assignment, designation, and employment type are configured.'],
                        ['title' => 'Shift & Roster Management', 'description' => 'Shift schedules are defined per department and staff category. Rosters are generated for the week or month, with the system tracking who is on duty at any given time.'],
                        ['title' => 'Attendance & Leave Tracking', 'description' => 'Attendance is recorded daily. Leave applications are submitted and approved through the system. Leave balances are updated automatically.'],
                        ['title' => 'Payroll Integration', 'description' => 'Attendance data feeds into the payroll calculation. Doctor share data from the billing module is pulled for consultant payroll. Monthly payroll reports are generated for the finance department.'],
                    ]
                ]
            ],
        ]);
    }

    private function seedAssets(): void
    {
        $this->addSections('assets-management', [
            [
                'section_type' => 'workflow',
                'is_active' => true,
                'settings' => [
                    'heading' => 'Asset Lifecycle Management',
                    'steps' => [
                        ['title' => 'Asset Registration', 'description' => 'Every asset is registered on arrival: purchase date, cost, vendor, warranty expiry, serial number, and department location. A barcode or asset tag is generated.'],
                        ['title' => 'Location & Maintenance Tracking', 'description' => 'Asset location is updated whenever the asset moves between departments. Scheduled maintenance dates are recorded, and the system alerts the relevant department when a service is due.'],
                        ['title' => 'Depreciation & Write-Off', 'description' => 'The system calculates depreciation over the asset\'s configured useful life. When an asset reaches end-of-life, a condemnation request is initiated, reviewed by the appropriate authority, and recorded.'],
                    ]
                ]
            ],
        ]);
    }

    private function seedPacs(): void
    {
        $this->addSections('pacs', [
            ['section_type' => 'image_banner', 'is_active' => true, 'settings' => ['image_url' => 'https://images.unsplash.com/photo-1530497610245-94d3c16cda28?w=1200&q=80', 'image_alt' => 'PACS medical imaging system', 'caption' => 'DICOM lossless compression, unlimited workstation licences, and real-time replication across storage servers.']],
            ['section_type' => 'stats', 'is_active' => true, 'settings' => ['heading' => 'PACS Performance', 'stats' => [['value' => 'DICOM', 'label' => 'Full 3.0 class UID support for all modality types'], ['value' => '∞', 'label' => 'Diagnostic workstation licences — no per-seat restriction'], ['value' => '0', 'label' => 'Manual patient data entry at modality machines'], ['value' => 'Real-time', 'label' => 'Storage server replication for disaster recovery']]]],
            [
                'section_type' => 'technical_specs',
                'is_active' => true,
                'settings' => [
                    'heading' => 'PACS Technical Specifications',
                    'specs' => [
                        ['label' => 'Standard', 'value' => 'DICOM 3.0 — all class UIDs for communication'],
                        ['label' => 'Compression', 'value' => 'DICOM lossless compression with image integrity assurance'],
                        ['label' => 'Modalities', 'value' => 'CR, DX, MG, CT, MR, US, ECG, endoscopy, colour imaging'],
                        ['label' => 'Storage', 'value' => 'SAN, NAS, CAS with real-time server replication'],
                        ['label' => 'Export', 'value' => 'JPEG, BMP, WMV, DICOM — auto-run CD generation'],
                        ['label' => 'Viewing', 'value' => 'Dual-monitor support; dual-system comparison reporting'],
                        ['label' => 'Security', 'value' => 'Authentication per modality and client; PACS audit log'],
                        ['label' => 'Licences', 'value' => 'Unlimited diagnostic workstation licences — no restriction'],
                    ],
                    'standards' => ['DICOM 3.0', 'IHE Radiology', 'HL7 v2.x', 'WADO-RS', 'WADO-URI'],
                    'requirements' => ['Gigabit LAN between modalities and PACS server', 'Dedicated SAN/NAS storage per hospital storage policy', 'Dual monitors for reporting workstations']
                ]
            ],
        ]);
    }

    private function seedVoiceReporting(): void
    {
        $this->addSections('voice-reporting', [
            [
                'section_type' => 'workflow',
                'is_active' => true,
                'settings' => [
                    'heading' => 'Voice Reporting Workflow',
                    'steps' => [
                        ['title' => 'Profile Setup', 'description' => 'Each radiologist or pathologist sets up their personal voice profile. They record a set of standard phrases to train the engine to their accent, vocabulary, and speech patterns. Personal shortcut words are configured at this stage.'],
                        ['title' => 'Dictation', 'description' => 'The user opens a study in the reporting module and begins speaking into the microphone. Transcription appears in real time in the report text field. Custom shortcut words expand automatically into full phrases.'],
                        ['title' => 'Review & Correction', 'description' => 'The transcribed text is reviewed on screen. Minor corrections are made by voice or keyboard. The spell checker flags medical terminology issues. The profile learns from corrections over time.'],
                        ['title' => 'Verification', 'description' => 'The report is submitted for electronic verification — either by the same user or a senior reviewer. Once verified, the report is locked and printed automatically at defined locations.'],
                    ]
                ]
            ],
        ]);
    }
}
