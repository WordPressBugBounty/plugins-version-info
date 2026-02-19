<?php

declare(strict_types=1);

namespace GauchoPlugins\VersionInfo;

interface ProviderInterface {

    public function getName(): string;

    public function getKey(): string;

    public function isAvailable(): bool;

    /**
     * @return array<string, mixed>
     */
    public function collect(): array;
}
