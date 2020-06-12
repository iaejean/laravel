<?php

declare(strict_types=1);

namespace App\Services;

use App\Contracts\PostServiceInterface;
use App\Exceptions\PostServiceException;
use GuzzleHttp\ClientInterface;
use Illuminate\Support\Facades\Log;
use Psr\Http\Message\ResponseInterface;

/**
 * Class PostService
 * @package App\Services
 */
final class PostService implements PostServiceInterface
{
    /**
     * @var ClientInterface
     */
    private ClientInterface $client;

    /**
     * @var string
     */
    private string $url;

    /**
     * PostService constructor.
     * @param ClientInterface $client
     * @param string $url
     */
    public function __construct(ClientInterface $client, string $url)
    {
        $this->client = $client;
        $this->url = $url;
    }

    /**
     * @inheritDoc
     */
    public function sendRequest(): bool
    {
        Log::info('Sending request: '.$this->url);

        try {
            /** @var ResponseInterface $response */
            $response = $this->client->post($this->url);
            Log::info((string)$response->getBody());
        } catch (\Exception $exception) {
            Log::warning($exception->getMessage());
            throw PostServiceException::fail($exception->getMessage());
        } finally {
            return true;
        }
    }
}
