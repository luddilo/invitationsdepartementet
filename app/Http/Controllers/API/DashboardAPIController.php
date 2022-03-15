<?php namespace App\Http\Controllers\API;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use App\Libraries\Repositories\DashboardRepository;
use App\Http\Requests\GetDataRequest;
use SimpleXMLElement;
use Illuminate\Http\Response;
use App\Http\Controllers\AppBaseController as AppBaseController;

class DashboardAPIController extends AppBaseController
{
	/** @var  DashboardRepository */
	private $dashboardRepository;

	function __construct(DashboardRepository $dashboardRepo)
	{
		$this->dashboardRepository = $dashboardRepo;
	}

	public function getData(GetDataRequest $request)
	{
		$input = $request->all();
		if (isset($input['format']) && $input['format'] == 'xml'){
			$format = 'xml';
		}
		else {
			$format = 'json';
		}

		$user = Auth::user();
		$data = $this->dashboardRepository->getData($user);

		if ($format == 'json')
			return response($data);
		else
			return $this->_xmlResponse($data);
	}

	private function _xmlResponse ($vars, $status = 200, array $header = array(), $rootElement = 'response', $xml = null)
	{

		if (is_object($vars) && $vars instanceof \Illuminate\Contracts\Support\Arrayable) {
			$vars = $vars->toArray();
		}

		if (is_null($xml)) {
			$xml = new SimpleXMLElement('<' . $rootElement . '/>');
		}
		foreach ($vars as $key => $value) {
			if (is_array($value)) {
				if (is_numeric($key)) {
					$this->_xmlResponse($value, $status, $header, $rootElement, $xml->addChild(str_singular($xml->getName())));
				} else {
					$this->_xmlResponse($value, $status, $header, $rootElement, $xml->addChild($key));
				}
			} else {
				if (is_numeric($key)) {
					$xml->addChild(str_singular($xml->getName()), $value);
				}
				else {
					$xml->addChild($key, $value);
				}

			}
		}
		if (empty($header)) {
			$header['Content-Type'] = 'application/xml';
		}
		return Response::create($xml->asXML(), $status, $header);
	}

}