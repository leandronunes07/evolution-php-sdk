<?php

namespace LeandroNunes\Evolution;

class Config
{
    public function __construct(
        public string $baseUrl,
        public string $globalApiKey, // Main Auth
        public ?string $instanceApiKey = null, // Override for specific instance operations (fetchInstances)
        public ?string $metricsUser = 'METRICS_USER',
        public ?string $metricsToken = null, // Password for metrics
        public int $timeout = 30,
        public array $customHeaders = []
    ) {
        $this->baseUrl = rtrim($baseUrl, '/');
    }

    public function getBaseUrl(): string
    {
        return $this->baseUrl;
    }

    public function getGlobalApiKey(): string
    {
        return $this->globalApiKey;
    }

    public function getInstanceApiKey(): ?string
    {
        return $this->instanceApiKey;
    }

    public function getMetricsUser(): string
    {
        return $this->metricsUser ?? 'METRICS_USER';
    }

    public function getMetricsToken(): ?string
    {
        return $this->metricsToken;
    }

    public function getTimeout(): int
    {
        return $this->timeout;
    }

    public function getCustomHeaders(): array
    {
        return $this->customHeaders;
    }
}
