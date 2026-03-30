@extends ('layouts.backend-template.master')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-md-8">
            <h1 class="h3 fw-bold text-dark">Daftar Makanan</h1>
        </div>
        <div class="col-md-4 text-end">
            <a href="{{ route('food.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-2"></i> Tambah Makanan
            </a>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle me-2"></i>
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if ($foods->count() > 0)
        <div class="row">
            @foreach ($foods as $food)
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card shadow-sm h-100 border-0" style="transition: transform 0.3s, box-shadow 0.3s;">
                        @if ($food->image)
                            <img src="{{ asset($food->image) }}" class="card-img-top" alt="{{ $food->name }}"
                                style="height: 200px; object-fit: cover;">
                        @else
                            <div class="card-img-top bg-secondary d-flex align-items-center justify-content-center"
                                style="height: 200px;">
                                <i class="fas fa-image text-white" style="font-size: 3rem;"></i>
                            </div>
                        @endif

                        <div class="card-body">
                            <h5 class="card-title fw-bold text-dark">{{ $food->name }}</h5>
                            <p class="card-text text-secondary text-truncate">
                                {{ Str::limit($food->description, 50) }}</p>
                            <p class="fw-bold text-primary" style="font-size: 1.25rem;">
                                Rp. {{ number_format($food->price, 0, ',', '.') }}
                            </p>
                        </div>

                        <div class="card-footer bg-white border-top">
                            <div class="d-grid gap-2">
                                <a href="{{ route('food.edit', $food->id) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit me-1"></i> Edit
                                </a>
                            </div>
                            <form action="{{ route('food.destroy', $food->id) }}" method="POST" class="mt-2">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm w-100"
                                    onclick="return confirm('Yakin ingin menghapus makanan ini?')">
                                    <i class="fas fa-trash me-1"></i> Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="alert alert-info text-center py-4">
            <i class="fas fa-inbox" style="font-size: 2rem;"></i>
            <p class="mt-2">Belum ada data makanan. <a href="{{ route('food.create') }}">Tambah sekarang</a></p>
        </div>
    @endif
</div>

<style>
    .card:hover {
        transform: translateY(-5px) !important;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15) !important;
    }
</style>
@endsection