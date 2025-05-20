<!DOCTYPE html>
<html lang="en">
<head>
    <title>List of Products</title>
    <style>
        body {
            margin: 20px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #ffffff; /* putih */
            color: #222222; /* teks gelap */
        }

        h1, h3 {
            font-weight: 600;
            color: #111111;
            margin-bottom: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #121212; /* hitam gelap tabel */
            color: #e0e0e0;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 10px rgb(0 0 0 / 0.15);
        }

        thead tr {
            background-color: #000000;
            text-align: left;
        }

        th, td {
            padding: 12px 16px;
            border-bottom: 1px solid #333333;
        }

        tbody tr:hover {
            background-color: #222222;
        }

        a {
            color: #4ade80; /* teal */
            text-decoration: none;
            margin-right: 10px;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        a:hover {
            color: #22c55e;
        }

        form {
            display: inline;
        }

        button {
            background-color: #000000; /* hitam tombol */
            border: none;
            color: white;
            padding: 6px 12px;
            border-radius: 5px;
            cursor: pointer;
            font-weight: 600;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #222222;
        }

        p {
            color: #22c55e;
            font-weight: 600;
            margin: 8px 0 0 0;
            font-size: 0.9rem;
        }

        ul {
            background-color: #f9fafb; /* putih abu-abu sangat terang */
            padding: 15px 20px;
            border-radius: 8px;
            box-shadow: 0 0 8px rgba(0,0,0,0.1);
            list-style-type: none;
            margin-top: 0;
            margin-bottom: 24px;
            color: #111111;
        }

        ul li {
            padding: 8px 0;
            border-bottom: 1px solid #e5e7eb;
        }

        ul li:last-child {
            border-bottom: none;
        }

        p b {
            color: #555555;
        }
        
        #judul {
            text-align: center;
        }
    </style>
</head>
<body>
    <h1 id='judul'>List of Products</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Price</th>
                <th>Stock</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($products as $product)
            <tr>
                <td>{{$product->id}}</td>
                <td>{{$product->name}}</td>
                <td>{{ number_format($product->price) }}</td>
                <td>{{$product->stock}}</td>
                <td>
                    <a href="{{ url('/products', $product->id) }}">View</a>
                    <a href="{{ url('/products/create') }}">+ Add Product</a>
                    @if (session('success'))
                        <p>{{session('success')}}</p>
                    @endif
                    <a href="{{ url('/products'. '/' .$product->id.'/edit') }}">Edit</a>
                    <form action="{{ url('/products', $product->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>                    
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <h3>Expensive Products (Price &gt; 1M)</h3>
    <ul>
        @foreach ($expensiveProducts as $product)
            <li>{{ $product->name }} - Price: {{ number_format($product->price) }}</li>
        @endforeach
    </ul>

    <h3>Statistics</h3>
    <p><b>Average Price:</b> {{ number_format($averagePrice, 2) }}</p>

</body>
</html>
