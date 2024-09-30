@include ('html_scripts')
<body>
    
    @include ('shared_header') 
    

    <div class="main-div-body">
        <div class="containerr">

            <div class="header-title">
                <h2>Add New Product</h2>
            </div>
            <form action="/newData" method="post">
            @csrf 
                <div class="containerr2">
                    
                    <div class="row"><label for="name" >Name: </label><input name="name_product" id="name_product" type="text" class="input-div" required></div>
                        
                    <div class="row"><label for="Desc">Description: </label><textarea name="description_product" id="description_product" type="text" class="input-div"></textarea></div>
                        
                    <div class="row"><label for="price" >Price: </label><input name="price_product" id="price_product" type="number" class="input-div"></div>

                    <div class="div-toggle">
                        <label for="check">Status: </label>
                            <div class="toggle">  
                                
                                <input type="checkbox" name="status_product" value="Available" id="check"> 
                                <label for="check" class="btnn"></label>
                                
                            </div>
                    </div>
                    
                    <input type="submit" value="Submit" class="submit-class">

                </div>
            </form>
        </div>
    </div>
    
    @include ('shared_footer') 
    
   
</body>
@include ('footer_scripts') 