<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Models\User;
use App\Models\Dinner;

class IntegrationTest extends TestCase
{
    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testRoutes()
    {
        $this->testGuestRoutes();
        $this->testLoggedInRoutes();
    }

    public function testGuestRoutes(){
        $this->visit('/')
            ->click('Admin')
            ->see('Logga in');

        $this->visit('/signup/Stockholm')
            ->see('Jag godkänner att');
    }

    public function testLoggedInRoutes(){

        $this->actingAs(User::where('email', 'ludvig.linse@gmail.com')->first());

        $this->visit('app')->see('Dashboard');
        $this->visit('app/dinners')->see('Middagar');
        $this->visit('app/dinners')->see('Middagar');
        $this->visit('app/dinners/unmatched')->click('Hitta matcher')->see('Middag hos');
        $this->visit('app/dinners/matched')->click('Visa middag')->see('Middag hos');
        $this->visit('app/dinners/create')->click('Ny deltagare')->see('Skapa ny användare');

        $user = User::first();
        $this->visit('app/dinners/create')->select($user->getFullName(), 'user_select')->see('Skapa middag');
        $this->visit('app/users/users')->see('Sök');
        $this->visit('app/schools')->see('Skolor');
        $this->visit('app')->click('Preferenser')->see('Preferens för gäst')->click('Lägg till ny')->see('Lägg till matpreferens');
        $this->visit('app')->click('Referrers')->see('SFI-klass')->click('Add New')->see('Skapa referrer');
        $this->visit('app')->click('Regioner')->see('Ansvarig ambassadör')->click('Add New')->see('Minsta framförhållning');
        $this->visit('app')->click('Emailmallar')->see('Typ av email')->click('Skapa ny')->see('Ny emailtemplate');
        $this->visit('app')->click('Inaktiva perioder')->see('Meddelande innan signup')->click('Skapa ny')->see('Ny inaktiv period');


        /*
         * Desired test-cases
         */
         // 1. User signup with no date selection
         // 2. User signup with date selection
         // 3. Create user X in app
        $this->visit('app/users/create')
            ->see('Skapa ny användare')
            ->type('Test', 'first_name')
            ->type('User', 'last_name')
            ->select('1', 'fluent') // fluent
            ->select('M', 'gender') // male
            ->select('6', 'age') // 60+
            ->select('Norge', 'nationality')
            ->select('10', 'role_list[]')
            ->type('Testland', 'address_city')
            ->type('I am a test user created automatically by test-suite', 'other_info')
            ->type('test@user.se', 'email')
            ->type('0701234567', 'phone')
            ->check('wants_to_host')
            ->check('wants_to_guest')
            ->see('Djur som finns i mitt hem')
            ->see('De dagar som passar mig är')
            /*->press('add_more_partners');/*
            ->select('M', 'partner_gender[0]')
            ->press('add_more_children')
            ->type('3', 'children_age[0]');*/

        ;
         // 4. Add settings for user X (children, partners, preferences...)
         // 5. Remove settings for user X (children, partners, preferences...)
         // 4. Create dinner Y in app for user X
         // 5. Find matches automatically for Y
        $dinner = Dinner::where('status_id', 2)->first();
        //$this->visit('app/dinners/' . $dinner->id)->see('Middag hos')->click('Hitta matchförslag')->see('Föreslagen');
         // 6. Approve match for Y
         // 7. Send host-email to user X
         // 8. Delete user X





        /*        $this->visit('app/dinners/calendar')->see('Matchad utan bekräftelsemail');*/
    }
}
