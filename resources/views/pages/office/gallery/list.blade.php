@if($collection->count() > 0)
    <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
            <tr>
            <th>No</th>
            <th>Foto</th>
            <th>Keterangan</th>
            <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($collection as $i => $galeri)
            <tr>
                    <td>{{$i+1}}</td>
                    <td><img src="{{$galeri->image}}" alt="galeri" style="max-width:200px;max-height:150px;"></td>
                    <td>{{$galeri->keterangan}}</td>
                    <td>
                        <a href="javascript:void(0)" onclick="load_input('{{route('office.galeri.edit',$galeri->id)}}')"class="btn btn-success btn-icon-split btn-sm">
                            <span class="icon text-white-50">
                                <i class="fas fa-check"></i>
                            </span>
                            <span class="text">Ubah</span>
                        </a>
                        <a href="javascript:void(0);" onclick="handle_delete('{{route('office.galeri.destroy',$galeri->id)}}')" class="btn btn-danger btn-icon-split btn-sm">
                            <span class="icon text-white-50">
                                <i class="fas fa-trash"></i>
                            </span>
                            <span class="text">Hapus</span>
                        </a>
                    </td>
            </tr>
            @endforeach
        </tbody>
        </table>
    </div>
    {{ $collection->links('vendor.pagination.bootstrap-4') }}
@else 
<div class="text-center px-4 mb-3">
  <h1>
    Data kosong
    <br>
  </h1>
  <img class="mw-100" src="{{asset('offices/img/terms-1.png')}}" style="max-height:300px;">
</div>
@endif