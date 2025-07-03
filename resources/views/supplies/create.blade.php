<!DOCTYPE html>
<html>
<head>
    <title>Add Supply</title>
</head>
<body>
    <h2>Add New Supply</h2>
    <form action="{{ route('supplies.store') }}" method="POST">
        @csrf
        <label>Supplier:</label>
        <select name="supplier_id">
            @foreach($suppliers as $supplier)
                <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
            @endforeach
        </select><br><br>

        <label>Coffee:</label>
        <select name="coffee_id">
            @foreach($coffees as $coffee)
                <option value="{{ $coffee->id }}">{{ $coffee->type }}</option>
            @endforeach
        </select><br><br>

        <label>Quantity:</label>
        <input type="number" name="quantity"><br><br>

        <label>Date Supplied:</label>
        <input type="date" name="supplied_on"><br><br>

        <button type="submit">Save Supply</button>
    </form>
</body>
</html>