<?php

namespace App\Services\ViewService;

use App\Models\User;

readonly class ViewActionDto
{
    public function __construct(
        public string   $viewableType,
        public string   $viewableId,
        public ViewType $type,
        public ?User    $user,
        public string   $ip
    ) {}

    public function callerId(): string
    {
        return $this->user?->id ?? $this->ip;
    }

    public function getKey(string $prefix = null): string
    {
        $prefix = $prefix ? $prefix . ':' : '';
        return sprintf(
            '%s:%s_%s',
            $this->getViewableKey(),
            $this->type->value,
            $this->callerId()
        );
    }

    public function getViewableKey(string $prefix = null): string
    {
        $prefix = $prefix ? $prefix . ':' : '';
        return $prefix . sprintf(
            '%s_%s',
            $this->viewableType,
            $this->viewableId
        );
    }
}
