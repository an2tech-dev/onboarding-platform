<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\RoleInformation;
use Illuminate\Database\Seeder;

class RoleInformationSeeder extends Seeder
{
    public function run(): void
    {
        Company::all()->each(function ($company) {
            $standardRoles = [
                [
                    'title' => 'Software Engineer',
                    'description' => 'Technical role focused on software development',
                    'expectations' => "- Strong programming skills in multiple languages\n- Experience with modern frameworks\n- Ability to work in an agile environment\n- Good problem-solving skills",
                    'overview' => "As a Software Engineer at our company, you'll be responsible for designing, developing, and maintaining software applications. You'll work closely with cross-functional teams to deliver high-quality solutions that meet business requirements."
                ],
                [
                    'title' => 'Product Manager',
                    'description' => 'Strategic role leading product development',
                    'expectations' => "- Experience in product management\n- Strong analytical skills\n- Excellent communication abilities\n- Strategic thinking",
                    'overview' => "The Product Manager role involves leading the product development lifecycle from conception to launch. You'll work with stakeholders to define product strategy and collaborate with development teams to ensure successful delivery."
                ],
                [
                    'title' => 'Technical Lead',
                    'description' => 'Senior technical leadership role',
                    'expectations' => "- Extensive development experience\n- Team leadership skills\n- Architecture design expertise\n- Technical mentoring ability",
                    'overview' => "As a Technical Lead, you will guide the technical direction of projects, mentor team members, and ensure the delivery of high-quality software solutions."
                ],
                [
                    'title' => 'UX Designer',
                    'description' => 'User experience and interface design',
                    'expectations' => "- UI/UX design expertise\n- User research experience\n- Prototyping skills\n- Design system knowledge",
                    'overview' => "The UX Designer role focuses on creating intuitive and engaging user experiences through research, design, and collaboration with development teams."
                ],
                [
                    'title' => 'Project Manager',
                    'description' => 'Project planning and execution',
                    'expectations' => "- Project management certification\n- Risk management skills\n- Team coordination experience\n- Budget management",
                    'overview' => "As a Project Manager, you'll be responsible for planning, executing, and delivering projects on time and within budget while managing stakeholder expectations."
                ],
                [
                    'title' => 'DevOps Engineer',
                    'description' => 'Infrastructure and deployment automation',
                    'expectations' => "- Cloud infrastructure experience\n- CI/CD pipeline expertise\n- Security best practices\n- Monitoring and logging systems",
                    'overview' => "As a DevOps Engineer, you'll be responsible for maintaining and improving our infrastructure, deployment processes, and development workflows."
                ],
                [
                    'title' => 'QA Engineer',
                    'description' => 'Quality assurance and testing',
                    'expectations' => "- Test automation experience\n- Manual testing expertise\n- Bug tracking and reporting\n- Test planning and documentation",
                    'overview' => "The QA Engineer ensures the quality of our software through comprehensive testing strategies and automation."
                ]
            ];

            foreach ($standardRoles as $role) {
                RoleInformation::create([
                    'company_id' => $company->id,
                    ...$role
                ]);
            }
        });
    }
}
