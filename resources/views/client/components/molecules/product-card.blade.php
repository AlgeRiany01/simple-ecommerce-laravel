<div class="col-md-3 col-6">
    <div class="card mb-0">
        <div class="card-content position-relative">
            @foreach ($image->take(1) as $item)
                <img src="{{ asset('shop/products/' . $item->path) }}" alt="" class="card-img-top img-fluid">
            @endforeach


            <div class="position-absolute top-0 end-0 m-2" style="z-index: 10;">
                @if (isset($productId) && $productId > 0 && isset(session('favorites')[$productId]))
                    <form method="POST" action="{{ route('favorites.remove', $productId) }}" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm"
                            style="background: rgba(255,255,255,0.9); border-radius: 50%; width: 40px; height: 40px; border: none;">
                            <i class="bi bi-heart-fill text-danger"></i>
                        </button>
                    </form>
                @elseif (isset($productId) && $productId > 0)
                    <form method="POST" action="{{ route('favorites.add', $productId) }}" style="display: inline;">
                        @csrf
                        <button type="submit" class="btn btn-sm"
                            style="background: rgba(255,255,255,0.9); border-radius: 50%; width: 40px; height: 40px; border: none;">
                            <i class="bi bi-heart text-muted"></i>
                        </button>
                    </form>
                @endif
            </div>

            <div class="card-body p-md-3 p-2">
                <p class="mb-0"><small>{!! str_replace('-', ' ', ucwords($category)) !!}</small></p>
                <p class="fw-bolder product-title mb-1">{!! str_replace('-', ' ', ucwords($title)) !!}</p>
                <p>$ {{ $price }}</p>
            </div>
        </div>
        <a href="{{ route('clientProductDetail', $title) }}" class="stretched-link"></a>
    </div>
</div>
