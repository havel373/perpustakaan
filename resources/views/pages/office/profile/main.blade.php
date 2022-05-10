<x-OfficeLayout title="Data Admin">
    <div class="table-responsive">
        <div class="container-fluid">
            <!-- Page Heading -->
            <h1 class="h3 mb-2 text-gray-800">Data Profil</h1>
            <p class="mb-4">Berikut merupakan data profil anda</p>
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Data Profil 2.0</h6>
                </div>
                <div class="card-body">  
                    <div class="text-center px-4 mb-3">
                        <form class="form-group" id="form_input">
                            <div class="form-group">
                                <label for="name" class="labeled-form">Nama</label>
                                <input id="name" type="text" class="form-control form-control-user " name="name" 
                                value="{{$profile->name}}" 
                                autocomplete="name" autofocus placeholder="Nama Anda...">
                            </div>
                            <div class="form-group">
                                <label for="name" class="labeled-form">Alamat</label>
                                <textarea name="alamat" id="alamat"  class="form-control form-control-user" cols="20" rows="3" >{{$profile->alamat}}</textarea>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <label for="name" class="labeled-form">Email</label>
                                    <input id="email" type="email" class="form-control form-control-user"  name="email" 
                                    value="{{$profile->email}}" 
                                    autocomplete="email" placeholder="Email...">
                                </div>
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <label for="name" class="labeled-form">No Telpon</label>
                                    <input id="no_telp" type="text" class="form-control form-control-user " name="no_hp" value="{{$profile->no_hp}}" autocomplete="no_hp" placeholder="No Telepon...">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6">
                                    <label for="name" class="labeled-form">Password</label>
                                    <input type="password" name="password" id="password" class="form-control form-control-user" placeholder="Password ...">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" id="tombol_simpan" onclick="handle_save('#tombol_simpan','#form_input','{{route('office.admin.store')}}','POST')" class="btn btn-primary">Simpan Perubahan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @section('custom_js')
        <script type="text/javascript">
            $(document).ready(function(){
                $(document).on('click', '.page-link', function(event){
                    event.preventDefault(); 
                    var page = $(this).attr('href').split('page=')[1];
                    fetch_data(page);
                });

                function fetch_data(page)
                {
                    $.ajax({
                    url:"?page="+page,
                    success:function(data){
                        $('#list_result').html(data);
                    }
                    });
                }
            });
        </script>
    @endsection
    @section('custom_css')
    <style>
        .labeled-form{
            float: left;
            display: inline;
            color:black;
            border: 5px black
        }
    </style>    
@endsection
</x-OfficeLayout>