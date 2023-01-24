<?php

namespace BlueLibraries\Dns\Handlers\Types;

use BlueLibraries\Dns\Handlers\AbstractDnsHandler;
use BlueLibraries\Dns\Handlers\DnsHandlerException;
use BlueLibraries\Dns\Handlers\DnsHandlerTypes;
use BlueLibraries\Dns\Handlers\Raw\RawDataException;
use BlueLibraries\Dns\Handlers\Raw\RawDataRequest;
use BlueLibraries\Dns\Handlers\Raw\RawDataResponse;

class UDP extends AbstractDnsHandler
{

    private int $port = 53;

    /**
     * @var mixed
     */
    private $socket = null;

    public function getType(): string
    {
        return DnsHandlerTypes::UDP;
    }

    public function canUseIt(): bool
    {
        return function_exists('socket_create');
    }

    private function getSocket()
    {
        $result = $this->socket
            ?? socket_create(
                AF_INET, SOCK_DGRAM, SOL_UDP
            );

        socket_set_option($result, SOL_SOCKET, SO_RCVTIMEO, array('sec' => $this->timeout, 'usec' => 0));

        if ($result === false) {
            return null;
        }

        return $this->socket = $result;
    }

    private function closeSocket()
    {
        if (is_null($this->socket)) {
            return;
        }
        socket_close($this->socket);
        $this->socket = null;
    }

    /**
     * @return int
     */
    public function getPort(): int
    {
        return $this->port;
    }

    /**
     * @param int $port
     * @return self
     */
    public function setPort(int $port): self
    {
        $this->port = $port;
        return $this;
    }

    /**
     * @throws DnsHandlerException
     * @throws RawDataException
     */
    private function query($hostName, $typeId, $retry = 0): ?RawDataResponse
    {
        $socket = $this->getSocket();

        if (is_null($socket)) {
            return null;
        }

        $request = new RawDataRequest($hostName, $typeId, $this->timeout);

        $header = $request->generateHeader();
        $headerLen = strlen($header);

        socket_setopt($socket, SOL_SOCKET, SO_RCVBUF, 4096);
        socket_setopt($socket, SOL_SOCKET, SO_SNDBUF, 4096);

        if (!socket_sendto($socket, $header, $headerLen, 0, $this->nameserver, $this->port)) {
            if ($retry < $this->retries) {
                return $this->query($hostName, $typeId, $retry + 1);
            }
            $this->closeSocket();
            throw new DnsHandlerException(
                "Failed to write question to UDP socket",
                DnsHandlerException::ERR_UNABLE_TO_WRITE_TO_UDP_SOCKET
            );
        }

        $rawDataResponse = socket_read($socket, 512);

        if (empty($rawDataResponse)) {
            $this->closeSocket();
            throw new DnsHandlerException(
                "Failed to read data buffer",
                DnsHandlerException::ERR_UNABLE_TO_READ_DATA_BUFFER
            );
        }

        $this->closeSocket();

        return new RawDataResponse($request, $rawDataResponse, $this->getType());
    }

    /**
     * @param string $host
     * @param int $typeId
     * @return array
     * @throws DnsHandlerException
     * @throws RawDataException
     */
    public function getDnsData(string $host, int $typeId): array
    {
        $this->validateParams($host, $typeId);
        $result = $this->query($host, $typeId);

        if (is_null($result)) {
            return [];
        }

        return $result->getData();
    }

}