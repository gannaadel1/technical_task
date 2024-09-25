


    
    <div class="container">


    <form method="POST" action="{{route('product.store')}}">
      @csrf
      <div class="card-body">

        <div class="form-group">
          <label for="exampleInputEmail1">Name</label>
          <input type="text" class="form-control" name = 'name' id="exampleInputEmail" placeholder="Enter Product Name">
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
@endsection
