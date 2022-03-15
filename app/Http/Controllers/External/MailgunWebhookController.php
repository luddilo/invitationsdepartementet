<?php
namespace App\Http\Controllers\External;

use App\Http\Controllers\Controller;
use App\Models\Email;
use Illuminate\Http\Request;
use Carbon\Carbon;

class MailgunWebhookController extends Controller
{
    private $email = null;

    private function _signatureIsValid(Request $request)
    {
        $apiKey    = config('services.mailgun.secret');
        $timestamp = $request->get('timestamp');
        $token     = $request->get('token');
        $signature = $request->get('signature');

        //check if the timestamp is fresh
        if (abs(time() - $request->get('timestamp')) > 15) {
            return false;
        }

        //returns true if signature is valid
        return hash_hmac('sha256', $timestamp.$token, $apiKey) === $signature;
    }

    private function var_dump_ret($mixed = null) {
      ob_start();
      var_dump($mixed);
      $content = ob_get_contents();
      ob_end_clean();
      return $content;
    }

    private function _getToken(Request $request)
    {
        $raw = $request->get('message-headers');
        $decoded = json_decode($raw);

        if (!is_array($decoded))
            return null;

        foreach ($decoded as $arr) {
            if ($arr[0] != 'X-Mailgun-Variables')
                continue;

            $headersObj = json_decode($arr[1]);

            if (isset($headersObj->token))
                return $headersObj->token;
        }

        return null;
    }

    private function _getMessageId(Request $request)
    {
        $id = '';

        if ($request->has('Message-Id')) {
            $id = $request->get('Message-Id');
        } else if ($request->has('message-id')) {
            $id = $request->get('message-id');
        }

        $trimmed = trim($id, '<>');
        return '<' . $trimmed . '>';
    }

    private function _getDate($timestamp)
    {
        $timezone        = config('app.timezone');
        $carbon_instance = Carbon::createFromTimestampUTC($timestamp)->setTimezone($timezone);

        return $carbon_instance->toDateTimeString();
    }

    private function _handleBasedOnEvent(Request $request)
    {
        $update = [];
        $date   = $this->_getDate($request->get('timestamp'));
        $event  = $request->get('event');

        switch ($event) {
            case 'delivered':
                $update['mailgun_id'] = $request->get('Message-Id');
                $update['delivered_at'] = $date;
                break;
            case 'opened':
                $update['opened_at'] = $date;
                break;
            case 'dropped':
                $update['delivery_failed_at'] = $date;
                $update['delivery_failed_reason'] = $request->get('reason');
                break;
        }

        $this->email->update($update);
    }

    private function _emptyResponse()
    {
        return response()->make();
    }

    public function handle(Request $request)
    {
        if (!$this->_signatureIsValid($request))
            return $this->_emptyResponse();

        $token = $this->_getToken($request);

        // Try to find email either by token or message-id
        if ($token != null) {
            $this->email = Email::where('token', $token)->first();
        } else {
            $mailgun_id  = $this->_getMessageId($request);
            $this->email = Email::where('mailgun_id', $mailgun_id)->first();
        }

        if ($this->email == null)
            return $this->_emptyResponse();

        $this->_handleBasedOnEvent($request);
        
        return $this->_emptyResponse();
    }
}
