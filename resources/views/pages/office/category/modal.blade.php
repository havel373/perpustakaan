<div class="modal-header">
    <h5 class="modal-title" id="bookModal">Masukan Data Kategori</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <form class="user" id="form_input">
        <div class="form-group">
            <input id="name" type="text" class="form-control form-control-user " name="nama" value="{{$bookCategory->nama_kategori }}" required autocomplete="name" autofocus placeholder="Nama Kategori...">
        </div>
        <div class="form-group">
        <input id="deskripsi" type="text" class="form-control form-control-user"  name="deskripsi" value="{{$bookCategory->deskripsi }}" required autocomplete="deskripsi" placeholder="Deskripsi Kategori...">
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            @if($bookCategory->id)
                <button type="button" id="tombol_simpan" onclick="save_form_modal('#tombol_simpan','#form_input','{{route('office.book-category.update',$bookCategory->id)}}','#bookModal','PATCH')" class="btn btn-primary">Simpan Perubahan</button>
            @else
                <button type="button" id="tombol_simpan" onclick="save_form_modal('#tombol_simpan','#form_input','{{route('office.book-category.store')}}','#memberModal','POST')" class="btn btn-primary">Simpan</button>
            @endif
        </div>
    </form>
</div>