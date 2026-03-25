<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(CalenderTableSeeder::class);
        $this->call(CustomerotpTableSeeder::class);
        $this->call(CustomersTableSeeder::class);
        $this->call(FailedJobsTableSeeder::class);
        $this->call(JmBlrRsVibhagTableSeeder::class);
        $this->call(OpportunityTableSeeder::class);
        $this->call(OrderTableSeeder::class);
        $this->call(PasswordResetsTableSeeder::class);
        $this->call(PersonalAccessTokensTableSeeder::class);
        $this->call(PwaAboutTableSeeder::class);
        $this->call(PwaActivitiesTableSeeder::class);
        $this->call(PwaAdminTableSeeder::class);
        $this->call(PwaAdminLogsTableSeeder::class);
        $this->call(PwaAppversionsTableSeeder::class);
        $this->call(PwaBannerTableSeeder::class);
        $this->call(PwaCategoryTableSeeder::class);
        $this->call(PwaChapterTableSeeder::class);
        $this->call(PwaContentTableSeeder::class);
        $this->call(PwaCountryTableSeeder::class);
        $this->call(PwaDepartmentTableSeeder::class);
        $this->call(PwaDepartmentMemTableSeeder::class);
        $this->call(PwaDesignationTableSeeder::class);
        $this->call(PwaDocumentTableSeeder::class);
        $this->call(PwaEventsTableSeeder::class);
        $this->call(PwaGalleryTableSeeder::class);
        $this->call(PwaMediaTableSeeder::class);
        $this->call(PwaMeetingsTableSeeder::class);
        $this->call(PwaMeetingsAttendanceTableSeeder::class);
        $this->call(PwaMeetingsMomTableSeeder::class);
        $this->call(PwaModulesTableSeeder::class);
        $this->call(PwaNatureTableSeeder::class);
        $this->call(PwaNewsTableSeeder::class);
        $this->call(PwaOpportunityconnectTableSeeder::class);
        $this->call(PwaOpportunitytypeTableSeeder::class);
        $this->call(PwaPermissionsTableSeeder::class);
        $this->call(PwaReferalstatusTableSeeder::class);
        $this->call(PwaReferencetypeTableSeeder::class);
        $this->call(PwaRolesTableSeeder::class);
        $this->call(PwaSchemeTableSeeder::class);
        $this->call(PwaServicesTableSeeder::class);
        $this->call(PwaStateTableSeeder::class);
        $this->call(PwaSubcategoryTableSeeder::class);
        $this->call(PwaSubmodulesTableSeeder::class);
        $this->call(PwaSupportTableSeeder::class);
        $this->call(PwaTermsTableSeeder::class);
        $this->call(PwaUserCapabilitiesTableSeeder::class);
        $this->call(PwaUserRolesTableSeeder::class);
        $this->call(PwaVersionsTableSeeder::class);
        $this->call(RegistrationsTableSeeder::class);
        $this->call(UsersTableSeeder::class);
    }
}
