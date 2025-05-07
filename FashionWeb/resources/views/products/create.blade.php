<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Product</title>
</head>
<body>
    <h1>Create Product</h1>
    <form action="{{ route('products.store') }}" method="POST">
        @csrf
        <div>
            <label for="name">Product Name</label>
            <input type="text" name="name" id="name" required>
        </div>
        <div>
            <label for="description">Description</label>
            <textarea name="description" id="description"></textarea>
        </div>
        <div>
            <label for="price">Price</label>
            <input type="number" name="price" id="price" required>
        </div>
        <div>
            <label for="category">Category</label>
            <input type="text" name="category" id="category" required>
        </div>
        <div>
            <label for="color">Color</label>
            <input type="text" name="color" id="color" required>
        </div>
        <div>
            <label for="size">Size</label>
            <input type="text" name="size" id="size" required>
        </div>
        <div>
            <label for="stock">Stock</label>
            <input type="number" name="stock" id="stock" required>
        </div>
        <button type="submit">Create Product</button>
    </form>
</body>
</html>
