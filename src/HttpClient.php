<?php

namespace LeandroNunes\Evolution;

use LeandroNunes\Evolution\Exceptions\HttpException;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\HandlerStack;

class HttpClient
{
    private Client $client;

    public function __construct(
        private Config $config,
        ?HandlerStack $handler = null
    ) {
        $options = [
            'base_uri' => $config->getBaseUrl(),
            'timeout' => $config->getTimeout(),
            'headers' => $this->buildBaseHeaders(),
        ];

        if ($handler) {
            $options['handler'] = $handler;
        }

        $this->client = new Client($options);
    }

    private function buildBaseHeaders(): array
    {
        return array_merge([
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'User-Agent' => 'Evolution-PHP-SDK/1.0',
        ], $this->config->getCustomHeaders());
    }

    /**
     * @param string $method
     * @param string $endpoint
     * @param array $options Guzzle options + custom 'auth_type'
     * @return array
     * @throws HttpException
     * @throws GuzzleException
     */
    public function request(string $method, string $endpoint, array $options = []): array
    {
        // Handle Authentication Logic
        $authType = $options['auth_type'] ?? 'global'; // 'global', 'instance_override', 'basic'
        unset($options['auth_type']); // Remove from Guzzle options

        $options = $this->injectAuth($options, $authType);

        try {
            $response = $this->client->request($method, $endpoint, $options);
            $contents = $response->getBody()->getContents();

            return json_decode($contents, true) ?: [];
        } catch (RequestException $e) {
            $this->handleException($e, $endpoint);
        }
    }

    private function injectAuth(array $options, string $authType): array
    {
        // Headers initialization
        $headers = $options['headers'] ?? [];

        switch ($authType) {
            case 'basic':
                // Metrics uses Basic Auth
                if ($this->config->getMetricsToken()) {
                    $options['auth'] = [$this->config->getMetricsUser(), $this->config->getMetricsToken()];
                }
                break;

            case 'instance_override':
                // Fetch Instances uses specific apiKey if available, otherwise Global
                $apiKey = $this->config->getInstanceApiKey() ?? $this->config->getGlobalApiKey();
                $headers['apikey'] = $apiKey;
                break;

            case 'global':
            default:
                // Default: Global API Key
                $headers['apikey'] = $this->config->getGlobalApiKey();
                break;
        }

        $options['headers'] = $headers;
        return $options;
    }

    /**
     * @throws HttpException
     */
    private function handleException(RequestException $e, string $endpoint): never
    {
        $response = $e->getResponse();
        $statusCode = $response ? $response->getStatusCode() : 0;
        $body = $response ? json_decode($response->getBody()->getContents(), true) : null;
        $requestId = $response ? $response->getHeaderLine('X-Request-ID') : null;

        throw new HttpException(
            $e->getMessage(),
            $statusCode,
            $body,
            $requestId,
            $endpoint
        );
    }
}
