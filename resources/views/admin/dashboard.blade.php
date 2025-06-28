@extends('layout.be.template')
@section('title', 'Dashboard')
@section('styles')
    <link rel="stylesheet" href="/backend/plugins/jqvmap/dist/jqvmap.min.css">
    <link rel="stylesheet" href="/backend/plugins/summernote/dist/summernote-bs4.css">
@endsection
@section('content')
    @if (auth()->check() && auth()->user()->role != 'ortu')
        <div class="row">
            <div class="col-lg-3 col-6">
                <div class="small-box bg-gradient-blue">
                    <div class="inner">
                        <h3>{{ $jumlah_balita }}</h3>
                        <p>Data Balita</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-child"></i>
                    </div>
                    <a href="{{ route('balita.index') }}" class="small-box-footer">
                        More info <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-gradient-green">
                    <div class="inner">
                        <h3>{{ $jumlah_ortu }}</h3>
                        <p>Data Orang Tua</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-user-friends"></i>
                    </div>
                    <a href="{{ route('orangtua.index') }}" class="small-box-footer">
                        More info <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-gradient-yellow">
                    <div class="inner">
                        <h3 class="text-white">{{ $jumlah_vaksin }}</h3>
                        <p class="text-white">Data Vaksin</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-syringe"></i>
                    </div>
                    <a href="{{ route('vaksin.index') }}" class="small-box-footer">
                        More info <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-gradient-red">
                    <div class="inner">
                        <h3>{{ $jumlah_imunisasi }}</h3>
                        <p>Data Imunisasi</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-notes-medical"></i>
                    </div>
                    <a href="{{ route('vaksin.index') }}" class="small-box-footer">
                        More info <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-gradient-purple">
                    <div class="inner">
                        <h3 class="text-white">{{ $jumlah_penimbangan }}</h3>
                        <p class="text-white">Data Penimbangan</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-balance-scale"></i>
                    </div>
                    <a href="{{ route('penimbangan.index') }}" class="small-box-footer">
                        More info <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-gradient-pink">
                    <div class="inner">
                        <h3 class="text-white">{{ $jumlah_bidan }}</h3>
                        <p class="text-white">Data Bidan</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-user-md"></i>
                    </div>
                    <a href="{{ route('bidan.index') }}" class="small-box-footer">
                        More info <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>

            <div class="container">
                <div class="card">
                    <div class="card-body">
                        <p>Keterangan:</p>
                        <p>Dengan total balita laki-laki sebanyak {{ $jumlah_laki_laki }} dan perempuan
                            {{ $jumlah_perempuan }}
                    </div>
                    </p>
                </div>
            </div>

            <div class="container">
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-6">
                        <div class="card">
                            <div class="card-header text-center">
                                <h4>Grafik Total Immunisasi Harian</h4>
                            </div>
                            <div class="card-body">
                                <canvas id="myChartImunization"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-6 ">
                        <div class="card">
                            <div class="card-header text-center">
                                <h4>Grafik Total Penimbangan Harian</h4>
                            </div>
                            <div class="card-body">
                                <canvas id="myChartWeight"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if (auth()->check() && auth()->user()->role == 'ortu')

        <div class="row">
            @if ($balitaData->isEmpty())
                <div class="col-12">
                    <div class="callout callout-warning">
                        <p>Belum ada informasi balita, daftarkan balita anda pada posyandu untuk melihat perkembangan
                            balita
                            anda
                            setiap harinya.</p>
                    </div>
                </div>
            @else
                @foreach ($balitaData as $key => $balita)
                    <div class="col-12 col-md-6 col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <h4>Berat Badan - {{ $balita->nama_anak }}</h4>
                            </div>
                            <div class="card-body">
                                @php
                                    $penimbanganAnak = $penimbanganData->where('balita_id', $balita->id);
                                @endphp
                                @if ($penimbanganAnak->isNotEmpty())
                                    <canvas id="myChart{{ $key + 1 }}"></canvas>
                                    <script>
                                        var ctx = document.getElementById("myChart{{ $key + 1 }}").getContext('2d');
                                        var myChart = new Chart(ctx, {
                                            type: 'line',
                                            data: {
                                                labels: [
                                                    @foreach ($penimbanganAnak as $penimbangan)
                                                        "{{ \Carbon\Carbon::parse($penimbangan->tgl_timbang)->locale('id_ID')->isoFormat('D MMMM YYYY') }}",
                                                    @endforeach
                                                ],
                                                datasets: [{
                                                    label: 'Berat Badan (kg)',
                                                    data: [
                                                        @foreach ($penimbanganAnak as $penimbangan)
                                                            {{ $penimbangan->berat_badan }},
                                                        @endforeach
                                                    ],
                                                    borderWidth: 2,
                                                    backgroundColor: '#6777ef',
                                                    borderColor: '#6777ef',
                                                    borderWidth: 2.5,
                                                    pointBackgroundColor: '#ffffff',
                                                    pointRadius: 4
                                                }]
                                            },
                                            options: {
                                                legend: {
                                                    display: true,
                                                    position: 'bottom'
                                                },
                                                scales: {
                                                    yAxes: [{
                                                        gridLines: {
                                                            drawBorder: false,
                                                            color: '#f2f2f2',
                                                        },
                                                        ticks: {
                                                            beginAtZero: true,
                                                            stepSize: 10
                                                        }
                                                    }],
                                                    xAxes: [{
                                                        ticks: {
                                                            display: false
                                                        },
                                                        gridLines: {
                                                            display: false
                                                        }
                                                    }]
                                                },
                                            }
                                        });
                                    </script>
                                @else
                                    <p>{{ $balita->nama_anak }} belum melakukan penimbangan.</p>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>

        <div class="row">
            @foreach ($balitaData as $key => $balita)
                <div class="col-12 col-md-6 col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h4>Tinggi Badan - {{ $balita->nama_anak }}</h4>
                        </div>
                        <div class="card-body">
                            @php
                                $penimbanganAnak = $penimbanganData->where('balita_id', $balita->id);
                            @endphp
                            @if ($penimbanganAnak->isNotEmpty())
                                <canvas id="myChartheight{{ $key + 1 }}"></canvas>
                                <script>
                                    var ctx = document.getElementById("myChartheight{{ $key + 1 }}").getContext('2d');
                                    var myChart = new Chart(ctx, {
                                        type: 'line',
                                        data: {
                                            labels: [
                                                @foreach ($penimbanganAnak as $penimbangan)
                                                    "{{ \Carbon\Carbon::parse($penimbangan->tgl_timbang)->locale('id_ID')->isoFormat('D MMMM YYYY') }}",
                                                @endforeach
                                            ],
                                            datasets: [{
                                                label: 'Tinggi Badan (cm)',
                                                data: [
                                                    @foreach ($penimbanganAnak as $penimbangan)
                                                        {{ $penimbangan->tinggi_badan }},
                                                    @endforeach
                                                ],
                                                borderWidth: 2,
                                                backgroundColor: '#6777ef',
                                                borderColor: '#6777ef',
                                                borderWidth: 2.5,
                                                pointBackgroundColor: '#ffffff',
                                                pointRadius: 4
                                            }]
                                        },
                                        options: {
                                            legend: {
                                                display: true,
                                                position: 'bottom'
                                            },
                                            scales: {
                                                yAxes: [{
                                                    gridLines: {
                                                        drawBorder: false,
                                                        color: '#f2f2f2',
                                                    },
                                                    ticks: {
                                                        beginAtZero: true,
                                                        stepSize: 100
                                                    }
                                                }],
                                                xAxes: [{
                                                    ticks: {
                                                        display: false
                                                    },
                                                    gridLines: {
                                                        display: false
                                                    }
                                                }]
                                            },
                                        }
                                    });
                                </script>
                            @else
                                <p>{{ $balita->nama_anak }} belum melakukan penimbangan.</p>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

