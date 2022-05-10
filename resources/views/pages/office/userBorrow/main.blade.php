<x-OfficeLayout title="Data Peminjaman">
    <div id="content_list">
        <!-- Begin Page Content -->
        <div class="container-fluid">
            <!-- Page Heading -->
            <h1 class="h3 mb-2 text-gray-800">Data Peminjaman Pengguna</h1>
            <p class="mb-4">Berikut merupakan data peminjaman buku perpustakaan Lumban Dolok</p>
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Manajemen Peminjaman 1.0.1</h6>
                    <a class="btn {{request()->is('office/borrow/index') ? 'btn-primary' : 'btn-secondary'}} mb-3 btn-icon-split btn-md text-white" href="{{route('office.borrow.index')}}">
                        <span class="icon">
                            @if(request()->is('office/borrow/index'))
                            <i class="fas fa-check"></i>
                            @endif
                        </span>
                        <span class="text">Admin</span>
                    </a>
                    <a class="btn {{request()->is('office/user-borrow/index') ? 'btn-primary' : 'btn-secondary'}} mb-3 btn-icon-split btn-md text-white" href="{{route('office.user-borrow.index')}}">
                       <span class="icon text-white-50">
                           @if(request()->is('office/user-borrow/index'))
                            <i class="fas fa-check"></i>
                            @endif
                        </span>
                         <span class="text">Peminjam</span>
                    </a>
                </div>
                <div class="card-body">
                    <div id="list_result"></div>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </div>
    <div id="content_input"></div>
    @section('custom_js')
        <script type="text/javascript">
            load_list(1);
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
            $(".insert-books").select2();
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