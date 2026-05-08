@extends('layouts.app')

@section('content')

    {{-- ═══════════════════════════════════════════════════
        PAGE HERO
    ════════════════════════════════════════════════════ --}}
    <section class="relative pt-36 pb-20 bg-gray-900 overflow-hidden">
        {{-- Background pattern --}}
        <div class="absolute inset-0 pointer-events-none" style="background-image: linear-gradient(rgba(225,29,72,0.04) 1px, transparent 1px), linear-gradient(90deg, rgba(225,29,72,0.04) 1px, transparent 1px); background-size: 48px 48px;"></div>
        <div class="absolute bottom-0 left-0 right-0 h-32 bg-gradient-to-t from-gray-900 to-transparent pointer-events-none"></div>
        <div class="absolute top-0 right-0 w-[600px] h-[600px] rounded-full bg-crimson-500/5 blur-[120px] pointer-events-none"></div>

        <div class="relative max-w-7xl mx-auto px-6 lg:px-8">
            <div class="flex items-center gap-3 mb-6">
                <div class="h-px w-10 bg-crimson-500"></div>
                <span class="text-crimson-500 text-xs font-display tracking-widest uppercase font-600">HIS Product Suite</span>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-end">
                <div>
                    <h1 class="font-display text-5xl lg:text-7xl font-800 text-white leading-[0.92] mb-6">
                        25 Modules.<br>
                        <span class="red-gradient-text">One Platform.</span><br>
                        <span class="text-gray-400">Zero Gaps.</span>
                    </h1>
                    <p class="font-body text-gray-400 text-lg leading-relaxed max-w-lg">
                        Every module in the REDSOL HIS is built around a single unified database — clinical, diagnostic, administrative, and imaging workflows all talking to each other in real time.
                    </p>
                </div>

                {{-- Stats bar --}}
                <div class="grid grid-cols-3 gap-px bg-white/5 rounded-2xl overflow-hidden">
                    @foreach([['25+', 'Integrated Modules'], ['150+', 'Hospitals Live'], ['1', 'Unified Database']] as $s)
                        <div class="bg-gray-900 px-6 py-8 text-center">
                            <div class="font-display font-800 text-3xl text-crimson-400 mb-1">{{ $s[0] }}</div>
                            <div class="font-body text-gray-500 text-xs tracking-wide">{{ $s[1] }}</div>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Category nav --}}
            <div class="mt-14 flex flex-wrap gap-2" id="catNav">
                @foreach(['All Modules', 'Administration', 'Patient Journey', 'Clinical', 'Diagnostics & Imaging', 'Operations'] as $ci => $cat)
                    <button
                        onclick="filterCat(this, '{{ Str::slug($cat) }}')"
                        class="cat-btn px-4 py-2 rounded-lg text-xs font-display font-600 tracking-wide border transition-all duration-200
                               {{ $ci === 0 ? 'bg-crimson-500 text-white border-crimson-500' : 'bg-white/5 text-gray-400 border-white/10 hover:border-crimson-500/30 hover:text-white' }}">
                        {{ $cat }}
                    </button>
                @endforeach
            </div>
        </div>
    </section>


    {{-- ═══════════════════════════════════════════════════
        GENERAL SPECS BANNER
    ════════════════════════════════════════════════════ --}}
    <section class="bg-white border-b border-gray-100 py-5 overflow-hidden">
        <div class="flex gap-10 animate-[ticker_40s_linear_infinite] w-max">
            @php
                $specs = ['ICD-10 Coded','DICOM 3.0','IHE Protocol','CLSI Standards','One Database','Voice Reporting','Lossless PACS Compression','Multi-printer Support','Barcode Integration','Web-based Reports','SNOMED Histopathology','Secure Email Reports','Patient Alerts','Document Scanning'];
                $doubled = array_merge($specs,$specs);
            @endphp
            @foreach($doubled as $spec)
                <div class="flex items-center gap-2.5 shrink-0">
                    <div class="w-1.5 h-1.5 rounded-full bg-crimson-500"></div>
                    <span class="font-body text-sm text-gray-500 whitespace-nowrap">{{ $spec }}</span>
                </div>
            @endforeach
        </div>
    </section>


    {{-- ═══════════════════════════════════════════════════
        MODULES GRID
    ════════════════════════════════════════════════════ --}}
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">

            @php
                $allModules = [

                    // ── ADMINISTRATION ──────────────────────────────
                    [
                        'name'     => 'System Security & Administration',
                        'slug'     => 'system-security',
                        'icon'     => '🔐',
                        'cat'      => 'administration',
                        'cat_label'=> 'Administration',
                        'tagline'  => 'Role-based access control, audit logging & terminal-level security',
                        'desc'     => 'The System Security & Administration module is the foundation every REDSOL deployment is built on. It enforces strict role-based access control so every staff member — from front-desk clerk to radiologist — can only see and perform actions that match their designated job responsibility. Access rights are configured per individual user or grouped into job-wise roles, and every critical transaction is logged to an immutable audit trail. Workstations are pre-registered by MAC address, IP address, and physical location, meaning unauthorised devices simply cannot connect. Patient records can be individually flagged as confidential and made visible only to nominated staff. Administrators receive detailed reports on who accessed any record, what changes were made, and when — providing full forensic visibility into system activity.',
                        'features' => ['Role & group-based menu rights per user','Registered terminal control (MAC + IP + location)','Confidential patient record flagging','Full transaction audit trail with user identification','User access rights review reports','Admin-controlled password & account management'],
                    ],
                    [
                        'name'     => 'Front Desk / Inquiry & Information',
                        'slug'     => 'front-desk',
                        'icon'     => '🗂️',
                        'cat'      => 'administration',
                        'cat_label'=> 'Administration',
                        'tagline'  => 'Central information hub for patients, attendants & hospital staff',
                        'desc'     => 'The Front Desk module is the first digital touchpoint for every patient and their family when they arrive at the hospital. Front office staff can retrieve complete patient information — including visit history, ward location, consultant details, and appointment status — with a single click, eliminating the frustration families face when trying to locate a patient or understand what services have been booked. The module functions as the organisation\'s central point of contact, enabling staff to answer enquiries about any department, consultant, or service without leaving their desk. It acts as the nerve centre that connects registration, appointments, billing and ward data into one unified view.',
                        'features' => ['Single-click full patient information lookup','Family & attendant support interface','Inter-department inquiry routing','Patient location tracking across wards','Consultant availability status','Appointment confirmation & status updates'],
                    ],
                    [
                        'name'     => 'Statistics Dashboard',
                        'slug'     => 'statistics-dashboard',
                        'icon'     => '📊',
                        'cat'      => 'administration',
                        'cat_label'=> 'Administration',
                        'tagline'  => 'Real-time hospital-wide KPIs, analytics & management reporting',
                        'desc'     => 'Hospital leadership needs a clear, real-time view of what is happening across every department simultaneously. The Statistics Dashboard aggregates data from all connected HIS modules and presents it as actionable intelligence — bed occupancy rates, daily OPD/IPD patient counts, laboratory turnaround times, pharmacy stock alerts, revenue collected versus outstanding, and operational bottlenecks. Administrators can drill down by department, date range, doctor, or modality. The dashboard is designed for high-level decision-making, providing the metrics that hospital management needs to control costs, improve patient flow, and track clinical performance without waiting for end-of-day manual reports.',
                        'features' => ['Real-time bed occupancy & ward status','Daily revenue and income reporting','Department-wise patient volume tracking','Laboratory & radiology turnaround analytics','Pharmacy stock level monitoring','Custom KPI configuration per management role'],
                    ],
                    [
                        'name'     => 'HR Management',
                        'slug'     => 'hr-management',
                        'icon'     => '👥',
                        'cat'      => 'administration',
                        'cat_label'=> 'Administration',
                        'tagline'  => 'Staff records, shifts, payroll linkage & workforce administration',
                        'desc'     => 'The HR Management module maintains comprehensive digital records for every member of hospital staff — clinical, administrative, and support. Employee profiles include qualifications, department assignments, shift schedules, leave records, and performance data. The module integrates with the billing and doctor share modules to feed payroll-relevant data and consultant earnings into one system. HR administrators can manage leave approvals, track attendance, and generate workforce reports without spreadsheets or paper files. For healthcare facilities managing hundreds of staff across multiple departments, this module provides the structure needed to run HR operations efficiently and compliantly.',
                        'features' => ['Complete employee digital profiles','Shift scheduling & attendance management','Leave application & approval workflows','Integration with doctor share & billing','Department-wise staff allocation reporting','Qualification & credential tracking'],
                    ],
                    [
                        'name'     => 'Assets Management',
                        'slug'     => 'assets-management',
                        'icon'     => '🏷️',
                        'cat'      => 'administration',
                        'cat_label'=> 'Administration',
                        'tagline'  => 'Hospital equipment & asset lifecycle tracking from procurement to disposal',
                        'desc'     => 'Hospitals operate with expensive, mission-critical equipment — imaging modalities, surgical instruments, diagnostic analysers, and furniture — and losing track of these assets is costly. The Assets Management module gives hospital administrators a complete lifecycle view of every physical asset: when it was procured, where it is located, its current condition, maintenance history, and projected end-of-life. Assets are tracked by department, enabling accurate depreciation accounting and helping procurement teams plan replacements proactively rather than reactively. When equipment is condemned or written off, the module captures the approval workflow and updates asset registers automatically.',
                        'features' => ['Asset registration & barcode tagging','Department-wise asset location tracking','Procurement & purchase order linkage','Maintenance history & service records','Depreciation & write-off management','Condemnation approval workflow'],
                    ],

                    // ── PATIENT JOURNEY ──────────────────────────────
                    [
                        'name'     => 'Patient Registration',
                        'slug'     => 'patient-registration',
                        'icon'     => '👤',
                        'cat'      => 'patient-journey',
                        'cat_label'=> 'Patient Journey',
                        'tagline'  => 'UMRN-linked registration with full demographic capture & patient vault',
                        'desc'     => 'Every patient journey begins here. The Patient Registration module assigns each patient a Unique Medical Record Number (UMRN) tied to their National Identity Number, ensuring a single, persistent record that follows them across every visit, department, and branch. Staff can register patients across multiple categories — General, Private, Panel, or Entitled — and switch between categories as their status changes. The module captures full demographic data along with associated identity documents, and supports registration of family members and dependents under the same household record. A powerful search engine lets staff find patients by name, CNIC, phone number, MRN, or any combination of criteria. At registration, the system generates registration cards, wristbands, and printed labels. Patients also receive a unique online portal login for accessing their reports and history remotely.',
                        'features' => ['UMRN linked to National Identity Number','General / Private / Panel / Entitled categories','Family & dependent registration under one record','Multi-criteria patient search & lookup','Wristband & registration card printing','Duplicate record detection & merging','Patient online portal login generation','View patient vault with full visit history'],
                    ],
                    [
                        'name'     => 'Integrated Appointment System',
                        'slug'     => 'integrated-appointment-system',
                        'icon'     => '📅',
                        'cat'      => 'patient-journey',
                        'cat_label'=> 'Patient Journey',
                        'tagline'  => 'OPD / IPD / VIP slot booking with automated serial numbers & queue generation',
                        'desc'     => 'The Appointment System brings order to one of the most chaotic aspects of hospital operations — managing when patients see which doctor in which room. Patients can book appointments for consultations and diagnostic services through the helpdesk or via a consultant\'s Personal Assistant, with the system enforcing availability by showing only genuinely open slots. Different slot types — OPD, IPD, VIP, and Overbooking — can be configured with separate booking rights for different staff roles. Every booking generates an automated serial number and queues the patient for the correct clinic. The system retains all past appointment data and queue history, giving clinicians the context they need when a patient arrives. Clinical procedures and consultation services have separate configurable appointment templates.',
                        'features' => ['OPD / IPD / VIP / Overbooking slot types','Helpdesk and PA booking modes','Slot availability enforced in real-time','Automated serial number & queue generation','Per-role booking rights configuration','Consultation & clinical procedure scheduling','Full historical appointment records','Clinic room & consultant calendar views'],
                    ],
                    [
                        'name'     => 'Patient Queue Management',
                        'slug'     => 'queue-management',
                        'icon'     => '🔢',
                        'cat'      => 'patient-journey',
                        'cat_label'=> 'Patient Journey',
                        'tagline'  => 'Real-time serial tokens, senior citizen priority & waiting hall displays',
                        'desc'     => 'Long waiting times are one of the leading sources of patient dissatisfaction. The Queue Management module addresses this with real-time serial token assignment, automated room and doctor routing, and live waiting hall displays that show patients their position in the queue. Senior citizens and patients with urgent diagnostic needs can be prioritised automatically based on configurable rules. The Hold Patients feature allows doctors to temporarily defer patients who need urgent tests before returning for consultation — the system holds their queue position and re-inserts them as per defined criteria. Administrators receive alerts when waiting times exceed acceptable thresholds, and detailed reports on average length of stay per doctor, per modality, or per test help identify and eliminate bottlenecks.',
                        'features' => ['Real-time serial token display','Senior citizen priority configuration','Automatic patient routing between rooms/doctors','Hold queue for patients awaiting diagnostics','Waiting hall display integration','Waiting time alerts to administrators','Average length-of-stay reporting per doctor/modality','Today\'s clinic status board'],
                    ],
                    [
                        'name'     => 'Patient Welfare Management',
                        'slug'     => 'patient-welfare',
                        'icon'     => '🤝',
                        'cat'      => 'patient-journey',
                        'cat_label'=> 'Patient Journey',
                        'tagline'  => 'Discount policies, welfare categories & deserving patient management',
                        'desc'     => 'Many hospitals operate welfare programmes for patients who cannot afford clinical services at standard rates. The Patient Welfare Management module formalises these programmes so they are applied consistently, auditably, and without abuse. Hospital management can define multiple discount policies and patient welfare categories — each with its own eligibility rules, discount percentages, and validity periods. Approved welfare patients are stored in a dedicated vault, with expiry and renewal tracking to ensure that benefits are only applied to current eligible beneficiaries. All supporting documentation submitted by welfare applicants is digitally archived within the module, creating a complete, auditable record for compliance and review purposes.',
                        'features' => ['Multiple welfare policy & category management','Discount percentage configuration per category','Approved welfare patient vault','Expiry & renewal date tracking','Supporting document digital archiving','Eligibility audit trail for compliance'],
                    ],
                    [
                        'name'     => 'Admission & Discharge System',
                        'slug'     => 'admission-discharge',
                        'icon'     => '🛏️',
                        'cat'      => 'patient-journey',
                        'cat_label'=> 'Patient Journey',
                        'tagline'  => 'IPD bed management, barcoded wristbands & automatic discharge billing',
                        'desc'     => 'When a patient is admitted, the Admission & Discharge module takes over from registration and handles the full inpatient lifecycle — from bed assignment to the moment the final bill is settled and the patient walks out. A barcoded wristband is generated at admission, carrying the patient\'s diagnosis and reason for admission. The system tracks every service, medicine dispensed, procedure ordered, and consumable used during the stay, feeding data to the billing engine continuously so that when discharge comes, a complete itemised bill is ready in seconds. Bed and IPD queue management ensure ward managers always know which beds are occupied, which are being cleaned, and which are available. Follow-up appointments are scheduled at the point of discharge.',
                        'features' => ['Barcoded wristband generation at admission','IPD bed availability & queue management','Automatic accumulative billing throughout stay','Full discharge bill generation at exit','Provisional diagnosis recording at admission','Patient transfer between beds & wards','Discharge summary & follow-up scheduling','History of all past admissions & discharges'],
                    ],

                    // ── CLINICAL ──────────────────────────────
                    [
                        'name'     => 'Outdoor Clinics & Consultant Practice',
                        'slug'     => 'outdoor-clinics',
                        'icon'     => '🩺',
                        'cat'      => 'clinical',
                        'cat_label'=> 'Clinical',
                        'tagline'  => 'SOAP notes, CPOE prescribing, inter-department referrals & clinical templates',
                        'desc'     => 'The Outdoor Clinics & Consultant Practice module is where the clinical encounter happens. Doctors document consultations using structured SOAP (Subjective, Objective, Assessment, Plan) notes, with customisable templates that can be tailored to each specialty. The Computerised Physician Order Entry (CPOE) engine allows consultants to order investigations, prescriptions, and procedures directly from the consultation screen, with real-time medicine stock visibility so they only prescribe what is available. Patients can be referred to senior consultants, other internal departments, or external organisations through a health information exchange framework. Discharged and deceased patient records are maintained in separate vaults for regulatory compliance. The module integrates directly with registration, pharmacy, diagnostics, and billing so no data needs to be re-entered.',
                        'features' => ['Structured SOAP consultation documentation','CPOE for investigations & prescriptions','Real-time pharmacy stock at point of order','Customisable specialty-specific templates','Inter-department & external hospital referrals','Discharged vault & death vault management','Clinical group & template library','Pre-admission & post-discharge treatment tracking'],
                    ],
                    [
                        'name'     => 'Emergency Center Management',
                        'slug'     => 'emergency-center',
                        'icon'     => '🚨',
                        'cat'      => 'clinical',
                        'cat_label'=> 'Clinical',
                        'tagline'  => 'Triage-to-discharge workflow for emergency patients with full clinical documentation',
                        'desc'     => 'Emergency departments run on speed and accuracy — the Emergency Center module is built for exactly that environment. From the moment a casualty arrives at the reception desk, their primary demographic data is captured quickly — even if incomplete — and updated as more information becomes available. A triage assessment sheet is completed by the attending doctor, diagnostic services are ordered immediately, and the pharmacy is alerted for urgent medicine requirements. Nurses enter vitals for every patient at each shift handover. The doctor call system is integrated so consultants can be summoned from within the module. Emergency episode summaries, inpatient admission notes, discharge summaries, and surgical process creation are all handled from a single workflow, ensuring the emergency episode is fully documented regardless of how chaotic the department is.',
                        'features' => ['Rapid registration with partial data capture','Triage management & filter clinic workflow','Doctor assessment sheet & diagnostic ordering','Emergency pharmacy orders on MR# basis','Shift-by-shift nurse vitals entry','Doctor call system integration','Emergency episode summary generation','Admission notes & surgical process creation','Zero-cost service approval by administration'],
                    ],
                    [
                        'name'     => 'Nursing Counter / Wards Management',
                        'slug'     => 'nursing-wards',
                        'icon'     => '🏥',
                        'cat'      => 'clinical',
                        'cat_label'=> 'Clinical',
                        'tagline'  => 'Bed management, vitals, medication dispensing & full ward integration',
                        'desc'     => 'The Nursing & Wards module connects everything that happens after a patient is admitted to a bed. Ward nursing staff have full access to patient registration data, investigation history, and medication records from any ward counter terminal. Online medicine and investigation requests go directly to the pharmacy and diagnostic departments without paper slips. Vitals, intake/output measurements, and nursing care activities are recorded in the system against each patient encounter. The module manages bed allocation, patient transfers between wards, and the movement of patients to and from the operation theatre. It integrates in real time with indoor pharmacies, lab, radiology, cardiology, and pathology, and the billing system accumulates all ward-level charges automatically — estimated length of stay, cost of stay, and drug costs are available at any time.',
                        'features' => ['Ward patient registration data access','Online medicine & investigation requests','Vitals, intake/output & nursing care records','Bed allocation & inter-ward transfer management','OT transfer integration','Real-time indoor pharmacy stock integration','Investigation summary sheets','Estimated cost-of-stay calculations','Nursing ordering & notes management'],
                    ],
                    [
                        'name'     => 'Operation Theatre Management',
                        'slug'     => 'operation-theatre',
                        'icon'     => '⚕️',
                        'cat'      => 'clinical',
                        'cat_label'=> 'Clinical',
                        'tagline'  => 'Surgery scheduling, anesthesia tracking, OT checklists & perfusionist records',
                        'desc'     => 'From elective procedure planning to emergency surgical prioritisation, the Operation Theatre module manages the full perioperative workflow. Patient registration records flow automatically to the OT counter dashboard. Operators can assign surgeons, select vacant slots from the consultant\'s calendar, and schedule the procedure — with the system sending automated alerts to the patient, surgeon, and anaesthetist. A pre-defined checklist enforces preparation steps before the actual OT process begins. Anesthesia requests, pre- and post-anesthetic checkup records, perfusionist parameters, and operative notes are all captured. In emergencies, surgery scheduling can be instantly prioritised and all concerned parties notified. Barcode wrist tags are generated for every surgical patient. Sample containers are barcoded and laboratory results tracked from within the module.',
                        'features' => ['Elective & emergency surgery scheduling','Surgeon calendar slot selection','Pre-surgery checklist enforcement','Anesthesia request & checkup records','Perfusionist parameter capture','Barcode wrist tag generation','Sample collection & lab result tracking','Post-operative notes & assessment records','Automated alerts to surgeon & anaesthetist'],
                    ],
                    [
                        'name'     => 'Gynecology Management System',
                        'slug'     => 'gynecology',
                        'icon'     => '👶',
                        'cat'      => 'clinical',
                        'cat_label'=> 'Clinical',
                        'tagline'  => 'Prenatal records, OB/GYN templates, ultrasound interface & immunization tracking',
                        'desc'     => 'The Gynecology module provides a structured clinical environment for OB/GYN consultants managing the full spectrum of women\'s health — from routine consultations and prenatal care to complex cases involving infertility, incontinence, or obstetric complications. Pre-defined OB/GYN complaint templates cover breast lumps, sexual health, vaginitis, and other common presentations. Prenatal flow records, genetic screening results, and fetal ultrasound measurements are recorded against each pregnancy episode. Detailed past pregnancy history, parity status, and family planning records are maintained in one accessible record. The system sends clinical alerts when vaccinations are due at the time of each visit. An ultrasound imaging interface records measurements directly, and vital parameters including weight, height, and blood pressure trends are tracked visit-by-visit.',
                        'features' => ['Prenatal flow record & fetal ultrasound interface','Detailed past pregnancy & parity history','OB/GYN complaint & examination templates','Genetic screening result recording','Immunization tracking with visit-time alerts','Vital parameter trend charts (weight, BP, height)','Multiple treatment plan management per diagnosis','Anti-natal, obstetrics & gynecology history tabs','Social, family & surgical history capture'],
                    ],
                    [
                        'name'     => 'Dialysis Center Management',
                        'slug'     => 'dialysis-center',
                        'icon'     => '💉',
                        'cat'      => 'clinical',
                        'cat_label'=> 'Clinical',
                        'tagline'  => 'Session scheduling, consumable tracking & dialysis patient history management',
                        'desc'     => 'Patients receiving regular dialysis treatments require a carefully managed schedule, consistent consumable supply, and an accurate record of every session they have undergone. The Dialysis Center module provides all of this in one place. Session scheduling ensures equipment and staff are available at the correct times without conflicts. The module tracks every consumable — dialysers, bloodlines, fistula needles, and solutions — used per patient per session and integrates with the inventory and pharmacy modules to trigger replenishment before stock runs low. A comprehensive patient history records all dialysis sessions, clinical parameters monitored during treatment, and any complications or interventions recorded. Billing for dialysis sessions is handled automatically through the patient billing integration.',
                        'features' => ['Dialysis session scheduling & calendar','Consumable usage tracking per session','Low stock alerts linked to inventory & pharmacy','Full patient session history with clinical parameters','Complication & intervention recording','Automatic billing integration per session','Machine allocation & utilisation reports'],
                    ],
                    [
                        'name'     => 'Doctor Share',
                        'slug'     => 'doctor-share',
                        'icon'     => '💼',
                        'cat'      => 'clinical',
                        'cat_label'=> 'Clinical',
                        'tagline'  => 'Automated consultant share calculation, dual ledger & equipment charge adjustment',
                        'desc'     => 'Calculating and distributing consultant shares manually is error-prone and a source of constant disputes between hospitals and their doctors. The Doctor Share module automates the entire process based on pre-configured individual share rates for each service type. Where a doctor supplies their own equipment or materials during a patient procedure, the system adjusts the share calculation to account for those costs. A dual doctor ledger system handles scenarios where multiple consultants are involved in the same patient episode, and limited-amount account booking is supported for complex billing arrangements. Share reports can be generated per doctor, per service type, or for any date range, providing transparent, auditable records that both hospital management and consultants can trust.',
                        'features' => ['Individual doctor share rates per service','Equipment & material charge adjustment','Dual doctor ledger management','Limited-amount booking support','Share reports by doctor, service & date range','Integration with patient billing system','Tax-inclusive & tax-exclusive calculations'],
                    ],

                    // ── DIAGNOSTICS & IMAGING ──────────────────────────────
                    [
                        'name'     => 'Laboratory (LIMS)',
                        'slug'     => 'laboratory-lims',
                        'icon'     => '🧪',
                        'cat'      => 'diagnostics',
                        'cat_label'=> 'Diagnostics & Imaging',
                        'tagline'  => 'Barcode specimens, analyzer integration, LOINC/SNOMED codes & web-based reports',
                        'desc'     => 'The Laboratory Information Management System is a full-featured, standards-compliant solution for hospitals processing hundreds of lab orders per day. Specimens are identified with barcoded stickers from the moment they are collected, with phlebotomists scanning tubes using a wand to confirm specimen identity at every handling step — eliminating the sample mix-up errors that compromise patient safety. Automated analyser interfaces capture result data directly from instruments in real time, with support for suppressing specific instrument parameters from displaying in result entry when needed. Multiple procedures can be bundled into a single accession number based on section-defined parameters. Critical value alerts and delta value thresholds notify lab staff before results are released. Pathologist names appear on every report footer. Results can only be amended via addendum after verification — protecting the integrity of the official record. Patients access their results online via a unique portal login generated at registration.',
                        'features' => ['Barcode specimen identification & phlebotomy wand scan','Automated analyser result capture via computer interface','Critical value & delta threshold alerts','LOINC logical observation codes','SNOMED codes for histopathology','QC rule validation before result release','Web-based patient report portal','Addendum-only amendments post-verification','Collection centre & sample collection point management','Disaster recovery & backup system'],
                    ],
                    [
                        'name'     => 'Radiology Information System',
                        'slug'     => 'radiology-ris',
                        'icon'     => '🩻',
                        'cat'      => 'diagnostics',
                        'cat_label'=> 'Diagnostics & Imaging',
                        'tagline'  => 'Online order entry, voice recognition reporting, worklists & full audit trails',
                        'desc'     => 'The Radiology Information System provides end-to-end management of the radiology department workflow — from the moment an order is placed by a clinician to the moment a verified report reaches the requesting doctor. Orders are entered online with automatic charge generation, and technologist work lists are updated in real time as orders are placed, modified, or cancelled. Each radiologist has a personalised, filterable work list with sorting and column control tools. Result reporting supports multiple methods: drop-down template selection, voice recognition, and conventional phone dictation. Coded report templates can be modified as required. The system maintains complete audit trails — every access, edit, approval, and print is recorded with time stamps. Resident readings can be sent back by attending radiologists for teaching review. Automatic printing of verified reports occurs at defined locations without radiologist involvement.',
                        'features' => ['Online radiology order entry with charge generation','Real-time auto-updating technologist work lists','Personalised per-radiologist work list filtering','Voice recognition, drop-down & dictation reporting','Coded template library with modification rights','Complete time-stamped audit trails','Resident readings with consultant review & feedback','Automatic verified report printing at defined locations','Film, contrast & consumable issuance recording','Performance, financial & administration reports'],
                    ],
                    [
                        'name'     => 'PACS',
                        'slug'     => 'pacs',
                        'icon'     => '🖥️',
                        'cat'      => 'diagnostics',
                        'cat_label'=> 'Diagnostics & Imaging',
                        'tagline'  => 'DICOM 3.0 image archiving, lossless compression & unlimited workstation licenses',
                        'desc'     => 'The Picture Archiving & Communication System handles the full imaging lifecycle — capture, transfer, storage, distribution, retrieval, and display — for every modality in the hospital. It is tightly integrated with the HIS on a single database, ensuring that patient demographic data flows automatically to modality machines without manual re-entry, eliminating typographical errors and saving technologist time. DICOM 3.0 is supported across all communication class UIDs, and the system is compatible with CR, DX, MG, CT, MR, US, ECG, and colour imaging. DICOM lossless compression preserves absolute image integrity while dramatically reducing storage requirements. The system supports dual monitors for PACS reporting, simultaneous multi-system comparison, and automatically fetches prior studies for comparison. Unlimited diagnostic workstation licences mean there are no restrictions on the number of radiologists who can report simultaneously.',
                        'features' => ['Full DICOM 3.0 class UID support','CR, DX, MG, CT, MR, US, ECG & colour imaging','DICOM lossless compression with image integrity assurance','Unlimited diagnostic workstation licences','Dual-monitor & dual-system comparison reporting','Automatic prior study retrieval for comparison','SAN, NAS & CAS storage support with real-time replication','Study access audit log & authentication','Auto-run CD generation for physician reference','Endoscopy & scope imaging data integration'],
                    ],
                    [
                        'name'     => 'Voice-Based Report Generation',
                        'slug'     => 'voice-reporting',
                        'icon'     => '🎙️',
                        'cat'      => 'diagnostics',
                        'cat_label'=> 'Diagnostics & Imaging',
                        'tagline'  => '10-workstation integrated voice reporting across radiology and laboratory',
                        'desc'     => 'Voice recognition reporting dramatically increases the speed at which radiologists and pathologists produce verified reports. Rather than typing full report text, clinicians dictate directly into the system using a microphone, and the voice engine transcribes their words in real time. The system supports up to 10 simultaneous workstations for voice-based reporting, and every user has a personalised voice profile and shortcut word library that the engine adapts to over time — improving accuracy as the system learns each clinician\'s vocabulary and speech patterns. Voice reporting is fully integrated across both the Radiology Information System and LIMS, so all dictated reports appear in the standard reporting workflow without any additional steps. Reports can still be edited, addended, and verified through the normal review and electronic signature process.',
                        'features' => ['10-workstation concurrent voice reporting','Personalised voice profile per radiologist/pathologist','Custom shortcut words & phrase library','Real-time transcription to report entry','Fully integrated with RIS & LIMS workflows','Electronic verification & signature post-dictation','Addendum support on verified voice reports','Remote workstation access for verification'],
                    ],

                    // ── OPERATIONS ──────────────────────────────
                    [
                        'name'     => 'Patient Billing System',
                        'slug'     => 'patient-billing-system',
                        'icon'     => '💳',
                        'cat'      => 'operations',
                        'cat_label'=> 'Operations & Supply',
                        'tagline'  => 'Service billing, doctor share distribution, package management & income reports',
                        'desc'     => 'The Patient Billing System is the financial engine of the HIS, tracking every rupee that flows through the hospital\'s service delivery. It integrates directly with the patient registration module so all demographic data is available at billing time without re-entry. Service costs are entered and managed through front-end forms, and different service packages with configurable financial impacts can be set up and modified by billing administrators. The system handles both OPD and IPD billing, feeding the doctor share calculation module with service data as treatments occur. Daily income statements — with and without tax — are generated automatically from cash collection data, and the accounts department receives reconciled financial data directly. Fee collection slips, detailed service breakdowns, and institutional private practice billing are all supported.',
                        'features' => ['OPD & IPD billing management','Service package creation & pricing management','Daily income statement (with & without tax)','Doctor share calculation & distribution','Fee collection slips & service cost reports','Institutional private practice billing','Integration with registration & accounts','Tax-inclusive & tax-exclusive financial reporting'],
                    ],
                    [
                        'name'     => 'Pharmacy Management',
                        'slug'     => 'pharmacy',
                        'icon'     => '💊',
                        'cat'      => 'operations',
                        'cat_label'=> 'Operations & Supply',
                        'tagline'  => 'CPOE-integrated dispensing, formulary management, real-time stock & demand-based issuance',
                        'desc'     => 'The Pharmacy module is the bridge between clinical prescription and physical medicine dispensing. Pharmacists and dispensers view CPOE-generated prescriptions directly on their workstation — there are no paper prescription slips that can be lost or misread. Medicines are categorised into formulary/non-formulary, restricted/non-restricted, and therapeutic groups, with dispensing policies configurable per category. Drug-drug interactions, adverse effects, dosage, and frequency data are maintained in the medicines master. The module maintains real-time stock data and integrates demand requests with approval-based issuance workflows, ensuring that medicines are only dispensed to authorised patients in authorised quantities. A comprehensive set of reports — medicine-wise daily receiving and issuance, stock status by date range, and integrated stock — give pharmacy managers complete inventory control.',
                        'features' => ['CPOE prescription-to-dispensing integration','Formulary / non-formulary & restricted medicines','Medicine generic & brand management','Dosage, strength, adverse effects & precaution records','Real-time stock with demand-approval issuance','Patient-type & drug-based ordering configurations','Return & refunding of medicines','Prescription edit rights for pharmacists','Integrated patient queue at pharmacy counter','Continue treatment rules & restriction policies'],
                    ],
                    [
                        'name'     => 'Inventory Management',
                        'slug'     => 'inventory',
                        'icon'     => '📦',
                        'cat'      => 'operations',
                        'cat_label'=> 'Operations & Supply',
                        'tagline'  => 'Warehouse, sub-stores, GRN, purchase orders & condemnation workflows',
                        'desc'     => 'Hospitals consume vast quantities of consumable supplies — stationary, general items, surgical disposables, furniture, and equipment — and managing this without a structured inventory system results in either overstocking that wastes budget or stockouts that delay care. The Inventory Management module covers the complete supply chain from vendor management and purchase order creation through goods receipt, inspection, warehouse allocation, and sub-store issuance. Demand requests from departments are submitted digitally and approved or rejected based on stock availability and authorised limits. Stock transfers between stores, reserved stock management, and regular stock audits are all supported. When items reach end-of-life, a formal condemnation process is initiated through the module, creating an auditable disposal record.',
                        'features' => ['Vendor, manufacturer & brand management','Category & item master index management','Purchase order generation & local procurement','Goods receiving notes & goods inspection notes','Warehouse, main stores & sub-stores management','Stock consumption & transfer tracking','Demand request with approval/rejection workflow','Periodic, random & regular stock audit support','Condemnation approval & disposal recording','Integration with pharmacy & ward modules'],
                    ],
                ];

                $catColors = [
                    'administration'  => ['bg' => 'bg-gray-900',        'text' => 'text-white',       'badge_bg' => 'bg-white/10',          'badge_text' => 'text-gray-300',   'accent' => 'bg-crimson-500'],
                    'patient-journey' => ['bg' => 'bg-white',           'text' => 'text-gray-900',    'badge_bg' => 'bg-crimson-500/8',     'badge_text' => 'text-crimson-600','accent' => 'bg-crimson-500'],
                    'clinical'        => ['bg' => 'bg-white',           'text' => 'text-gray-900',    'badge_bg' => 'bg-gray-100',          'badge_text' => 'text-gray-600',   'accent' => 'bg-gray-800'],
                    'diagnostics'     => ['bg' => 'bg-gray-900',        'text' => 'text-white',       'badge_bg' => 'bg-crimson-500/15',    'badge_text' => 'text-crimson-400','accent' => 'bg-crimson-500'],
                    'operations'      => ['bg' => 'bg-white',           'text' => 'text-gray-900',    'badge_bg' => 'bg-crimson-500/8',     'badge_text' => 'text-crimson-600','accent' => 'bg-crimson-500'],
                ];
            @endphp

            {{-- Section headers per category --}}
            @php
                $sections = [
                    'administration'  => ['label' => 'Administration & Security',    'desc' => 'The operational and security foundation of the entire platform — access control, reporting, HR, and asset management.'],
                    'patient-journey' => ['label' => 'Patient Journey',              'desc' => 'Every touchpoint from first registration to final discharge — registration, appointments, queuing, welfare and admission.'],
                    'clinical'        => ['label' => 'Clinical & Departmental',      'desc' => 'Department-level clinical modules covering consultation, emergency, wards, surgery, gynecology and specialist centres.'],
                    'diagnostics'     => ['label' => 'Diagnostics & Imaging',        'desc' => 'Full lab, radiology and PACS suite — DICOM, analyzers, voice reporting, lossless compression and unlimited licences.'],
                    'operations'      => ['label' => 'Operations & Supply Chain',    'desc' => 'Billing, pharmacy dispensing, and inventory management — the financial and supply backbone of the hospital.'],
                ];
                $currentCat = '';
            @endphp

            @foreach($allModules as $mi => $module)

                {{-- Category divider --}}
                @if($currentCat !== $module['cat'])
                    @php $currentCat = $module['cat']; $sec = $sections[$currentCat]; @endphp
                    <div class="module-section mt-16 mb-8 reveal" data-cat="{{ $currentCat }}">
                        <div class="flex items-center gap-4">
                            <div class="h-px flex-1 bg-gray-100 max-w-[60px]"></div>
                            <span class="text-crimson-500 text-xs font-display tracking-widest uppercase font-600">{{ $sec['label'] }}</span>
                            <div class="h-px flex-1 bg-gray-100"></div>
                        </div>
                        <p class="text-center font-body text-sm text-gray-400 mt-2">{{ $sec['desc'] }}</p>
                    </div>
                @endif

                {{-- Module card --}}
                @php $c = $catColors[$module['cat']]; @endphp
                <div class="module-card group rounded-3xl border border-gray-100 overflow-hidden mb-5 reveal reveal-delay-{{ ($mi % 3) + 1 }} transition-all duration-500 hover:shadow-2xl hover:shadow-black/8 hover:-translate-y-1"
                     data-cat="{{ $module['cat'] }}">

                    <div class="{{ $c['bg'] }} p-8 lg:p-10">
                        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                            {{-- Left: identity --}}
                            <div class="lg:col-span-1">
                                <div class="flex items-start gap-4 mb-6">
                                    <div class="text-4xl leading-none">{{ $module['icon'] }}</div>
                                    <div class="flex-1">
                                        <span class="inline-block text-[10px] font-display font-600 tracking-wider uppercase px-2.5 py-1 rounded-full {{ $c['badge_bg'] }} {{ $c['badge_text'] }} border border-current/20 mb-2">
                                            {{ $module['cat_label'] }}
                                        </span>
                                        <h3 class="font-display font-800 {{ $c['text'] }} text-xl leading-tight">
                                            {{ $module['name'] }}
                                        </h3>
                                    </div>
                                </div>

                                <p class="{{ $module['cat'] === 'administration' || $module['cat'] === 'diagnostics' ? 'text-gray-400' : 'text-gray-500' }} font-body text-sm leading-relaxed mb-6 italic">
                                    "{{ $module['tagline'] }}"
                                </p>

                                <a href="/products/{{ $module['slug'] }}"
                                   class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl text-sm font-display font-600 transition-all duration-200
                                          {{ $module['cat'] === 'administration' || $module['cat'] === 'diagnostics'
                                            ? 'bg-crimson-500 text-white hover:bg-crimson-600 hover:shadow-lg hover:shadow-crimson-500/25'
                                            : 'bg-crimson-500 text-white hover:bg-crimson-600 hover:shadow-lg hover:shadow-crimson-500/20' }}">
                                    View Full Details
                                    <svg class="w-3.5 h-3.5 group-hover:translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                    </svg>
                                </a>
                            </div>

                            {{-- Middle: description --}}
                            <div class="lg:col-span-1">
                                <p class="{{ $module['cat'] === 'administration' || $module['cat'] === 'diagnostics' ? 'text-gray-400' : 'text-gray-600' }} font-body text-sm leading-[1.85]">
                                    {{ $module['desc'] }}
                                </p>
                            </div>

                            {{-- Right: features --}}
                            <div class="lg:col-span-1">
                                <div class="flex items-center gap-2 mb-4">
                                    <div class="w-4 h-px {{ $c['accent'] }}"></div>
                                    <span class="{{ $module['cat'] === 'administration' || $module['cat'] === 'diagnostics' ? 'text-gray-400' : 'text-gray-400' }} text-xs font-display tracking-widest uppercase font-600">Key Features</span>
                                </div>
                                <ul class="space-y-2.5">
                                    @foreach($module['features'] as $feat)
                                        <li class="flex items-start gap-2.5">
                                            <svg class="w-3.5 h-3.5 text-crimson-500 mt-0.5 shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                            </svg>
                                            <span class="{{ $module['cat'] === 'administration' || $module['cat'] === 'diagnostics' ? 'text-gray-400' : 'text-gray-600' }} font-body text-xs leading-relaxed">{{ $feat }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>


    {{-- ═══════════════════════════════════════════════════
        CTA SECTION
    ════════════════════════════════════════════════════ --}}
    <section class="py-24 bg-gray-900 border-t border-gray-800">
        <div class="max-w-4xl mx-auto px-6 text-center reveal">
            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full border border-crimson-500/25 bg-crimson-500/8 mb-8">
                <span class="w-2 h-2 rounded-full bg-crimson-500 animate-pulse"></span>
                <span class="text-crimson-400 text-xs font-display tracking-widest uppercase font-600">See it in action</span>
            </div>
            <h2 class="font-display text-4xl lg:text-5xl font-800 text-white leading-tight mb-5">
                Ready to See REDSOL<br><span class="red-gradient-text">in Your Hospital?</span>
            </h2>
            <p class="font-body text-gray-400 text-lg max-w-xl mx-auto mb-10">
                Schedule a free walkthrough of any module — or all 25 at once. Our team will show you exactly how REDSOL maps to your specific workflows.
            </p>
            <div class="flex flex-wrap gap-4 justify-center">
                <a href="/contact" class="group flex items-center gap-3 px-10 py-4 rounded-2xl bg-crimson-500 text-white font-display font-700 text-sm hover:bg-crimson-600 transition-all duration-300 hover:scale-105 hover:shadow-xl hover:shadow-crimson-500/30">
                    Request a Demo
                    <svg class="w-4 h-4 group-hover:translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </a>
                <a href="/services" class="group flex items-center gap-3 px-10 py-4 rounded-2xl border border-white/15 text-gray-300 font-display font-600 text-sm hover:border-crimson-500/40 hover:text-crimson-400 transition-all duration-300">
                    View All Services
                </a>
            </div>
        </div>
    </section>

@endsection

@push('head')
    <style>
        .red-gradient-text {
            background: linear-gradient(135deg, #e11d48 0%, #9f1239 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        @keyframes ticker {
            0%   { transform: translateX(0); }
            100% { transform: translateX(-50%); }
        }
        .reveal {
            opacity: 0;
            transform: translateY(28px);
            transition: opacity 0.75s cubic-bezier(0.16,1,0.3,1), transform 0.75s cubic-bezier(0.16,1,0.3,1);
        }
        .reveal.visible { opacity: 1; transform: translateY(0); }
        .reveal-delay-1 { transition-delay: 0.06s; }
        .reveal-delay-2 { transition-delay: 0.12s; }
        .reveal-delay-3 { transition-delay: 0.18s; }

        /* Hide filtered cards */
        .module-card.filtered-out {
            display: none;
        }
        .module-section.filtered-out {
            display: none;
        }
    </style>
@endpush

@push('scripts')
    <script>
        // Scroll reveal
        const obs = new IntersectionObserver(entries => {
            entries.forEach(e => { if (e.isIntersecting) e.target.classList.add('visible'); });
        }, { threshold: 0.05, rootMargin: '0px 0px -40px 0px' });
        document.querySelectorAll('.reveal').forEach(el => obs.observe(el));

        // Category filter
        function filterCat(btn, cat) {
            // Update button styles
            document.querySelectorAll('.cat-btn').forEach(b => {
                b.classList.remove('bg-crimson-500', 'text-white', 'border-crimson-500');
                b.classList.add('bg-white/5', 'text-gray-400', 'border-white/10');
            });
            btn.classList.add('bg-crimson-500', 'text-white', 'border-crimson-500');
            btn.classList.remove('bg-white/5', 'text-gray-400', 'border-white/10');

            const cards = document.querySelectorAll('.module-card');
            const sections = document.querySelectorAll('.module-section');

            if (cat === 'all-modules') {
                cards.forEach(c => c.classList.remove('filtered-out'));
                sections.forEach(s => s.classList.remove('filtered-out'));
            } else {
                // Map button slug to data-cat value
                const catMap = {
                    'administration': 'administration',
                    'patient-journey': 'patient-journey',
                    'clinical': 'clinical',
                    'diagnostics-imaging': 'diagnostics',
                    'operations': 'operations',
                };
                const dataCat = catMap[cat] || cat;

                cards.forEach(c => {
                    c.dataset.cat === dataCat
                        ? c.classList.remove('filtered-out')
                        : c.classList.add('filtered-out');
                });
                sections.forEach(s => {
                    s.dataset.cat === dataCat
                        ? s.classList.remove('filtered-out')
                        : s.classList.add('filtered-out');
                });
            }

            // Re-trigger reveals for visible cards
            document.querySelectorAll('.module-card:not(.filtered-out)').forEach(el => {
                el.classList.remove('visible');
                setTimeout(() => obs.observe(el), 50);
            });
        }
    </script>
@endpush
