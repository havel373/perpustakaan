<x-OfficeLayout title="Data Admin">
    <div id="content_list">
        <!-- Begin Page Content -->
        <div class="container-fluid">
            <!-- Page Heading -->
            <h1 class="h3 mb-2 text-gray-800">Data Admin</h1>
            <p class="mb-4">Berikut merupakan data admin perpustakaan Lumban Dolok</p>
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Data Admin 2.0</h6>
                </div>
                <div class="card-body">
                    <a href="javascript:void(0);" onclick="load_input('{{route('office.admin.create')}}')" class="btn mb-3 btn-primary btn-icon-split btn-sm" >
                        <span class="icon text-white-50">
                            <i class="fas fa-check"></i>
                        </span>
                        <span class="text">Tambah Data Admin</span>
                    </a>
                    <div id="list_result"></div>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </div>
    <div id="content_input"></div>
        <!-- End of Main Content -->
    </div>
    @section('custom_js')
        <script type="text/javascript">
            $(function() {
                load_list(1);
            });
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