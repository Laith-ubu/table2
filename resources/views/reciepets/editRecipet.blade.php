@include ('partials/html_scripts')
<body>

    @include('layout/shared_header')

    <div class="main-div-body">
        <div class="containerr">

            <div class="header-title">
                <h2>Edit Reciepets</h2>
            </div>
            @if (isset($product) && !empty($product))
                <form action="{{ route('recipet.editOrUpdate', ['id' => $product->id]) }}" method="POST">
                    @csrf
                    <input type="hidden" name="id" value="{{ $product->id }}">
                    <div class="containerr2">

                        <div class="row">
                            <label for="name_recipets">Name: </label>
                            <input name="name_recipets" id="name_recipets" type="text" class="input-div" value="{{ $product->name_recipets }}">
                        </div>

                        <div class="row">
                            <label for="description_recipets">Description: </label>
                            <textarea name="description_recipets" id="description_recipets" class="input-div">{{ $product->description_recipets }}</textarea>
                        </div>

                        <div class="row">
                            <label for="quantity_recipets">Quantity: </label>
                            <input name="quantity_recipets" id="quantity_recipets" type="number" class="input-div" value="{{ $product->quantity_recipets }}">
                        </div>

                        <div class="row">
                            <label for="editProductSelect">
                                <select multiple="multiple" class="select2test" id="editProductSelect" name="productSelect[]" style="width: 230px !important; ">
                                    <option  ></option>
                                    @foreach($allProducts as $productOption)
                                        <option value="{{ $productOption->id }}" 
                                            {{ $linkedProductIds->contains($productOption->id) ? 'selected' : '' }}>
                                            {{ $productOption->name_product }}
                                        </option>
                                    @endforeach
                                </select>
                            </label>
                        </div>

                        <div class="row">
                            <label for="total_recipets">Total: </label>
                            <input name="total_recipets" id="total_recipets" type="number" class="input-div" value="{{ $product->total_recipets }}">
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
<script>
    const message = @json(session('success'));
    console.log(message);
</script>
<script src="{{ '/recipets.js' }}"></script>

@include ('partials/footer_scripts')