@endsection

@section('scripts')
    <script src="/backend/plugins/bootstrap-daterangepicker/moment.min.js"></script>
    <script src="/backend/plugins/moment/locale/id.js"></script>
    <script>
        // Set lokasi ke Indonesian
        moment.locale('id');

        var dailyTotalsY = @json($dailyTotalsY);
        var dailyTotalsT = @json($dailyTotalsT);

        var sortedDates = Object.keys(dailyTotalsY).sort(function(a, b) {
            return new Date(a) - new Date(b);
        });

        var formattedDates = sortedDates.map(function(date) {
            return moment(date).format('DD MMMM YYYY');
        });

        // Grafik Total Immunisasi Harian
        var ctx = document.getElementById("myChartImunization").getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: formattedDates,
                datasets: [{
                    label: 'Sukses Di Imunisasi',
                    data: sortedDates.map(function(date) {
                        return dailyTotalsY[date];
                    }),
                    backgroundColor: '#6777ef',
                    borderColor: '#6777ef',
                    borderWidth: 2.5,
                    pointBackgroundColor: '#ffffff',
                    pointRadius: 4
                }, {
                    label: 'Tidak Bisa Di Imunisasi',
                    data: sortedDates.map(function(date) {
                        return dailyTotalsT[date];
                    }),
                    backgroundColor: '#ef6777',
                    borderColor: '#ef6777',
                    borderWidth: 2.5,
                    pointBackgroundColor: '#ffffff',
                    pointRadius: 4
                }]
            },
            options: {
                legend: {
                    display: true,
                    position: 'bottom'
                },
                scales: {
                    yAxes: [{
                        gridLines: {
                            drawBorder: false,
                            color: '#f2f2f2',
                        },
                        ticks: {
                            beginAtZero: true,
                            stepSize: 1
                        }
                    }],
                    xAxes: [{
                        ticks: {
                            display: true
                        },
                        gridLines: {
                            display: true
                        }
                    }]
                },
            }
        });

        var TotalsPenimbanganY = @json($TotalsPenimbanganY);
        var TotalsPenimbanganT = @json($TotalsPenimbanganT);

        var sortedDates = Object.keys(TotalsPenimbanganY).sort(function(a, b) {
            return new Date(a) - new Date(b);
        });

        var formattedDates = sortedDates.map(function(date) {
            return moment(date).format('DD MMMM YYYY');
        });

        // Grafik Total Penimbangan Harian
        var ctx = document.getElementById("myChartWeight").getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: formattedDates,
                datasets: [{
                    label: 'Sesuai',
                    data: sortedDates.map(function(date) {
                        return TotalsPenimbanganY[date];
                    }),
                    backgroundColor: '#6777ef',
                    borderColor: '#6777ef',
                    borderWidth: 2.5,
                    pointBackgroundColor: '#ffffff',
                    pointRadius: 4
                }, {
                    label: 'Tidak Sesuai',
                    data: sortedDates.map(function(date) {
                        return TotalsPenimbanganT[date];
                    }),
                    backgroundColor: '#ef6777',
                    borderColor: '#ef6777',
                    borderWidth: 2.5,
                    pointBackgroundColor: '#ffffff',
                    pointRadius: 4
                }]
            },
            options: {
                legend: {
                    display: true,
                    position: 'bottom'
                },
                scales: {
                    yAxes: [{
                        gridLines: {
                            drawBorder: false,
                            color: '#f2f2f2',
                        },
                        ticks: {
                            beginAtZero: true,
                            stepSize: 1
                        }
                    }],
                    xAxes: [{
                        ticks: {
                            display: true
                        },
                        gridLines: {
                            display: true
                        }
                    }]
                },
            }
        });
    </script>
@endsection
