@extends('dashboard.layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Daftar Data Peta</h1>
        <a href="/dashboard/maps/create" class="btn btn-primary">Create new map</a>
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
              <th scope="col">Nama Tempat</th>
              <th scope="col">Nama Sub-Kategori</th>
              <th scope="col">Alamat</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($maps as $map)
            <tr>
              {{-- sintaks untuk ngambil nomor berdasar loop --}}
              <td>{{ $loop->iteration }}</td>
              <td>{{ $map->map_title }}</td>
              <td>{{ $map->catchild_name }}</td>
              <td>{{ $map->map_address }}</td>
              <td>
                <a href="/dashboard/maps/{{ $map->id }}/edit" class="badge bg-warning"><span data-feather="edit"></span></a>
                <button class="badge bg-danger border-0" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $map->id }}"><span data-feather="x-circle"></span></button>
                <!-- Modal -->
                <div class="modal fade" id="exampleModal{{ $map->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Lokasi</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Yakin akan menghapus data lokasi?
                        </div>
                        <div class="modal-footer">
                            <form action="/dashboard/maps/{{ $map->id }}" method="POST" class="d-inline">
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