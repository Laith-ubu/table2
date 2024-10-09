@include('partials/html_scripts')

<body data-success-message="{{ session('success') }}" data-ajax-url="{{ route('products.data') }}">
    @include('layout/shared_header')

    <div class="container-body">
        <div class="main-table-div">
            <div class="content-div">
                <div class="table-title-div">
                    <h2>Products</h2>
                </div>
                <div class="button-table-div">
                    <button type="button"><a style="text-decoration: none; color: white;" href="/productNewItem">Add New</a></button>
                </div>
            </div>

            <div class="table-div">
            <table id="productsTable" class="table table-striped " class="TABLE">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
           </div>
        </div>
    </div>


    @include('layout/shared_footer')
</body>

<script>
    const message = @json(session('success'));
    console.log(message);
</script>
<script src="{{ '/products.js' }}"></script>

@include('partials/footer_scripts')
