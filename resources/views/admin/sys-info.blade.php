@extends('admin.layout')

@section('title','Diagnóstico do Sistema')

@section('admin-content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="mb-0">Diagnóstico de Upload</h5>
        <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary btn-sm">Voltar</a>
    </div>

    <div class="card mb-3">
        <div class="card-header fw-semibold">Ambiente PHP</div>
        <div class="card-body">
            <div class="row g-3 small">
                <div class="col-md-3"><strong>SAPI:</strong> {{ $sapi }}</div>
                <div class="col-md-3"><strong>PHP:</strong> {{ $phpVersion }}</div>
                <div class="col-md-6"><strong>APP_URL:</strong> {{ config('app.url') }}</div>
            </div>
        </div>
    </div>

    <div class="card mb-3">
        <div class="card-header fw-semibold">ini_get (limites de upload)</div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-sm mb-0">
                    <thead>
                        <tr>
                            <th>Config</th>
                            <th>Valor</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($ini as $k => $v)
                            <tr>
                                <td class="text-nowrap">{{ $k }}</td>
                                <td>{{ $v ?? '—' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="small text-muted mt-2">Dica: upload_max_filesize deve ser ≥ 10M e post_max_size ≥ soma dos arquivos (ex.: 48M).</div>
        </div>
    </div>

    <div class="card mb-3">
        <div class="card-header fw-semibold">Diretórios temporários</div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-sm mb-0">
                    <thead>
                        <tr>
                            <th>Local</th>
                            <th>Caminho</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>sys_get_temp_dir()</td>
                            <td class="text-break">{{ $checks['sys_tmp']['path'] }}</td>
                            <td>{!! $checks['sys_tmp']['writable'] ? '<span class="badge bg-success">gravável</span>' : '<span class="badge bg-danger">sem gravação</span>' !!}</td>
                        </tr>
                        <tr>
                            <td>upload_tmp_dir (php.ini)</td>
                            <td class="text-break">{{ $checks['conf_tmp']['path'] ?? '—' }}</td>
                            <td>
                                @if(is_null($checks['conf_tmp']['writable']))
                                    <span class="badge bg-secondary">não definido</span>
                                @else
                                    {!! $checks['conf_tmp']['writable'] ? '<span class="badge bg-success">gravável</span>' : '<span class="badge bg-danger">sem gravação</span>' !!}
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>storage/app/tmp</td>
                            <td class="text-break">{{ $checks['app_tmp']['path'] }}</td>
                            <td>
                                @if(!$checks['app_tmp']['exists'])
                                    <span class="badge bg-warning text-dark">não existe</span>
                                @else
                                    {!! $checks['app_tmp']['writable'] ? '<span class="badge bg-success">gravável</span>' : '<span class="badge bg-danger">sem gravação</span>' !!}
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="small mt-2">
                Se "storage/app/tmp" não existir ou não for gravável:<br>
                <code>mkdir -p storage/app/tmp && sudo chown -R $USER:www-data storage && sudo find storage -type d -exec chmod 775 {} +</code>
            </div>
        </div>
    </div>

    <div class="alert alert-info small">
        Reinicie o servidor com limites maiores se necessário:<br>
        <code>php -d file_uploads=On -d upload_max_filesize=12M -d post_max_size=48M -d max_file_uploads=50 -d upload_tmp_dir="$(pwd)/storage/app/tmp" artisan serve --host=0.0.0.0 --port=8000</code>
    </div>
@endsection

