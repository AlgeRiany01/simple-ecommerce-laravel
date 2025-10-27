<x-template.layout title="{{ $title }}">
    <x-organisms.navbar cartCount=10 :path="$shop->path" />

    <section class="section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1 class="text-center pb-5">My Favorites</h1>

                    @if ($products->count() > 0)
                        <div class="row">
                            @foreach ($products as $product)
                                <div class="col-md-3 col-6 mb-4">
                                    <div class="card mb-0">
                                        <div class="card-content position-relative">
                                            @foreach ($product->productImage->take(1) as $item)
                                                <img src="{{ asset('shop/products/' . $item->path) }}" alt=""
                                                    class="card-img-top img-fluid">
                                            @endforeach

                                            <div class="card-body p-md-3 p-2">
                                                <p class="mb-0"><small>{!! str_replace('-', ' ', ucwords($product->category->name)) !!}</small></p>
                                                <p class="fw-bolder product-title mb-1">{!! str_replace('-', ' ', ucwords($product->title)) !!}</p>
                                                <p>$ {{ $product->price }}</p>

                                                <div class="d-flex justify-content-between align-items-center">
                                                    <a href="{{ route('clientProductDetail', $product->title) }}"
                                                        class="btn btn-outline-primary btn-sm">View Details</a>
                                                    <form method="POST"
                                                        action="{{ route('favorites.remove', $product->id) }}"
                                                        style="display: inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm ">
                                                             Remove
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="bi bi-heart" style="font-size: 4rem; color: #ccc;"></i>
                            <h3 class="mt-3 text-muted">No favorites yet</h3>
                            <p class="text-muted">Start adding products to your favorites!</p>
                            <a href="{{ route('clientProducts') }}" class="btn btn-primary">Browse Products</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <x-organisms.footer :shop="$shop" />
</x-template.layout>
