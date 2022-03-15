<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\CreateEmailTemplateRequest;
use App\Http\Requests\UpdateEmailTemplateRequest;
use App\Models\EmailTemplate;
use App\Models\Region;
use Illuminate\Support\Facades\Auth;
use App\Libraries\EmailSender;
use Flash;
use Response;

class EmailTemplateController extends AppBaseController
{

    function __construct()
    {

    }

    /**
     * Display a listing of the emailtemplate.
     *
     * @return Response
     */
    public function index()
    {
        $user = Auth::user();
        $emailTemplates = $user->hasRole('Administrator') ? EmailTemplate::all() : EmailTemplate::where('region_id', $user->region_id)->get();

        return view('emailtemplates.index')
            ->with('emailTemplates', $emailTemplates);
    }

    /**
     * Show the form for creating a new emailtemplate.
     *
     * @return Response
     */
    public function create()
    {
        //$user = Auth::user();
        //$emailTemplates = $user->hasRole('Administrator') ? emailtemplate::all() : $user->emailtemplates;
        return view('emailtemplates.create');
    }

    /**
     * Store a newly created emailtemplate in storage.
     *
     * @param CreateemailtemplateRequest $request
     *
     * @return Response
     */
    public function store(CreateemailtemplateRequest $request)
    {
        $input = $request->all();

        $input['region_id'] = Auth::user()->region_id;

        $emailTemplate = EmailTemplate::create($input);

        Flash::success('emailtemplate saved successfully.');

        return redirect(route('app.emailtemplates.index'));
    }

    /**
     * Display the specified emailtemplate.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $emailTemplate = EmailTemplate::find($id);

        if(empty($emailTemplate))
        {
            Flash::error('Emailtemplate not found');

            return redirect(route('app.emailtemplates.index'));
        }

        return view('emailtemplates.show')->with('emailTemplate', $emailTemplate);
    }

    /**
     * Show the form for editing the specified emailtemplate.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $emailTemplate = EmailTemplate::find($id);

        $emailPreview = $this->__getEmailPreview($emailTemplate);

        if(empty($emailTemplate))
        {
            Flash::error('emailtemplate not found');

            return redirect(route('app.emailtemplates.index'));
        }

        return view('emailtemplates.edit')
            ->with('emailTemplate', $emailTemplate)
            ->with('preview', $emailPreview);
    }

    /**
     * Update the specified emailtemplate in storage.
     *
     * @param  int              $id
     * @param UpdateemailtemplateRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateemailtemplateRequest $request)
    {
        $emailTemplate = EmailTemplate::find($id);

        if(empty($emailTemplate))
        {
            Flash::error('emailtemplate not found');

            return redirect(route('app.emailtemplates.index'));
        }

        $emailTemplate->fill($request->all());
        $emailTemplate->save();

        Flash::success('emailtemplate updated successfully.');

        return redirect(route('app.emailtemplates.index'));
    }

    /**
     * Remove the specified emailtemplate from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $emailTemplate = EmailTemplate::find($id);

        if(empty($emailTemplate))
        {
            Flash::error('emailtemplate not found');

            return redirect(route('app.emailtemplates.index'));
        }

        $emailTemplate->destroy($id);

        Flash::success('emailtemplate deleted successfully.');

        return redirect(route('app.emailtemplates.index'));
    }

    private function __getEmailPreview($emailTemplate = null){

        if ($emailTemplate->region_id != 0){
            $user = \App\Models\User::where('region_id', $emailTemplate->region_id)->first();
        }
        else {
            $user = Auth::user();
            $user->region_id = \App\Models\Region::where('name', '!=', 'Stockholm')->first()->id;
        }

        $dinner = \App\Models\Dinner::first();
        // Fake date
        $dinner->date = date('Y') . substr($dinner->date, 5);

        $data_for_preview = [
            'user' => $user,
            'counterpart' => $user->fullname,
            'feedback_url' => config('app.url'),
            'followup_url' => config('app.url'),
            'guest'=> $user,
            'dinner' => $dinner,
        ];

        return EmailSender::sendEmailFromTemplate($emailTemplate->email_type, $data_for_preview, true);
    }
}
