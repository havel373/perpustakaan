@if($collection->count() > 0)
    <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
            <tr>
            <th>No</th>
            <th>Nama Karyawan</th>
            <th>Email</th>
            <th>No Telp</th>
            <th>Role</th>
            <th>Bergabung Pada</th>
            <th>Edit Data</th>
            <th>Hapus Data</th>
            </tr>
        </thead>
        <tbody>
            @php
                $i = 1;
            @endphp
            @foreach ($collection as $i => $user)
            <tr>
                @if($user->name == Auth::user()->name)
                    <td><b>{{$i+1}}</b></td>
                    <td class="text-capitalize"> <b>{{$user->name}}</b></td>
                    <td><b>{{$user->email}}</b></td>
                    <td><b>{{$user->no_hp}}</b></td>
                    <td><b>{{$user->role}}</b></td>
                    <td><b>{{$user->created_at->isoFormat('dddd, D MMMM Y')}}</b></td>
                    <td></td>
                    <td></td>
                    @else
                    <td>{{$i+1}}</td>
                    <td class="text-capitalize">{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->no_hp}}</td>
                    <td>{{$user->role}}</td>
                    <td>{{$user->created_at->isoFormat('dddd, D MMMM Y')}}</td>
                    <td>
                        @if($user->role == 'admin')
                            <a href="javascript:void(0)" onclick="load_input('{{route('office.admin.edit',$user->id)}}')"class="btn btn-success btn-icon-split btn-sm">
                                <span class="icon text-white-50">
                                    <i class="fas fa-check"></i>
                                </span>
                                <span class="text">Ubah</span>
                            </a>
                        @endif
                      </td>
                      <td>
                        @if($user->role == 'admin')
                            <a href="javascript:void(0);" onclick="handle_delete('{{route('office.member.destroy',$user->id)}}')" class="btn btn-danger btn-icon-split btn-sm">
                                <span class="icon text-white-50">
                                    <i class="fas fa-trash"></i>
                                </span>
                                <span class="text">Hapus</span>
                            </a>
                            @endif
                    </td>
                @endif
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