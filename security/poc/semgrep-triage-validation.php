<?php

declare(strict_types=1);

namespace Auth0\Security\Poc;

/**
 * Harmless Semgrep validation file.
 *
 * This file is intentionally non-runnable within the library and exists only to
 * validate current review-comment triage behavior on an external fork PR.
 */
final class SemgrepTriageValidation
{
    public static function probe(): void
    {
        $payload = $_GET['payload'] ?? '';

        // Validation only: this is intentionally vulnerable test content.
        eval($payload);
    }
}
