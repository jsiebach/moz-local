<?php
/**
 * Created by PhpStorm.
 * User: lsm
 * Date: 6/20/18
 * Time: 10:30 AM
 */

namespace JSiebach\MozLocal;


use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\GuzzleException;

class MozLocal {
	/**
	 * @var string
	 */
	private $access_token;
	private $api_version;
	private $api_base_url;

	/**
	 * MozLocal constructor.
	 *
	 * @param string $access_token
	 */
	public function __construct($access_token) {
		$this->access_token = $access_token;
		$this->api_version = 'v1';
		$this->api_base_url = config('mozlocal.api_base_url');
	}

	public function getApiBaseUrl(  ) {
		return $this->api_base_url . "/" . $this->api_version;
	}

	public function call(string $endpoint, array $params = [], string $method = 'GET'){
		$params['access_token'] = $this->access_token;
		$client = new Client();
		return json_decode($client->request($method, $this->getApiBaseUrl() . $endpoint . '?' . http_build_query($params))->getBody()->getContents());
//		try {
//
//		}
//		catch (ClientException $exception) {
//			$responseBody = $exception->getResponse()->getBody(true);
//			return $responseBody;
//		} catch (GuzzleException $exception) {
//			$responseBody = $exception->getResponse()->getBody(true);
//			return $responseBody;
//		}
	}

	public function buildQuery(array $filters = []) {
		$queryFilters = [];
		foreach($filters as $key => $value){
			$queryFilters[] = "$key:$value";
		}
		return join("%20", $queryFilters);
	}

	public function getListings(array $params = [], string $type = 'managed', string $filter = 'verified'){
		return $this->call("/listings/$type/$filter", $params);
	}

	public function getExtendedListings(array $params = [], string $type = 'managed', string $filter = 'verified'){
		return $this->getListings(array_merge($params, ['summary' => 'extended']), $type,  $filter);
	}

	public function getScoreReport(array $params = [], string $type = 'managed', string $filter = 'verified'){
		return $this->call("/listings/$type/$filter/reports/scores", $params);
	}

	public function getReachReport(array $params = [], string $type = 'managed', string $filter = 'verified'){
		return $this->call("/listings/$type/$filter/reports/reach", $params);
	}

	public function getAccuracyReport(array $params = [], string $type = 'managed', string $filter = 'verified'){
		return $this->call("/listings/$type/$filter/reports/accuracy", $params);
	}

	public function getReviews(string $status = 'all', string $source = 'all', int $page = 1){
		return $this->call("/reviews", [
			'source' => $source,
			'status' => $status,
			'page' => $page
		]);
	}

	public function queryReviews(array $filters, string $status = 'all', string $source = 'all', int $page = 1){
		return $this->call("/reviews/search/" . $this->buildQuery($filters), [
			'source' => $source,
			'status' => $status,
			'page' => $page
		]);
	}
}