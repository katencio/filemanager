@extends('layouts.app')

@section('content')
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">{{ __('messages.upload_file') }}</h5>
                </div>
                <div class="card-body">
                    <form action="{{ app()->getLocale() === 'es' ? route('files.store.es') : route('files.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row g-3 align-items-center">
                            <div class="col-md-8">
                                <input type="file"
                                       name="file"
                                       class="form-control @error('file') is-invalid @enderror"
                                       required>
                                <small class="form-text text-muted">{{ __('messages.max_file_size') }}</small>
                                @error('file')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4 text-md-start text-end">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('messages.upload') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">{{ __('messages.uploaded_files') }}</h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-striped mb-0">
                            <thead>
                            <tr>
                                <th>{{ __('messages.name') }}</th>
                                <th class="text-end">{{ __('messages.size') }}</th>
                                <th>{{ __('messages.upload_date') }}</th>
                                <th class="text-end">{{ __('messages.actions') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse ($files as $file)
                                <tr>
                                    <td>{{ $file->original_name }}</td>
                                    <td class="text-end">
                                        {{ number_format($file->file_size / 1024, 2) }} KB
                                    </td>
                                    <td>
                                        {{ optional($file->uploaded_at)->format('d/m/Y H:i') }}
                                    </td>
                                    <td class="text-end">
                                        <a href="{{ app()->getLocale() === 'es' ? route('files.download.es', $file) : route('files.download', $file) }}"
                                           class="btn btn-sm btn-outline-secondary">
                                            {{ __('messages.download') }}
                                        </a>
                                        <form action="{{ app()->getLocale() === 'es' ? route('files.destroy.es', $file) : route('files.destroy', $file) }}"
                                              method="POST"
                                              class="d-inline"
                                              onsubmit="return confirm('{{ __('messages.confirm_delete') }}');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger">
                                                {{ __('messages.delete') }}
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center py-4">
                                        {{ __('messages.no_files') }}
                                    </td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                @if (method_exists($files, 'links'))
                    <div class="card-footer">
                        {{ $files->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection


