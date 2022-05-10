@if($collection->count() > 0)
  <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>No</th>
            <th>Nama User</th>
            <th>Alamat</th>
            <th>No Telepon</th>
            <th>Alamat</th>
            <th>Tergabung Sejak</th>
            <th>Edit Data</th>
            <th>Hapus Data</th>

          </tr>
        </thead>
        <tbody>
          @php
              $i = 1;
          @endphp
          @foreach ($collection as $i => $member)
          <tr>
            <td>{{$i+1}}</td>
            <td class="text-capitalize">{{$member->name}}</td>
            <td>{{$member->email}}</td>
            <td>{{$member->no_hp}}</td>
            <td>{{$member->alamat}}</td>
            <td>{{$member->created_at->diffForHumans()}}</td>
            <td>
              <a href="javascript:void(0)" onclick="handle_open_modal('{{route('office.member.edit',$member->id)}}','#memberModal','#contentMemberModal')"class="btn btn-success btn-icon-split btn-sm">
                  <span class="icon text-white-50">
                      <i class="fas fa-check"></i>
                  </span>
                  <span class="text">Ubah</span>
              </a>
            </td>
            <td>
              <a href="javascript:void(0);" onclick="handle_delete('{{route('office.member.destroy',$member->id)}}')" class="btn btn-danger btn-icon-split btn-sm">
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
