<x-layouts.app title="Verify Certificate - Mawey Tutorials">
    <section class="content-page shell">
        <div class="content-card certificate-card">
            @if ($certificate)
                <span class="eyebrow">VERIFIED CERTIFICATE</span>
                <h1>{{ $certificate->user->name }} completed {{ $certificate->course->title }}</h1>
                <p>Certificate {{ $certificate->certificate_number }} was issued
                {{ $certificate->issued_at->format('F j, Y') }}.</p><span class="status">Verified</span>@else<h1>
                    Certificate not found</h1>
                <p>Check the certificate number and try again.</p>
            @endif
        </div>
    </section>
</x-layouts.app>
