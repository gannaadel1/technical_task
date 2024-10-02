


    <h1>Edit Product</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.products.update', $product->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" name="name" value="{{ $product->name }}" required>
        </div>

        <div class="form-group">
            <label for="price">Price</label>
            <input type="text" class="form-control" name="price" value="{{ $product->price }}" required>
        </div>

        <div class="form-group">
            <label for="quantity">Quantity</label>
            <input type="text" class="form-control" name="quantity" value="{{ $product->quantity }}" required>
        </div>

        <div class="form-group">
            <label for="quantity">Categry</label>
            <input type="text" class="form-control" name="category" value="{{ $product->category }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Update Product</button>
    </form>

