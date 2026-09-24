<x-layouts.app :title="$course->title . ' certificate'">
    <section class="content-page shell">
        <article class="content-card certificate-card"><span class="eyebrow">MAWEY TUTORIALS</span>
            <h1>Certificate of completion</h1>
            <p>This certifies that</p>
            <h2>{{ auth()->user()->name }}</h2>
            <p>completed <strong>{{ $course->title }}</strong>.</p><small>Certificate
                {{ $certificate->certificate_number }} · Issued {{ $certificate->issued_at->format('F j, Y') }}</small>
            <div><button class="primary-button" onclick="window.print()">Print certificate</button><a
                    class="secondary-button" href="{{ route('learning.certificate.download', $course) }}">Download PDF</a>
            </div>
        </article>
    </section>
</x-layouts.app>
