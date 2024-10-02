


    
    <div class="container">


    <form method="POST" action="{{route('product.store')}}">
      @csrf
      <div class="card-body">

        <div class="form-group">
          <label for="exampleInputEmail1">Name</label>
          <input type="text" class="form-control" name = 'name' id="exampleInputEmail" placeholder="Enter Product Name">
        </div>

        <div class="form-group">
          <label for="exampleInputEmail1">price</label>
          <input type="text" class="form-control" name = 'price' id="exampleInputEmail" placeholder="Enter Product price">
        </div>

        <div class="form-group">
          <label for="exampleInputEmail1">quantity</label>
          <input type="text" class="form-control" name = 'quantity' id="exampleInputEmail" placeholder="Enter Product quantity">
        </div>

        <div class="form-group">
          <label for="exampleInputEmail1">category id</label>
          <input type="text" class="form-control" name = 'category_id' id="exampleInputEmail" placeholder="Enter Product category">
        </div>

        

        <div class="form-group">

      </div>
      <!-- /.card-body -->

      <div class="card-footer">
        <button type="submit" class="btn btn-success">Add</button>
      </div>
    </form>

  </div>
</div>

