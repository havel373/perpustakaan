<div class="modal-header">
    <h5 class="modal-title" id="memberModal">Masukan Data Anggota</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  <div class="modal-body">
    <form class="user" id="form_input">
            <div class="form-group">
               <input id="name" type="text" class="form-control form-control-user " name="name" value="{{$member->name}}" autocomplete="name" autofocus placeholder="Nama Anggota...">
            </div>
            <div class="form-group">
              <input id="alamat" type="text" class="form-control form-control-user"  name="alamat" value="{{$member->alamat}}" autocomplete="alamat" placeholder="Alamat Tinggal...">
            </div>
            <div class="form-group">
              <input id="email" type="email" class="form-control form-control-user"  name="email" value="{{$member->email}}" autocomplete="email" placeholder="Email...">
            </div>
            <div class="form-group row">
              <div class="col-sm-6 mb-3 mb-sm-0">
                 <input id="no_telp" type="text" class="form-control form-control-user " name="no_hp" value="{{$member->no_hp}}" autocomplete="no_hp" placeholder="No Telepon...">
              </div>
              @if(!$member->id)
              <div class="col-sm-6">
                 {{-- <input id="tgl_lahir" type="text" class="form-control form-control-user" onfocus="(this.type='date')" onblur="(this.type='text')" name="tgl_lahir" autocomplete="tgl_lahir" placeholder="Tanggal Lahir..."> --}}
                <input type="password" name="password" id="password" class="form-control form-control-user" placeholder="Password ...">
              </div>
              @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                @if($member->id)
                  <button type="submit" id="tombol_simpan" onclick="save_form_modal('#tombol_simpan','#form_input','{{route('office.member.update',$member->id)}}','#memberModal','PATCH')" class="btn btn-primary">Simpan Perubahan</button>
                @else
                  <button type="submit" id="tombol_simpan" onclick="save_form_modal('#tombol_simpan','#form_input','{{route('office.member.store')}}','#memberModal','POST')" class="btn btn-primary">Simpan</button>
                @endif
            </div>
      </form>
  </div>