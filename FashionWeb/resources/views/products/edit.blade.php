<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Product</title>
</head>
<body>
    <h1>Edit Product</h1>
    <form action="{{ route('products.update', $product->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div>
            <label for="name">Product Name</label>
            <input type="text" name="name" id="name" value="{{ $product->name }}" required>
        </div>
        <div>
            <label for="description">Description</label>
            <textarea name="description" id="description">{{ $product->description }}</textarea>
        </div>
        <div>
            <label for="price">Price</label>
            <input type="number" name="price" id="price" value="{{ $product->price }}" required>
        </div>
        <div>
            <label for="category">Category</label>
            <input type="text" name="category" id="category" value="{{ $product->category }}" required>
        </div>
        <div>
            <label for="color">Color</label>
            <input type="text" name="color" id="color" value="{{ $product->color }}" required>
        </div>
        <div>
            <label for="size">Size</label>
            <input type="text" name="size" id="size" value="{{ $product->size }}" required>
        </div>
        <div>
            <label for="stock">Stock</label>
            <input type="number" name="stock" id="stock" value="{{ $product->stock }}" required>
        </div>
        <button type="submit">Update Product</button>
    </form>
</body>
</html>
