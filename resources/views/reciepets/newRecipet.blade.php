@include ('partials/html_scripts')
<body data-success-message="{{ session('success') }}" data-ajax-url="{{ route('Recipets.data') }}">
    
    @include ('layout/shared_header') 
    

    <div class="main-div-body">
        <div class="containerr">

            <div class="header-title">
                <h2>Add New Recipet</h2>
            </div>
            <form action="/recipetWithSelect" method="post">
            @csrf 
                <div class="containerr2">
                    
                    <div class="row"><label for="name_recipets" >Name: </label><input name="name_recipets" id="name_recipets" type="text" class="input-div" required></div>
                        
                    <div class="row"><label for="description_recipets">Description: </label><textarea name="description_recipets" id="description_recipets" type="text" class="input-div"></textarea></div>
                        
                    <div class="row"><label for="quantity_recipets" >Quantity: </label><input name="quantity_recipets" id="quantity_recipets" type="number" class="input-div"></div>

                    <div class="row">
                        <label for="productSelect">
                            <select multiple="multiple" class="select2test" id="productSelect" name="productSelect[]" style="width: 230px !important; min-width: 50px; max-width: 250px;">
                                <option></option>
                            </select>
                        </label>
                    </div>

                    <div class="row"><label for="total_recipets" >Total: </label><input name="total_recipets" id="total_recipets" type="number" class="input-div"></div>
                    
                    <input type="submit" value="Submit" class="submit-class">

                </div>
            </form>
        </div>
    </div>
    
    @include ('layout/shared_footer') 
    
   
</body>
<script src="{{ '/recipets.js' }}"></script>
@include ('partials/footer_scripts') 