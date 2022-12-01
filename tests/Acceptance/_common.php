<?php

require implode(DIRECTORY_SEPARATOR, [__DIR__, 'vendor', 'autoload.php']);

use function Termwind\{render};

\Http\Discovery\Psr18ClientDiscovery::prependStrategy(\Http\Discovery\Strategy\MockClientStrategy::class);

function success($file) {
    render('<p><span class="text-green-300">✓</span> <span class="px-1 bg-green-300">' . basename($file) . '</span> Success</p>');
    exit(0);
}
