<div id="search" >  
              <form class="form-wrapper cf" action="http://localhost/Herz/public/search/index">
                <div class="input-group">
                  <!-- Sökfältet -->
                  <div class="left-inner-addon ">
    <i class="icon-search"></i>
                  <input type="search" class="form-control" placeholder="Sök" name="search" value="Sök" onfocus="if(this.value  == 'Sök') { this.value = ''; } " onblur="if(this.value == '') { this.value = 'Sök'; } "> </div>
      
                  <button type="submit" value="Sök">Sök</button>
                  <div class="input-group-btn">
                                  <!-- Kategorier i sökfältet -->
                  <!-- gör php för att hämta ut kategorierna-->
                  <?PHP
                  $categories = DB::table('category')->orderBy('categoryname', 'asc')->get();
                  ?>
                  <div class="blabla">
                  <div class="test">
                  <select name="categoryID" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="kat">
                  <option selected="selected" disabled="disabled">Kategorier</option>                     @foreach($categories as $category)
                     
                  <option value="{{ $category->categoryID }}">{{$category->categoryname}}</option>
                 @endforeach
              
                </select></div>      
                </div><!-- /btn-group -->

              </div><!-- /input-group -->

            </form>
            </div>