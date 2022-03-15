<?php namespace App\Libraries;

use App\Libraries\Repositories\EmailRepository;
use Illuminate\Support\Facades\Mail;
use App\Models\EmailTemplate;

class EmailSender {

    protected static function _registerInDB($data)
    {
        $repository = app()->make(EmailRepository::class);
        $email = $repository->create($data);
        return $email->token;
    }

    protected static function _handleEmailSent($data) {
        // Match found
        if ($data['email_type'] == 3) {
            $data['match']->setEmailSent();
            $data['match']->dinner->setHostInformed();
            return;
        }

        // Feedback sent to host
        if ($data['email_type'] == 7) {
            $data['match']->dinner->setFeedbackEmailSent('host');
        }
    }

    /*
     * Function to send email based on content sent in
     */
    public static function sendEmailFromContent($data){

        $user = $data['user'];
        $title = $data['title'];
        $content = $data['content'];

        $token = self::_registerInDB($data);

        Mail::send('emails.template_raw', ['content' => $content], function ($m) use ($user, $title, $token) {
            $m->from($user->region->email, 'Invitationsdepartementet');
            $m->to($user->email, $user->getFullName())->subject($title);
            $m->getSwiftMessage()->getHeaders()->addTextHeader('X-Mailgun-Variables', json_encode(['token' => $token]));
        });

        self::_handleEmailSent($data);
        return true;
    }

    public static function sendAdminEmailFromUser($data){

        $recipient['email'] = $data['recipient_email'];
        $recipient['name'] = isset($data['recipient_name']) ? $data['recipient_name'] : 'Invitationsdepartementet';

        $sender['email'] = $data['sender']->email;
        $sender['name'] = $data['sender']->getFullName();

        $title = $data['title'];
        $content = $data['content'];

        Mail::send('emails.template_raw', ['content' => $content], function ($m) use ($recipient, $title) {
            $m->to($recipient['email'], $recipient['name'])->subject($title);
        });
    }

    /*
     * Function to send email based on saved email templates
     */
    public static function sendEmailFromTemplate($email_type, $data, $preview = false){

        // Get email content
        $emailContent = EmailSender::__getPopulatedTemplate($email_type, $data);

        // Extract email contents
        $emailParagraphs = [];
        $signature = '';
        $skip_nl2br = false;
        if(!empty($emailContent->paragraph1))
            array_push($emailParagraphs, $emailContent->paragraph1);
        if (!empty($emailContent->paragraph2))
            array_push($emailParagraphs, $emailContent->paragraph2);
        if (!empty($emailContent->paragraph3))
            array_push($emailParagraphs, $emailContent->paragraph3);
        if (!empty($emailContent->signature))
            $signature = $emailContent->signature;
        if (!empty($emailContent->skip_nl2br))
            $skip_nl2br = true;
        $user = $data['user'];

        // Set recipient and sender
        $sender = isset($data['sender']) ? $data['sender'] : null;
        $params = ['user' => $user, 'emailParagraphs' => $emailParagraphs, 'skip_nl2br' => $skip_nl2br, 'signature' => $signature, 'sender' => $sender];

        $data['email_type'] = $email_type;
        $token = self::_registerInDB($data);

        // Send email or return it for preview
        if ($preview == false){
            Mail::send('emails.template', $params, function ($m) use ($user, $emailContent, $token) {
                $m->from($user->region->email, 'Invitationsdepartementet');
                $m->to($user->email, $user->getFullName())->subject($emailContent->title);
                $m->getSwiftMessage()->getHeaders()->addTextHeader('X-Mailgun-Variables', json_encode(['token' => $token]));
            });
            return true;
        }
        else {
            $returnData['view'] = view('emails.template', $params);
            $returnData['title'] = $emailContent->title;
            $returnDate['skip_nl2br'] = $skip_nl2br;
            return $returnData;
        }
    }

    private static function __getPopulatedTemplate($email_type, $data)
    {

        $template = EmailSender::__getRawTemplate($email_type, $data);

        switch ($email_type) {
            case 1: // Welcome email host
            case 2: // .. or guest
                break;

            case 3: // Match email
                // For match mail, paragraph 1 is completely built programmatically in the following view
                $template->paragraph1 = view('emails.matchdescription')
                    ->with('guest', $data['guest'])
                    ->with('dinner', $data['dinner'])
                    ->with('user', $data['user'])->render();
                // The second paragraph needs the guest's name
                $template->paragraph2 = sprintf($template->paragraph2, $data['guest']->first_name);
                $template->skip_nl2br = true;
                break;

            case 4: // Dateselection later
                // for this dynamic data we simply need to insert the individual url
                $template->paragraph2 = sprintf($template->paragraph2, url('dateselection', $data['user']->uuid));
                break;
            case 5: // Welcome email if region has date constraint active
                break;
            case 6: // Welcome email to host if dateselection has been used, we need to insert the date
                if ($data['user']->region->user_dateselection && $data['user']->wants_to_host) {
                    $template->paragraph2 = sprintf($template->paragraph2, $data['dinner']->getPrettyDate());
                }
                break;
            case 7: // Feedback email after dinner
                $template->paragraph1 = sprintf($template->paragraph1, $data['counterpart']);
                $template->paragraph2 = sprintf($template->paragraph2, $data['feedback_url']);
                break;
            case 8: // ... and followup email after dinner
                $template->paragraph1 = sprintf($template->paragraph1, $data['counterpart']);
                $template->paragraph2 = sprintf($template->paragraph2, $data['followup_url']);
                break;
            default:
                break;
        }

        return $template;
    }

    private static function __getRawTemplate($email_type, $data)
    {
        // Find template for region and type
        $template = EmailTemplate::where('region_id', $data['user']->region_id)->where('email_type', $email_type)->first();

        // If no specific template is used, grab the default one (with region_id = 0)
        if (empty($template)) {
            $template = EmailTemplate::where('region_id', 0)->where('email_type', $email_type)->first();
        }

        // If no defaults are set in DB, use from config
        if (empty($template)) {
            $template = new EmailTemplate(config('constants.emailTemplateDefaults')[$email_type]);
            $template->email_type = $email_type;
            $template->region_id = 0;
            $template->save();
        }
        return $template;
    }

}