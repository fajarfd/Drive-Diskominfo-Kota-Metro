<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SecurityHeadersMiddleware
{
    /**
     * Handle an incoming request dan tambahkan security headers
     * untuk mengatasi temuan ZAP scan:
     * - Content Security Policy (CSP)
     * - X-Frame-Options (Anti-Clickjacking)
     * - X-Content-Type-Options (nosniff)
     * - Hapus header X-Powered-By
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // 1. Content Security Policy (CSP)
        // Izinkan resource dari origin sendiri; CDN Google Fonts diizinkan khusus untuk font.
        // Firebase Auth (signInWithPopup) membutuhkan domain Google yang lebih luas:
        //   - accounts.google.com     → popup OAuth Google
        //   - oauth2.googleapis.com   → token exchange
        //   - www.googleapis.com      → profile/userinfo endpoint
        //   - apis.google.com         → Firebase JS SDK (loader)
        //   - www.gstatic.com         → Firebase JS bundle
        //   - firebaseapp.com         → hosted auth page / iframe Firebase
        $response->headers->set(
            'Content-Security-Policy',
            "default-src 'self'; " .
            "script-src 'self' 'unsafe-inline' https://www.gstatic.com https://apis.google.com https://accounts.google.com; " .
            "style-src 'self' 'unsafe-inline' https://fonts.googleapis.com https://accounts.google.com; " .
            "font-src 'self' https://fonts.gstatic.com; " .
            "img-src 'self' data: https: blob:; " .
            // connect-src: tambahkan semua endpoint Firebase Auth & Google OAuth
            "connect-src 'self' " .
                "https://identitytoolkit.googleapis.com " .
                "https://securetoken.googleapis.com " .
                "https://accounts.google.com " .
                "https://oauth2.googleapis.com " .
                "https://www.googleapis.com " .
                "https://firebaseinstallations.googleapis.com; " .
            // frame-src: Firebase signInWithPopup membuat iframe internal ke Google & firebaseapp.com
            "frame-src 'self' https://accounts.google.com https://komsafe.firebaseapp.com; " .
            "frame-ancestors 'none';"
        );

        // 2. Anti-Clickjacking: X-Frame-Options
        $response->headers->set('X-Frame-Options', 'DENY');

        // 3. X-Content-Type-Options: nosniff
        $response->headers->set('X-Content-Type-Options', 'nosniff');

        // 4. Referrer-Policy (bonus hardening)
        $response->headers->set('Referrer-Policy', 'strict-origin-when-cross-origin');

        // 5. Hapus header X-Powered-By yang membocorkan info server
        $response->headers->remove('X-Powered-By');

        return $response;
    }
}
