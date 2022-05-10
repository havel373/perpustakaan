@if($collection->count() > 0)
  <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>No</th>
            <th>Nama Kategori</th>
            <th>Deskripsi Kategori</th>
            <th>Dibuat Sejak</th>
            <th>Edit Data</th>
            <th>Hapus Data</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($collection as $i => $kategori)
          <tr>
              <td>{{$i+1}}</td>
              <td>{{$kategori->nama_kategori}}</td>
              <td>{{$kategori->deskripsi}}</td>
              <td>{{$kategori->created_at->diffForHumans()}}</td>
              <td>
              <a href="javascript:void(0)" onclick="handle_open_modal('{{route('office.book-category.edit',$kategori->id)}}','#bookModal','#contentBookModal')" class="btn btn-success btn-icon-split btn-sm">
                      <span class="icon text-white-50">
                          <i class="fas fa-check"></i>
                      </span>
                      <span class="text">Ubah</span>
                  </a>
            </td>
            <td>
              <a href="javascript:void(0);" onclick="handle_delete('{{route('office.book-category.destroy',$kategori->id)}}')" class=" btn btn-danger btn-icon-split btn-sm">
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