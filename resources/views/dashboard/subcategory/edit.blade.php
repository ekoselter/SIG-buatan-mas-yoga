@extends('dashboard.layouts.main')

@section('container')

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Edit Sub Kategori</h1>
    </div>
    <div class="col-lg-8">
        {{-- method form dibawah akan langsung diarahkan ke method store di controller || enctype digunakan agar dapat upload 2 data yaiitu teks dan gambar --}}
        <form action="/dashboard/categoryChildren/{{ $child_cat->id }}" method="POST" class="mb-5" enctype="multipart/form-data" >
            @method('put')
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Nama Sub-Kategori</label>
                <input type="text" class="form-control @error('catchild_name') is-invalid @enderror" id="catchild_name" name="catchild_name" autofocus value="{{ old('catchild_name', $child_cat->catchild_name) }}">
                {{-- Pesan Error --}}
                @error('catchild_name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            
            <div class="mb-3">
                <label for="icon" class="form-label">Kategori</label>
                <select class="form-select" name="parent_id">
                    @foreach ($categories as $category)
                        @if(old('parent_id', $child_cat->parent_id) == $category->id)  
                            <option selected value="{{ $category->id }}">{{ $category->cat_name }}</option>
                        @else
                            <option value="{{ $category->id }}">{{ $category->cat_name }}</option>
                        @endif
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Upload Icon</label>
                <input type="hidden" name="oldImage" value="{{ $child_cat->icon_mark }}">
                @if ($child_cat->icon_mark)
                    <img src="{{ asset('storage/' . $child_cat->icon_mark) }}" class="img-preview img-fluid mb-3 col-sm-5 d-block"> 
                @else
                    <img class="img-preview img-fluid mb-3 col-sm-5">
                @endif
                <input class="form-control @error('icon_mark') is-invalid @enderror" type="file" id="icon_mark" name="icon_mark" onchange="previewImage()">
                {{-- Pesan Error --}}
                @error('icon_mark')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Update Sub-Category</button>
        
        </form>
    </div>
    <script>
        function previewImage(){
            const image = document.querySelector('#icon_mark');
            const imgPreview = document.querySelector('.img-preview');

            imgPreview.style.display = 'block';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);

            oFReader.onload = function(oFREvent) {
                imgPreview.src = oFREvent.target.result;
            }
        }
    </script>
@endsection

