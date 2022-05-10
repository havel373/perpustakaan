<div class="modal-header">
    <h5 class="modal-title" id="employeeModal">Masukan Data Pustakawan</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  <div class="modal-body">
    <form class="user" id="form_input">
            <div class="form-group">
               <input id="name" type="text" class="form-control form-control-user " name="name" value="{{$employee->name}}" autocomplete="name" autofocus placeholder="Nama Pustakawan...">
            </div>
            <div class="form-group">
              <input id="alamat" type="text" class="form-control form-control-user"  name="alamat" value="{{$employee->alamat}}" autocomplete="alamat" placeholder="Alamat Tinggal...">
            </div>
            <div class="form-group">
              <input id="email" type="email" class="form-control form-control-user"  name="email" value="{{$employee->email}}" autocomplete="email" placeholder="Email...">
            </div>
            <div class="form-group row">
              <div class="col-sm-6 mb-3 mb-sm-0">
                 <input id="no_telp" type="text" class="form-control form-control-user " name="no_hp" value="{{$employee->no_hp}}" autocomplete="no_hp" placeholder="No Telepon...">
              </div>
              @if(!$employee->id)
              <div class="col-sm-6">
                 {{-- <input id="tgl_lahir" type="text" class="form-control form-control-user" onfocus="(this.type='date')" onblur="(this.type='text')" name="tgl_lahir" autocomplete="tgl_lahir" placeholder="Tanggal Lahir..."> --}}
                <input type="password" name="password" id="password" class="form-control form-control-user" placeholder="Password ...">
              </div>
              @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                @if($employee->id)
                  <button type="submit" id="tombol_simpan" onclick="save_form_modal('#tombol_simpan','#form_input','{{route('office.employee.update',$employee->id)}}','#employeeModal','PATCH')" class="btn btn-primary">Simpan Perubahan</button>
                @else
                  <button type="submit" id="tombol_simpan" onclick="save_form_modal('#tombol_simpan','#form_input','{{route('office.employee.store')}}','#employeeModal','POST')" class="btn btn-primary">Simpan</button>
                @endif
            </div>
      </form>
  </div>