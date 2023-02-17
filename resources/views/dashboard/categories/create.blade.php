@extends('dashboard.layouts.main')

@section('container')

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Buat Kategori Baru</h1>
    </div>
    <div class="col-lg-8">
        {{-- method form dibawah akan langsung diarahkan ke method store di controller || enctype digunakan agar dapat upload 2 data yaiitu teks dan gambar --}}
        <form action="/dashboard/categories" method="POST" class="mb-5">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Nama Kategori</label>
                <input type="text" class="form-control @error('cat_name') is-invalid @enderror" id="cat_name" name="cat_name" autofocus value="{{ old('cat_name') }}">
                {{-- Pesan Error --}}
                @error('cat_name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="icon" class="form-label">Icon Kategori</label>
                <select class="form-select" name="icon_parent">
                    @foreach ($links as $link)    
                        {{-- <option value="{{ $link->code }}">{{ $link->nama }}</option> --}}
                        @if(old('icon_parent') === $link->code)  
                            <option selected value="{{ $link->code }}">{{ $link->nama }}</option>
                        @else
                            <<option value="{{ $link->code }}">{{ $link->nama }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="icon" class="form-label">Icon Sub-Kategori</label>
                <select class="form-select" name="icon_child">
                    @foreach ($links as $link)    
                        {{-- <option value="{{ $link->code }}">{{ $link->nama }}</option> --}}
                        @if(old('icon_child') === $link->code)  
                            <option selected value="{{ $link->code }}">{{ $link->nama }}</option>
                        @else
                            <<option value="{{ $link->code }}">{{ $link->nama }}</option>
                        @endif
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Create Category</button>
        </form>
    </div>
@endsection

