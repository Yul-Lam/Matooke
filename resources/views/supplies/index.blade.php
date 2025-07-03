<!DOCTYPE html>
<html>
<head>
    <title>Supplies</title>
</head>
<body>
    <h2>Supply List</h2>

    @if($supplies->count())
        <table border="1">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Quantity</th>
                    <th>Supplied On</th>
                </tr>
            </thead>
            <tbody>
                @foreach($supplies as $supply)
                    <tr>
                        <td>{{ $supply->id }}</td>
                        <td>{{ $supply->quantity }}</td>
                        <td>{{ $supply->supplied_on }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No supply records found.</p>
    @endif
</body>
</html>