@include ('partials/html_scripts')
<body>

    @include('layout/shared_header')

    <div class="main-div-body">
        <div class="containerr">

            <div class="header-title">
                <h2>Edit Product</h2>
            </div>
            @if (isset($product) && !empty($product))
            <form action="/editData" method="post">
                @csrf 
                @method('PUT') <!-- Indicate this is an update -->
                <input type="hidden" name="id" value="{{ $product->id }}">
                <div class="containerr2">
                    <div class="row">
                        <label for="name">Name: </label>
                        <input name="name_product" id="name" type="text" class="input-div" value="{{ $product->name_product }}">
                    </div>
                    <div class="row">
                        <label for="Desc">Description: </label>
                        <textarea name="description_product" id="Desc" class="input-div">{{ $product->description_product }}</textarea>
                    </div>
                    <div class="row">
                        <label for="price">Price: </label>
                        <input name="price_product" id="price" type="number" class="input-div" value="{{ $product->price_product }}">
                    </div>
                    <div class="div-toggle">
                        <label for="check">Status:</label>
                        <div class="toggle">
                            <input type="checkbox" name="status_product" value="Available" id="check" {{ $product->status_product === 'Available' ? 'checked' : '' }}>
                            <label for="check" class="btnn"></label>
                        </div>
                    </div>
                    <input type="submit" value="Update" class="submit-class">
                </div>
            </form>

            @else
                <p>No product data available.</p>
            @endif
        </div>
    </div>

    @include ('layout/shared_footer')

</body>
@include ('partials/footer_scripts')
