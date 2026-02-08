<?php

namespace LeandroNunes\Evolution\Resources;

class Instance extends BaseResource
{
    public function create(string $instanceName, string $token = null, string $number = null, array $options = []): array
    {
        $body = array_merge([
            'instanceName' => $instanceName,
            'token' => $token,
            'number' => $number,
        ], $options);

        // 'auth_type' default is global, which is correct here
        return $this->httpClient->request('POST', 'instance/create', ['json' => $body]);
    }

    public function fetchInstances(string $instanceName = null): array
    {
        $query = [];
        if ($instanceName) {
            $query['instanceName'] = $instanceName;
        }

        // Uses Override Auth
        return $this->httpClient->request('GET', 'instance/fetchInstances', [
            'query' => $query,
            'auth_type' => 'instance_override',
        ]);
    }

    public function connect(string $instance, string $number = null): array
    {
        $query = [];
        if ($number) {
            $query['number'] = $number;
        }

        return $this->httpClient->request('GET', "instance/connect/{$instance}", ['query' => $query]);
    }

    public function restart(string $instance): array
    {
        return $this->httpClient->request('POST', "instance/restart/{$instance}");
    }

    public function logout(string $instance): array
    {
        return $this->httpClient->request('DELETE', "instance/logout/{$instance}");
    }

    public function delete(string $instance): array
    {
        return $this->httpClient->request('DELETE', "instance/delete/{$instance}");
    }

    public function connectionState(string $instance): array
    {
        return $this->httpClient->request('GET', "instance/connectionState/{$instance}");
    }
}
