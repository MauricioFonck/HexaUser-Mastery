<?php

declare(strict_types=1);

abstract class DomainEvent
{
    private string $eventId;
    private string $eventName;
    private DateTimeImmutable $occurredOn;

    public function __construct(string $eventName)
    {
        $this->eventId    = bin2hex(random_bytes(16));
        $this->eventName  = $eventName;
        $this->occurredOn = new DateTimeImmutable();
    }

    public function eventId(): string { return $this->eventId; }
    public function eventName(): string { return $this->eventName; }
    public function occurredOn(): string { return $this->occurredOn->format('Y-m-d H:i:s'); }

    abstract public function payload(): array;
}
