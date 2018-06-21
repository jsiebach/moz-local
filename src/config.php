<?php

return [
	/**
	 * Your application's Moz Local access token
	 */
	'access_token' => env('MOZ_LOCAL_ACCESS_TOKEN'),

	/**
	 * The base URL for the Moz API endpoints
	 * Production: https://moz.com/local/api
	 * Sandbox: https://sandbox.moz.com/local/api
	 */
	'api_base_url' => env('MOZ_LOCAL_API_BASE_URL', 'https://moz.com/local/api')
];