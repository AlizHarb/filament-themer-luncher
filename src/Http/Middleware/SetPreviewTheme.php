<?php

declare(strict_types=1);

namespace AlizHarb\ThemerLuncher\Http\Middleware;

use AlizHarb\Themer\Facades\Theme;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Middleware to support theme previewing via session or query parameter.
 */
class SetPreviewTheme
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        /** @var string|null $previewTheme */
        $previewTheme = $request->get('preview_theme') ?? session('preview_theme');

        if ($previewTheme) {
            try {
                Theme::set($previewTheme);
            } catch (\Exception $e) {
                // Silently ignore if theme doesn't exist
                session()->forget('preview_theme');
            }
        }

        return $next($request);
    }
}
