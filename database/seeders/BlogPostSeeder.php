<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\BlogPost;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Carbon\Carbon;

class BlogPostSeeder extends Seeder
{
  public function run(): void
  {
    // Find or create a default admin author
    $author = Admin::first() ?? Admin::create([
      'name' => 'REDSOL Editorial Team',
      'email' => 'admin@redsol.com',
      'password' => bcrypt('changeme123'),
      'role' => 'editor',
    ]);

    $title = 'How Digital Transformation is Revolutionizing Pakistani Hospitals';
    $slug = Str::slug($title);

    // Ensure unique slug
    $counter = 1;
    $originalSlug = $slug;
    while (BlogPost::where('slug', $slug)->exists()) {
      $slug = $originalSlug . '-' . $counter++;
    }

    BlogPost::create([
      'title' => $title,
      'slug' => $slug,
      'excerpt' => 'From paper charts to cloud-based HIS: a look at how healthcare providers across Pakistan are leveraging technology to improve patient outcomes, reduce costs, and scale operations.',
      'body' => <<<'HTML'
<p class="lead">The healthcare landscape in Pakistan is undergoing a quiet revolution. What once meant stacks of paper files, manual billing, and fragmented patient records is rapidly transforming into integrated, data-driven care delivery powered by modern Health Information Systems (HIS).</p>

<h2>The Challenge: Fragmented Care, Manual Processes</h2>
<p>For decades, hospitals across Pakistan—from district headquarters in Rahim Yar Khan to tertiary care centers in Lahore—have operated with siloed departments. Patient registration happened at the front desk, lab orders were handwritten, pharmacy inventory was tracked on spreadsheets, and billing was a month-end reconciliation nightmare.</p>

<blockquote>
  "We were spending 30% of our administrative staff's time just chasing down missing files and reconciling manual entries." 
  <footer>— Medical Superintendent, Public Sector Hospital, Punjab</footer>
</blockquote>

<p>This fragmentation didn't just slow operations—it impacted patient safety. Missed allergies, duplicate tests, delayed discharges, and revenue leakage became common pain points.</p>

<h2>The Shift: Integrated HIS as a Foundation</h2>
<p>Digital transformation in healthcare isn't about replacing doctors with software. It's about <strong>augmenting clinical judgment with real-time data</strong>. A well-implemented HIS connects:</p>

<ul>
  <li><strong>Patient Journey</strong>: From registration → OPD → diagnostics → admission → discharge → follow-up, all on a single digital thread.</li>
  <li><strong>Clinical Workflows</strong>: CPOE (Computerized Physician Order Entry), e-prescriptions, nursing notes, and care plans accessible at the point of care.</li>
  <li><strong>Operational Intelligence</strong>: Real-time dashboards for bed occupancy, OT utilization, pharmacy stock, and revenue cycles.</li>
  <li><strong>Compliance & Reporting</strong>: Automated ICD-10 coding, DICOM integration for imaging, and audit-ready logs for regulatory bodies.</li>
</ul>

<figure>
  <img src="/storage/blog/his-architecture-diagram.jpg" alt="Integrated HIS architecture showing connected modules">
  <figcaption>Figure 1: How modules interconnect in a unified HIS—data flows seamlessly between departments.</figcaption>
</figure>

<h2>Real Impact: Metrics That Matter</h2>
<p>Hospitals that have completed digital transformation report measurable improvements:</p>

<table>
  <thead>
    <tr>
      <th>Metric</th>
      <th>Before HIS</th>
      <th>After HIS</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>Patient registration time</td>
      <td>12–18 minutes</td>
      <td>2–4 minutes</td>
    </tr>
    <tr>
      <td>Lab report turnaround</td>
      <td>4–24 hours</td>
      <td>30–90 minutes</td>
    </tr>
    <tr>
      <td>Pharmacy stockouts</td>
      <td>Weekly occurrences</td>
      <td>Near-zero with auto-reorder</td>
    </tr>
    <tr>
      <td>Revenue leakage</td>
      <td>15–25% estimated</td>
      <td>&lt;3% with automated billing</td>
    </tr>
    <tr>
      <td>Patient satisfaction</td>
      <td>68% (survey)</td>
      <td>92% (post-digitization)</td>
    </tr>
  </tbody>
</table>

<h2>Key Success Factors for Pakistani Context</h2>
<p>Technology alone isn't enough. Successful deployments share these traits:</p>

<ol>
  <li><strong>Change Management</strong>: Training 200+ staff members across shifts, with role-based simulations and super-user champions.</li>
  <li><strong>Phased Rollout</strong>: Start with registration + billing (quick wins), then expand to clinical modules.</li>
  <li><strong>Local Customization</strong>: Support for Urdu interfaces, CNIC integration, and provincial health department reporting formats.</li>
  <li><strong>Reliable Infrastructure</strong>: Offline-first architecture for areas with intermittent connectivity, with auto-sync when online.</li>
  <li><strong>Continuous Support</strong>: 24/7 AMC with &lt;2-hour response SLA for critical issues.</li>
</ol>

<h2>Looking Ahead: AI, Telemedicine, and Beyond</h2>
<p>The next wave of healthcare innovation in Pakistan will leverage:</p>
<ul>
  <li><strong>Predictive Analytics</strong>: Flagging high-risk patients for early intervention using historical data.</li>
  <li><strong>Tele-ICU</strong>: Remote specialist monitoring for rural hospitals via integrated video + vitals streaming.</li>
  <li><strong>Patient Portals</strong>: Mobile apps for appointment booking, report access, and medication reminders.</li>
  <li><strong>Interoperability</strong>: FHIR-based APIs to connect public and private systems for population health insights.</li>
</ul>

<p class="conclusion">Digital transformation isn't a destination—it's a continuous journey of learning, adapting, and improving. For Pakistani hospitals ready to take the next step, the question isn't <em>if</em> to digitize, but <em>how</em> to do it sustainably, securely, and at scale.</p>

<div class="cta-box">
  <h3>Ready to explore your hospital's digital roadmap?</h3>
  <p>Our implementation specialists offer free, no-obligation assessments to identify quick wins and long-term strategy.</p>
  <a href="/contact" class="btn-primary">Schedule a Consultation →</a>
</div>
HTML,
      'featured_image' => 'blog/digital-transformation-pakistan.jpg',
      'featured_image_alt' => 'Modern hospital control room with digital dashboards in Pakistan',
      'category' => 'Insights',
      'tags' => ['Digital Transformation', 'HIS', 'Pakistan Healthcare', 'Hospital Management', 'Case Study'],
      'author_id' => $author->id,
      'status' => BlogPost::STATUS_PUBLISHED,
      'published_at' => Carbon::parse('2024-03-15 09:00:00'),
      'meta_title' => 'Digital Transformation in Pakistani Hospitals | REDSOL Insights',
      'meta_description' => 'Discover how integrated Health Information Systems are improving patient care, reducing costs, and scaling operations for hospitals across Pakistan.',
      'read_time_minutes' => 8,
      'view_count' => 0,
    ]);

    $samplePosts = [
      [
        'title' => '5 Signs Your Hospital Needs a Modern HIS',
        'excerpt' => 'Is your current system holding you back? Learn the key indicators that it\'s time to upgrade your healthcare infrastructure.',
        'category' => 'Guides',
        'tags' => ['HIS', 'Hospital Management', 'Digital Health'],
        'published_at' => Carbon::parse('2024-02-28 10:00:00'),
      ],
      [
        'title' => 'ICD-10 Coding Made Simple: A Pakistani Hospital\'s Guide',
        'excerpt' => 'Navigate international coding standards without the complexity. Practical tips for accurate, compliant documentation.',
        'category' => 'Compliance',
        'tags' => ['ICD-10', 'Medical Coding', 'Healthcare Compliance'],
        'published_at' => Carbon::parse('2024-02-10 11:30:00'),
      ],
      [
        'title' => 'Why AMC Support is Your Hospital\'s Safety Net',
        'excerpt' => 'Beyond implementation: how proactive maintenance contracts prevent downtime and protect your digital investment.',
        'category' => 'Support',
        'tags' => ['AMC', 'Maintenance', 'Healthcare IT'],
        'published_at' => Carbon::parse('2024-01-22 14:00:00'),
      ],
    ];

    foreach ($samplePosts as $index => $data) {
      $slug = Str::slug($data['title']);
      $counter = 1;
      $originalSlug = $slug;
      while (BlogPost::where('slug', $slug)->exists()) {
        $slug = $originalSlug . '-' . $counter++;
      }

      BlogPost::create([
        'title' => $data['title'],
        'slug' => $slug,
        'excerpt' => $data['excerpt'],
        'body' => "<p>{$data['excerpt']}</p>\n\n<p><em>Full article content would go here. This is a placeholder for seeding purposes.</em></p>",
        'featured_image' => $index % 2 === 0 ? 'blog/placeholder-1.jpg' : 'blog/placeholder-2.jpg',
        'featured_image_alt' => $data['title'],
        'category' => $data['category'],
        'tags' => $data['tags'],
        'author_id' => $author->id,
        'status' => BlogPost::STATUS_PUBLISHED,
        'published_at' => $data['published_at'],
        'meta_title' => $data['title'] . ' | REDSOL Blog',
        'meta_description' => Str::limit($data['excerpt'], 155),
        'read_time_minutes' => 5,
        'view_count' => rand(50, 500),
      ]);
    }

    $this->command->info('✓ Seeded ' . (1 + count($samplePosts)) . ' BlogPost entries');
  }
}