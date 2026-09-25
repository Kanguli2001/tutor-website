<x-layouts.app title="Platform Analytics - Mawey Tutorials">
    <section class="content-page shell">
        <div class="page-heading">
            <span class="eyebrow">PLATFORM ANALYTICS</span>
            <h1>See how Mawey is growing.</h1>
            <p>Track the last six months of activity across the platform.</p>
        </div>

        <!-- Enhanced Metric Cards -->
        <div class="analytics-metrics-grid">
            <div class="analytics-metric-card">
                <div class="metric-icon metric-icon-users">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                </div>
                <div class="metric-data">
                    <strong>{{ $users }}</strong>
                    <span>Total Users</span>
                </div>
            </div>
            <div class="analytics-metric-card">
                <div class="metric-icon metric-icon-courses">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path></svg>
                </div>
                <div class="metric-data">
                    <strong>{{ $courses }}</strong>
                    <span>Total Courses</span>
                </div>
            </div>
            <div class="analytics-metric-card">
                <div class="metric-icon metric-icon-enrollments">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline></svg>
                </div>
                <div class="metric-data">
                    <strong>{{ $enrollments }}</strong>
                    <span>Enrollments</span>
                </div>
            </div>
            <div class="analytics-metric-card">
                <div class="metric-icon metric-icon-revenue">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="1" x2="12" y2="23"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>
                </div>
                <div class="metric-data">
                    <strong>${{ number_format($revenue / 100, 2) }}</strong>
                    <span>Catalog Value</span>
                </div>
            </div>
        </div>

        <!-- Enhanced Chart Section -->
        <section class="content-card analytics-card">
            <div class="analytics-toolbar">
                <div>
                    <h2>Growth overview</h2>
                    <p>Monthly users, enrollments, and revenue.</p>
                </div>
                <div class="chart-toggle" role="group" aria-label="Chart type">
                    <button class="chart-toggle-button is-active" type="button" data-chart-type="line">Line</button>
                    <button class="chart-toggle-button" type="button" data-chart-type="bar">Bar</button>
                </div>
            </div>
            <div class="chart-legend">
                <span><i class="legend-users"></i>Users</span>
                <span><i class="legend-enrollments"></i>Enrollments</span>
                <span><i class="legend-revenue"></i>Revenue</span>
            </div>
            <div class="chart-stage">
                <svg class="analytics-chart" viewBox="0 0 760 330" preserveAspectRatio="xMidYMid meet" role="img" aria-label="Six month platform analytics chart"></svg>
            </div>
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
            const padding = { top: 20, right: 24, bottom: 42, left: 48 };
            
            const series = [
                { key: 'users', color: '#4d42e9' },
                { key: 'enrollments', color: '#20a779' },
                { key: 'revenue', color: '#e0912f' }
            ];

            const maxValue = Math.max(1, ...series.flatMap(item => data.map(point => Number(point[item.key]))));
            const x = index => padding.left + index * ((width - padding.left - padding.right) / Math.max(1, data.length - 1));
            const y = value => height - padding.bottom - (value / maxValue) * (height - padding.top - padding.bottom);

            const draw = type => {
                // Create gradient definitions
                const defs = series.map(item => `
                    <linearGradient id="gradient-${item.key}" x1="0" y1="0" x2="0" y2="1">
                        <stop offset="0%" stop-color="${item.color}" stop-opacity="0.2"/>
                        <stop offset="100%" stop-color="${item.color}" stop-opacity="0"/>
                    </linearGradient>
                `).join('');

                // Create Y-Axis labels
                const yAxisTicks = [0, .25, .5, .75, 1].map(step => {
                    const val = maxValue * step;
                    const yPos = y(val);
                    return `
                        <line class="chart-grid-line" x1="${padding.left}" x2="${width - padding.right}" y1="${yPos}" y2="${yPos}" />
                        <text class="chart-y-label" x="${padding.left - 10}" y="${yPos + 4}" text-anchor="end">${Math.round(val)}</text>
                    `;
                }).join('');

                // Create X-Axis labels
                const xAxisLabels = data.map((point, index) =>
                    `<text class="chart-label" x="${x(index)}" y="${height - 14}" text-anchor="middle">${point.label}</text>`
                ).join('');

                let marks = '';

                if (type === 'bar') {
                    marks = series.map((item, seriesIndex) => {
                        const barWidth = Math.min(22, (width - padding.left - padding.right) / data.length / 4);
                        return data.map((point, index) => {
                            const value = Number(point[item.key]);
                            const barX = x(index) - barWidth * 1.5 + seriesIndex * barWidth;
                            return `<rect class="chart-bar" fill="${item.color}" x="${barX}" y="${y(value)}" width="${barWidth - 2}" height="${Math.max(1, height - padding.bottom - y(value))}" rx="3"><title>${point.label} ${item.key}: ${value}</title></rect>`;
                        }).join('');
                    }).join('');
                } else {
                    // Line chart with area fill
                    marks = series.map(item => {
                        const points = data.map((point, index) => `${x(index)},${y(Number(point[item.key]))}`).join(' ');
                        const areaPath = data.map((point, index) => `${index === 0 ? 'M' : 'L'} ${x(index)} ${y(Number(point[item.key]))}`).join(' ') + ` L ${x(data.length - 1)} ${height - padding.bottom} L ${x(0)} ${height - padding.bottom} Z`;
                        
                        const dots = data.map((point, index) =>
                            `<circle fill="${item.color}" cx="${x(index)}" cy="${y(Number(point[item.key]))}" r="4"><title>${point.label} ${item.key}: ${point[item.key]}</title></circle>`
                        ).join('');
                        
                        return `
                            <path d="${areaPath}" fill="url(#gradient-${item.key})" stroke="none" />
                            <polyline class="chart-line" stroke="${item.color}" points="${points}" />
                            ${dots}
                        `;
                    }).join('');
                }

                svg.innerHTML = `<defs>${defs}</defs>` + yAxisTicks + marks + xAxisLabels;
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