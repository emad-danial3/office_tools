
<html>
<head>
    <style>
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td, th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }
    </style>
</head>
<body>
{{--<img style='width:20%;' src='http://nettinghub.com/logo.png' alt='Italian Trulli'>--}}
<br>
<br>
<h1 style='color:rgb(0, 148, 167);  text-align: center;'>Dear {!! $data['manager_name'] !!} </h1>
<h1 style='color:rgb(0, 148, 167);  text-align: center;'> {!! $data['title'] !!} </h1>
<h1 style='color:rgb(0, 148, 167);  text-align: center;'> {!! $data['title2'] !!} </h1>

<br>
<br>

<table>
    <tr>
        <th>ID</th>
        <th>Product</th>
        <th>Quantity</th>
    </tr>

    @if(isset($data['body'])&&count($data['body'])>0)
        @foreach($data['body'] as $key=>$product)
            @if(!empty($product)&&isset($product))
            <tr>
                <th scope="row">{{$product['id']}}</th>
                <td>{{$product['name']}}</td>
                <td>{{$product['quantity']}}</td>
            </tr>
            @endif
        @endforeach
    @endif

</table>


<br>
<br>
<br>
<h1>Please Visit this order And Approve It</h1>
<a href="http://localhost:8000/visitOrder/{{$data['hash_code']}}">Visit</a>

<br>
<br>
<br>

</body>
</html>
