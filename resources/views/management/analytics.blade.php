<x-layouts.app title="Platform Analytics - Mawey Tutorials">
    <section class="content-page shell">
        <div class="page-heading"><span class="eyebrow">PLATFORM ANALYTICS</span>
            <h1>See how Mawey is growing.</h1>
            <p>Track the last six months of activity across the platform.</p>
        </div>
        <div class="management-grid">
            <article class="content-card"><strong>{{ $users }}</strong><span>Users</span></article>
            <article class="content-card"><strong>{{ $courses }}</strong><span>Courses</span></article>
            <article class="content-card"><strong>{{ $enrollments }}</strong><span>Enrollments</span></article>
            <article class="content-card"><strong>${{ number_format($revenue / 100, 2) }}</strong><span>Catalog
                    value</span></article>
        </div>
        <section class="content-card analytics-card">
            <div class="analytics-toolbar">
                <div>
                    <h2>Growth overview</h2>
                    <p>Monthly users, enrollments, and revenue.</p>
                </div>
                <div class="chart-toggle" role="group" aria-label="Chart type"><button
                        class="chart-toggle-button is-active" type="button" data-chart-type="line">Line</button><button
                        class="chart-toggle-button" type="button" data-chart-type="bar">Bar</button></div>
            </div>
            <div class="chart-legend"><span><i class="legend-users"></i>Users</span><span><i
                        class="legend-enrollments"></i>Enrollments</span><span><i
                        class="legend-revenue"></i>Revenue</span></div>
            <div class="chart-stage"><svg class="analytics-chart" viewBox="0 0 760 330" role="img"
                    aria-label="Six month platform analytics chart"></svg></div>
        </section>
    </section>
    <script>
        window.maweyAnalytics = @json($chartData);
    </script>
    <script>
        (() => {
            const data = window.maweyAnalytics || [];
            const svg = document.querySelector('.analytics-chart');
            const buttons = document.querySelectorAll('[data-chart-type]');
            if (!svg || !data.length) return;
            const width = 760;
            const height = 330;
            const padding = {
                top: 20,
                right: 24,
                bottom: 42,
                left: 48
            };
            const series = [{
                key: 'users',
                color: '#4d42e9'
            }, {
                key: 'enrollments',
                color: '#20a779'
            }, {
                key: 'revenue',
                color: '#e0912f'
            }];
            const maxValue = Math.max(1, ...series.flatMap(item => data.map(point => Number(point[item.key]))));
            const x = index => padding.left + index * ((width - padding.left - padding.right) / Math.max(1, data
                .length - 1));
            const y = value => height - padding.bottom - (value / maxValue) * (height - padding.top - padding.bottom);
            const draw = type => {
                const grid = [0, .25, .5, .75, 1].map(step =>
                    `<line class="chart-grid-line" x1="${padding.left}" x2="${width - padding.right}" y1="${y(maxValue * step)}" y2="${y(maxValue * step)}" />`
                    ).join('');
                const labels = data.map((point, index) =>
                    `<text class="chart-label" x="${x(index)}" y="${height - 14}" text-anchor="middle">${point.label}</text>`
                    ).join('');
                const marks = type === 'bar' ? series.map((item, seriesIndex) => {
                    const barWidth = Math.min(22, (width - padding.left - padding.right) / data.length / 4);
                    return data.map((point, index) => {
                        const value = Number(point[item.key]);
                        const barX = x(index) - barWidth * 1.5 + seriesIndex * barWidth;
                        return `<rect class="chart-bar" fill="${item.color}" x="${barX}" y="${y(value)}" width="${barWidth - 2}" height="${Math.max(1, height - padding.bottom - y(value))}" rx="3"><title>${point.label} ${item.key}: ${value}</title></rect>`;
                    }).join('');
                }).join('') : series.map(item => {
                    const points = data.map((point, index) => `${x(index)},${y(Number(point[item.key]))}`)
                        .join(' ');
                    const dots = data.map((point, index) =>
                        `<circle fill="${item.color}" cx="${x(index)}" cy="${y(Number(point[item.key]))}" r="4"><title>${point.label} ${item.key}: ${point[item.key]}</title></circle>`
                        ).join('');
                    return `<polyline class="chart-line" stroke="${item.color}" points="${points}" />${dots}`;
                }).join('');
                svg.innerHTML = grid + marks + labels;
            };
            buttons.forEach(button => button.addEventListener('click', () => {
                buttons.forEach(item => item.classList.remove('is-active'));
                button.classList.add('is-active');
                draw(button.dataset.chartType);
            }));
            draw('line');
        })();
    </script>
</x-layouts.app>
