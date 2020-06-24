<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        body {
            background: inherit;
            font-size: 12px;
        },
        
        h1 {
             margin: 0px 0 0px 0;
             letter-spacing: 2.5px; 
             font-family: sans-serif;
             font-size: 25px;
             color: #CE8F64;
        }
        
        h6 {
             margin: 0px 0 0px 0;
             letter-spacing: 0px;      
             font-size: 15px;
             color: #999999;
        }
        
        h5 {
             margin: 0px 0 0px 0;
             letter-spacing: 0px;      
             font-size: 17px;
             color: #CE8F64;
        }
        
        .table-bordered th, .table-bordered tr, .table-bordered td {
             padding: 5px;
             
        }
        .table-bordered tr:nth-child(even) {
        background-color: #fff;
        }
        .table-bordered tr:nth-child(odd) {
           background-color: #eee;
        }
        .table-bordered th {
            background-color: #eee;
            color: black;
        }
        
        .tbl-total {
            width: 41%;
        }
        .tbl-total th, .tbl-total tr, .tbl-total td {
             padding: 5px;
        }
        .tbl-total tr:nth-child(even) {
        background-color: #eee;
        }
        .tbl-total tr:nth-child(odd) {
           background-color: #fff;
        }
    }
    </style>
</head>
<body>
@yield('content')
</body>
</html>
