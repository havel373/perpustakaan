@if($collection->count() > 0)
    <div class="table-responsive">
        <table class="table table-bordered" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>No</th>
              <th>Sampul Buku</th>
              <th>Judul Buku</th>
              <th>Nama Pengarang</th>
              <th>Nama Penerbit</th>
              <th>Jumlah Halaman</th>
              <th>Tahun Terbit</th>
              <th>Edisi Buku</th>
              <th>Jumlah Buku</th>
              <th>Diinput Pada</th>
              <th>Diinput Oleh</th>
              <th>Ubah</th>
              <th>Hapus</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($collection as $i => $book)
              <tr>
                <td>{{$i+1}}</td>
                <td><img 
                  src="{{$book->image}}" 
                  {{-- src="{{$book->foto}}"  --}}
                  style="max-width:200px;max-height:200px;"></td>
                <td>{{$book->judul}}</td>
                <td>{{$book->pengarang}}</td>
                <th>{{$book->penerbit}}</th>
                <td>{{$book->jumlah_halaman}}</td>
                <td>{{$book->tahun_terbit}}</td>
                <td>{{$book->edisi_buku}}</td>
                <td>{{$book->jumlah_buku}}</td>
                
                <td>{{date("Y-m-d", strtotime($book->created_at))}}</td>
                <td>{{$book->user->name}}</td>
                <td>
                  <a href="javascript:void(0);" onclick="handle_open_modal('{{route('office.books.edit',$book->id)}}','#bookModal','#contentBookModal');" class="btn btn-success btn-icon-split btn-sm">
                    <span class="icon text-white-50">
                            <i class="fas fa-check"></i>
                    </span>
                    <span class="text">Ubah</span>
                  </a>
                </td>
                <td>
                  <a href="javascript:void(0);" onclick="handle_delete('{{route('office.books.destroy',$book->id)}}')" type="submit" class="btn btn-danger btn-icon-split btn-sm">
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