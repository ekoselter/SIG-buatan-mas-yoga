@extends('dashboard.layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Daftar Sub-Kategori</h1>
        <a href="/dashboard/categoryChildren/create" class="btn btn-primary">Create new sub-category</a>
    </div>

    @if (session()->has('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      {{ session('success') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="container">
        <table class="table table-striped table-bordered table-paginate" cellspacing="0" width="100%">
          <thead>
            <tr>
              <th scope="col">No.</th>
              <th scope="col">Nama Sub-Kategori</th>
              <th scope="col">Nama Kategori</th>
              <th scope="col"> Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($child_cats as $categoryChild)
            <tr>
              {{-- sintaks untuk ngambil nomor berdasar loop --}}
              <td>{{ $loop->iteration }}</td>
              <td>{{ $categoryChild->catchild_name }}</td>
              <td>{{ $categoryChild->cat_name }}</td>
              <td>
                <a href="/dashboard/categoryChildren/{{ $categoryChild->id }}/edit" class="badge bg-warning"><span data-feather="edit"></span></a>
                <button class="badge bg-danger border-0" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $categoryChild->id }}"><span data-feather="x-circle"></span></button>
                <!-- Modal -->
                <div class="modal fade" id="exampleModal{{ $categoryChild->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Sub-Category</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Yakin akan menghapus data sub-category?
                        </div>
                        <div class="modal-footer">
                            <form action="/dashboard/categoryChildren/{{ $categoryChild->id }}" method="POST" class="d-inline">
                              @method('delete')
                              @csrf
                              <button type="submit" class="btn btn-danger">Delete</button>  
                            </form>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        </div>
                      </div>
                  </div>
                </div>
              </td>
            </tr> 
            @endforeach
          </tbody>
        </table>
      </div>

@endsection