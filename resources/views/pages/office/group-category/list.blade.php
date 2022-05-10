@if($collection->count() > 0)
<div class="row">
    @foreach ($collection as $kategori)
        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Kategori {{$kategori->nama_kategori}}</div>
                @php
                    $i = 1;
                @endphp
                <div class="h5 mb-0 font-weight-bold text-gray-800">{{$buku = \App\Models\Book::where('kategori_id', '=', $kategori->id)->count()}} Buku</div>
                @php
                $i++
                @endphp
                <a href="{{route('office.books.index',$kategori->id)}}" class="mt-3 btn btn-secondary btn-sm btn-icon-split">
                    <span class="icon text-white-50">
                        <i class="fas fa-arrow-right"></i>
                    </span>
                <span class="text">Lihat Detail</span>
                </a>
                </div>
                <div class="col-auto">
                    <i class="fas fa-calendar fa-2x text-gray-300"></i>
                </div>
                </div>
            </div>
            </div>
        </div> 
        {{-- end card --}}
        @endforeach
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
