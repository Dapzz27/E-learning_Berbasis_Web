<x-layouts.guru title="Monitoring Siswa">

<style>
/* ── Reset & Base ── */
*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

.ms-wrap {
    font-family: 'Inter', system-ui, sans-serif;
    font-size: 13px;
    color: #1e293b;
    padding: 20px 24px;
    background: #f1f5f9;
    min-height: 100vh;
}

/* ── Page Header ── */
.ms-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 20px;
    flex-wrap: wrap;
    gap: 10px;
}
.ms-header h1 {
    font-size: 17px;
    font-weight: 700;
    color: #0f172a;
    letter-spacing: -0.3px;
}
.ms-header p {
    font-size: 12px;
    color: #64748b;
    margin-top: 2px;
}
.btn-export {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    background: #16a34a;
    color: #fff;
    border: none;
    padding: 7px 14px;
    border-radius: 8px;
    font-size: 12px;
    font-weight: 600;
    cursor: pointer;
    transition: background .15s;
    text-decoration: none;
}
.btn-export:hover { background: #15803d; }

/* ── Stat Cards ── */
.ms-stats {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 12px;
    margin-bottom: 18px;
}
.stat-card {
    background: #fff;
    border-radius: 10px;
    padding: 14px 16px;
    border: 1px solid #e2e8f0;
    display: flex;
    align-items: center;
    gap: 12px;
}
.stat-icon {
    width: 36px; height: 36px;
    border-radius: 8px;
    display: flex; align-items: center; justify-content: center;
    font-size: 16px;
    flex-shrink: 0;
}
.stat-icon.blue   { background: #eff6ff; }
.stat-icon.green  { background: #f0fdf4; }
.stat-icon.orange { background: #fff7ed; }
.stat-icon.red    { background: #fef2f2; }
.stat-val { font-size: 20px; font-weight: 700; color: #0f172a; line-height: 1; }
.stat-lbl { font-size: 11px; color: #64748b; margin-top: 2px; }

/* ── Two-column Layout ── */
.ms-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 14px;
    margin-bottom: 14px;
}
.ms-row.full { grid-template-columns: 1fr; }

/* ── Card ── */
.card {
    background: #fff;
    border-radius: 10px;
    border: 1px solid #e2e8f0;
    overflow: hidden;
}
.card-head {
    padding: 12px 16px;
    border-bottom: 1px solid #f1f5f9;
    display: flex;
    align-items: center;
    justify-content: space-between;
}
.card-head h2 {
    font-size: 13px;
    font-weight: 600;
    color: #0f172a;
}
.card-head span { font-size: 11px; color: #94a3b8; }
.card-body { padding: 12px 16px; }

/* ── Activity List ── */
.activity-list { display: flex; flex-direction: column; gap: 10px; }
.activity-item {
    display: flex;
    align-items: flex-start;
    gap: 10px;
}
.act-dot {
    width: 8px; height: 8px;
    border-radius: 50%;
    margin-top: 4px;
    flex-shrink: 0;
}
.act-dot.absen   { background: #3b82f6; }
.act-dot.tugas   { background: #22c55e; }
.act-dot.materi  { background: #f59e0b; }
.act-dot.login   { background: #8b5cf6; }
.act-name { font-weight: 600; color: #0f172a; }
.act-desc { font-size: 11px; color: #64748b; margin-top: 1px; }
.act-time { font-size: 11px; color: #94a3b8; white-space: nowrap; margin-left: auto; }

/* ── Online Status ── */
.online-list { display: flex; flex-direction: column; gap: 8px; }
.online-item {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 7px 0;
    border-bottom: 1px solid #f8fafc;
}
.online-item:last-child { border-bottom: none; }
.avatar {
    width: 30px; height: 30px;
    border-radius: 50%;
    background: linear-gradient(135deg, #6366f1, #8b5cf6);
    color: #fff;
    font-size: 11px;
    font-weight: 700;
    display: flex; align-items: center; justify-content: center;
    flex-shrink: 0;
}
.avatar.g2 { background: linear-gradient(135deg, #22c55e, #16a34a); }
.avatar.g3 { background: linear-gradient(135deg, #f59e0b, #d97706); }
.avatar.g4 { background: linear-gradient(135deg, #ec4899, #db2777); }
.avatar.g5 { background: linear-gradient(135deg, #3b82f6, #2563eb); }
.avatar.g6 { background: linear-gradient(135deg, #14b8a6, #0d9488); }

.online-name { font-weight: 600; font-size: 12px; color: #0f172a; }
.online-sub  { font-size: 11px; color: #94a3b8; }
.status-dot {
    width: 7px; height: 7px;
    border-radius: 50%;
    margin-left: auto;
    flex-shrink: 0;
}
.status-dot.online  { background: #22c55e; box-shadow: 0 0 0 2px #dcfce7; }
.status-dot.offline { background: #cbd5e1; }

/* ── Submission Table ── */
.sub-table {
    width: 100%;
    border-collapse: collapse;
}
.sub-table th {
    text-align: left;
    font-size: 11px;
    font-weight: 600;
    color: #64748b;
    text-transform: uppercase;
    letter-spacing: .5px;
    padding: 6px 8px;
    background: #f8fafc;
    border-bottom: 1px solid #e2e8f0;
}
.sub-table td {
    padding: 8px 8px;
    font-size: 12px;
    color: #334155;
    border-bottom: 1px solid #f1f5f9;
    vertical-align: middle;
}
.sub-table tr:last-child td { border-bottom: none; }
.badge {
    display: inline-block;
    padding: 2px 8px;
    border-radius: 99px;
    font-size: 10px;
    font-weight: 600;
}
.badge.tepat  { background: #dcfce7; color: #16a34a; }
.badge.telat  { background: #fee2e2; color: #dc2626; }
.badge.belum  { background: #fef9c3; color: #a16207; }

/* ── Bar Chart ── */
.chart-wrap { overflow-x: auto; }
.bar-chart {
    display: flex;
    align-items: flex-end;
    gap: 6px;
    height: 100px;
    padding-bottom: 20px;
    position: relative;
    min-width: 380px;
}
.bar-item {
    display: flex;
    flex-direction: column;
    align-items: center;
    flex: 1;
    gap: 4px;
}
.bar-fill {
    width: 100%;
    max-width: 32px;
    border-radius: 4px 4px 0 0;
    transition: opacity .2s;
    cursor: pointer;
}
.bar-fill:hover { opacity: .8; }
.bar-label { font-size: 10px; color: #64748b; text-align: center; white-space: nowrap; }
.bar-val   { font-size: 10px; font-weight: 700; color: #475569; }

/* ── Legend ── */
.legend { display: flex; gap: 12px; flex-wrap: wrap; margin-top: 10px; }
.legend-item { display: flex; align-items: center; gap: 5px; font-size: 11px; color: #64748b; }
.legend-dot { width: 8px; height: 8px; border-radius: 2px; }

/* ── Responsive ── */
@media (max-width: 900px) {
    .ms-stats { grid-template-columns: repeat(2, 1fr); }
    .ms-row   { grid-template-columns: 1fr; }
}
@media (max-width: 480px) {
    .ms-stats { grid-template-columns: 1fr 1fr; }
    .ms-wrap  { padding: 12px; }
}
</style>

<div class="ms-wrap">

    <!-- Header -->
    <div class="ms-header">
        <div>
            <h1>📊 Monitoring Siswa</h1>
            <p>Pantau keaktifan, absensi, dan pengumpulan tugas siswa secara real-time.</p>
        </div>
        <button class="btn-export" onclick="exportExcel()">
            ⬇️ Export Excel
        </button>
    </div>

    <!-- Stat Cards -->
    <div class="ms-stats">
        <div class="stat-card">
            <div class="stat-icon blue">👥</div>
            <div>
                <div class="stat-val">24</div>
                <div class="stat-lbl">Total Siswa</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon green">🟢</div>
            <div>
                <div class="stat-val">9</div>
                <div class="stat-lbl">Sedang Online</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon orange">📋</div>
            <div>
                <div class="stat-val">18</div>
                <div class="stat-lbl">Sudah Kumpul Tugas</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon red">⚠️</div>
            <div>
                <div class="stat-val">4</div>
                <div class="stat-lbl">Telat Kumpul</div>
            </div>
        </div>
    </div>

    <!-- Row 1: Aktivitas Terbaru + Status Online -->
    <div class="ms-row">

        <!-- Aktivitas Terbaru -->
        <div class="card">
            <div class="card-head">
                <h2>🔔 Aktivitas Terbaru</h2>
                <span>Hari ini</span>
            </div>
            <div class="card-body">
                <div class="activity-list">
                    <div class="activity-item">
                        <div class="act-dot tugas"></div>
                        <div>
                            <div class="act-name">Virly Yudha</div>
                            <div class="act-desc">Mengumpulkan tugas — Pertemuan 3</div>
                        </div>
                        <div class="act-time">08:14</div>
                    </div>
                    <div class="activity-item">
                        <div class="act-dot absen"></div>
                        <div>
                            <div class="act-name">Vira Azmi</div>
                            <div class="act-desc">Absensi hadir — Pertemuan 4</div>
                        </div>
                        <div class="act-time">08:02</div>
                    </div>
                    <div class="activity-item">
                        <div class="act-dot materi"></div>
                        <div>
                            <div class="act-name">Virly Ady Wikjaya</div>
                            <div class="act-desc">Mengunduh materi — Bab 2.pdf</div>
                        </div>
                        <div class="act-time">07:58</div>
                    </div>
                    <div class="activity-item">
                        <div class="act-dot login"></div>
                        <div>
                            <div class="act-name">Rangga Saputra</div>
                            <div class="act-desc">Membuka website — aktif 12 menit</div>
                        </div>
                        <div class="act-time">07:45</div>
                    </div>
                    <div class="activity-item">
                        <div class="act-dot tugas"></div>
                        <div>
                            <div class="act-name">Siti Nurhaliza</div>
                            <div class="act-desc">Mengumpulkan tugas — Pertemuan 3</div>
                        </div>
                        <div class="act-time">07:30</div>
                    </div>
                    <div class="activity-item">
                        <div class="act-dot absen"></div>
                        <div>
                            <div class="act-name">Bagas Pratama</div>
                            <div class="act-desc">Absensi hadir — Pertemuan 4</div>
                        </div>
                        <div class="act-time">07:15</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Status Online Siswa -->
        <div class="card">
            <div class="card-head">
                <h2>🟢 Status Siswa</h2>
                <span>Live</span>
            </div>
            <div class="card-body">
                <div class="online-list">
                    <div class="online-item">
                        <div class="avatar">VY</div>
                        <div>
                            <div class="online-name">Virly Yudha</div>
                            <div class="online-sub">Aktif sekarang</div>
                        </div>
                        <div class="status-dot online"></div>
                    </div>
                    <div class="online-item">
                        <div class="avatar g2">VA</div>
                        <div>
                            <div class="online-name">Vira Azmi</div>
                            <div class="online-sub">Aktif sekarang</div>
                        </div>
                        <div class="status-dot online"></div>
                    </div>
                    <div class="online-item">
                        <div class="avatar g3">RS</div>
                        <div>
                            <div class="online-name">Rangga Saputra</div>
                            <div class="online-sub">Aktif sekarang</div>
                        </div>
                        <div class="status-dot online"></div>
                    </div>
                    <div class="online-item">
                        <div class="avatar g4">SN</div>
                        <div>
                            <div class="online-name">Siti Nurhaliza</div>
                            <div class="online-sub">Terakhir online: 08:30</div>
                        </div>
                        <div class="status-dot offline"></div>
                    </div>
                    <div class="online-item">
                        <div class="avatar g5">BP</div>
                        <div>
                            <div class="online-name">Bagas Pratama</div>
                            <div class="online-sub">Terakhir online: 07:55</div>
                        </div>
                        <div class="status-dot offline"></div>
                    </div>
                    <div class="online-item">
                        <div class="avatar g6">DM</div>
                        <div>
                            <div class="online-name">Dinda Melati</div>
                            <div class="online-sub">Terakhir online: kemarin</div>
                        </div>
                        <div class="status-dot offline"></div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Row 2: Grafik Keaktifan -->
    <div class="ms-row full" style="margin-bottom:14px;">
        <div class="card">
            <div class="card-head">
                <h2>📈 Grafik Keaktifan Siswa (7 Hari Terakhir)</h2>
                <span>Absensi · Tugas · Materi</span>
            </div>
            <div class="card-body">
                <div class="chart-wrap">
                    <div class="bar-chart" id="barChart"></div>
                </div>
                <div class="legend">
                    <div class="legend-item"><div class="legend-dot" style="background:#6366f1"></div> Absensi</div>
                    <div class="legend-item"><div class="legend-dot" style="background:#22c55e"></div> Kumpul Tugas</div>
                    <div class="legend-item"><div class="legend-dot" style="background:#f59e0b"></div> Unduh Materi</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Row 3: Tabel Pengumpulan Tugas -->
    <div class="ms-row full">
        <div class="card">
            <div class="card-head">
                <h2>📝 Rekap Pengumpulan Tugas</h2>
                <span>Pertemuan 3 — Deadline: 17 Jun 2026, 23:59</span>
            </div>
            <div class="card-body" style="padding:0 0 4px 0;">
                <div style="overflow-x:auto;">
                    <table class="sub-table" id="tugasTable">
                        <thead>
                            <tr>
                                <th style="padding-left:16px;">#</th>
                                <th>Nama Siswa</th>
                                <th>Waktu Kumpul</th>
                                <th>Tanggal</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="padding-left:16px; color:#94a3b8;">1</td>
                                <td><div style="display:flex;align-items:center;gap:8px;"><div class="avatar" style="width:24px;height:24px;font-size:9px;">VY</div> Virly Yudha</div></td>
                                <td>08:14</td>
                                <td>18 Jun 2026</td>
                                <td><span class="badge tepat">Tepat Waktu</span></td>
                            </tr>
                            <tr>
                                <td style="padding-left:16px; color:#94a3b8;">2</td>
                                <td><div style="display:flex;align-items:center;gap:8px;"><div class="avatar g2" style="width:24px;height:24px;font-size:9px;">VA</div> Vira Azmi</div></td>
                                <td>07:30</td>
                                <td>18 Jun 2026</td>
                                <td><span class="badge tepat">Tepat Waktu</span></td>
                            </tr>
                            <tr>
                                <td style="padding-left:16px; color:#94a3b8;">3</td>
                                <td><div style="display:flex;align-items:center;gap:8px;"><div class="avatar g3" style="width:24px;height:24px;font-size:9px;">SN</div> Siti Nurhaliza</div></td>
                                <td>23:47</td>
                                <td>17 Jun 2026</td>
                                <td><span class="badge tepat">Tepat Waktu</span></td>
                            </tr>
                            <tr>
                                <td style="padding-left:16px; color:#94a3b8;">4</td>
                                <td><div style="display:flex;align-items:center;gap:8px;"><div class="avatar g4" style="width:24px;height:24px;font-size:9px;">BP</div> Bagas Pratama</div></td>
                                <td>01:22</td>
                                <td>18 Jun 2026</td>
                                <td><span class="badge telat">⚠ Telat</span></td>
                            </tr>
                            <tr>
                                <td style="padding-left:16px; color:#94a3b8;">5</td>
                                <td><div style="display:flex;align-items:center;gap:8px;"><div class="avatar g5" style="width:24px;height:24px;font-size:9px;">RS</div> Rangga Saputra</div></td>
                                <td>09:05</td>
                                <td>18 Jun 2026</td>
                                <td><span class="badge telat">⚠ Telat</span></td>
                            </tr>
                            <tr>
                                <td style="padding-left:16px; color:#94a3b8;">6</td>
                                <td><div style="display:flex;align-items:center;gap:8px;"><div class="avatar g6" style="width:24px;height:24px;font-size:9px;">DM</div> Dinda Melati</div></td>
                                <td>—</td>
                                <td>—</td>
                                <td><span class="badge belum">Belum Kumpul</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>

<script>
/* ── Bar Chart (vanilla JS, no library) ── */
const days = ['Sen 12', 'Sel 13', 'Rab 14', 'Kam 15', 'Jum 16', 'Sab 17', 'Min 18'];
const absensi = [20, 22, 19, 24, 21, 15, 18];
const tugas   = [12, 15, 10, 18, 14, 9,  11];
const materi  = [8,  11, 7,  14, 10, 6,  9];
const max = Math.max(...absensi);
const chartH = 80; // px usable height

const chart = document.getElementById('barChart');
days.forEach((day, i) => {
    const grp = document.createElement('div');
    grp.className = 'bar-item';

    const bars = document.createElement('div');
    bars.style.cssText = 'display:flex;align-items:flex-end;gap:2px;width:100%;justify-content:center;';

    [[absensi[i],'#6366f1'], [tugas[i],'#22c55e'], [materi[i],'#f59e0b']].forEach(([v, c]) => {
        const b = document.createElement('div');
        b.className = 'bar-fill';
        b.style.cssText = `height:${Math.round((v/max)*chartH)}px;background:${c};`;
        b.title = v + ' siswa';
        bars.appendChild(b);
    });

    const lbl = document.createElement('div');
    lbl.className = 'bar-label';
    lbl.textContent = day;

    grp.appendChild(bars);
    grp.appendChild(lbl);
    chart.appendChild(grp);
});

/* ── Export Excel (CSV) ── */
function exportExcel() {
    const rows = [['No','Nama Siswa','Waktu Kumpul','Tanggal','Status']];
    const table = document.getElementById('tugasTable');
    table.querySelectorAll('tbody tr').forEach((tr, i) => {
        const cells = tr.querySelectorAll('td');
        rows.push([
            i + 1,
            cells[1].innerText.trim(),
            cells[2].innerText,
            cells[3].innerText,
            cells[4].innerText.trim()
        ]);
    });

    const csv = rows.map(r => r.map(c => `"${c}"`).join(',')).join('\n');
    const blob = new Blob([csv], { type: 'text/csv;charset=utf-8;' });
    const url  = URL.createObjectURL(blob);
    const a    = document.createElement('a');
    a.href = url;
    a.download = 'monitoring_siswa_' + new Date().toISOString().slice(0,10) + '.csv';
    a.click();
    URL.revokeObjectURL(url);
}
</script>

</x-layouts.guru>