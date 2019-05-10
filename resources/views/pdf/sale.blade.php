<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Venta N°{{ $sale->code }}</title>

    <style type="text/css">
        @page {
            margin: 0px;
        }
        body {
            margin: 0px;
        }
        * {
            font-family: Verdana, Arial, sans-serif;
        }
        a {
            color: #fff;
            text-decoration: none;
        }
        table {
            font-size: 15px;
        }
        tfoot tr td {
            font-weight: bold;
            font-size: 15px;
        }
        .invoice table {
            margin: 15px;
        }
        .invoice h3 {
            margin-left: 15px;
        }
        .information {
            background-color: #ab0111;
            color: #FFF;
        }
        .information .logo {
            margin: 1px;
        }
        .information table {
            padding: 10px;
        }
    </style>

</head>
<body>

<div class="information">
    <table width="100%">
        <tr>
            <td style="width: 30%; text-align: left">
                <h3>{{ $sale->student->name }} {{ $sale->student->lastname }}</h3>
<pre>
N°{{ $sale->code }}
{{ $sale->student->country->description }}
<br><br>
Fecha: {{ $sale->date }}
Hora: {{ $sale->time }}
Pago: {{ $sale->payment->name }}
</pre>
            </td>
            <td style="text-align: center">
                <img src="https://www.mastergis.com/wp-content/themes/masterig/images/logo.svg  " alt="Logo" width="250px" class="logo"/>
            </td>
            <td style="width: 30%; text-align: right">

                <h3>MasterGis</h3>
                <pre>
                    www.mastergis.com
                    <br><br>
                    Sede
                    Lima, Lima
                </pre>
            </td>
        </tr>

    </table>
</div>


<br/>

<div class="invoice">    
    <table width="100%">
        <thead>
        <tr>
            <th>Descripción</th>
            <th>Precio</th>
            <th>Cantidad</th>
            <th>Total</th>
        </tr>
        </thead>
        <tbody>
        <tr><td colspan="4"><hr></td></tr>        
        @foreach ($sale->items as $item)
        <tr>
            <td>{{ $item->course_description }}</td>
            <td>{{ $sale->currency->icon }}{{ $item->price }}</td>
            <td>{{ $item->quantity }}</td>
            <td style="text-align: left">{{ $sale->currency->icon }}{{ $item->total }}</td>
        </tr>
        @endforeach            
        </tbody>        
        <tfoot>
        <tr><td colspan="4"><hr></td></tr>
        <tr>
            <td colspan="2"></td>
            <td style="text-align: left">SubTotal</td>
            <td style="text-align: left" class="gray">{{ $sale->currency->icon }}{{ $sale->subtotal }}</td>
        </tr>
        <tr>
            <td colspan="2"></td>
            <td style="text-align: left">Total</td>
            <td style="text-align: left" class="gray">{{ $sale->currency->icon }}{{ $sale->total }}</td>
        </tr>
        </tfoot>
    </table>
</div>

<div class="information" style="position: absolute; bottom: 0;">
    <table width="100%">
        <tr>
            <td style="width: 50%; text-align: left">
                &copy; MasterGIS 2019
            </td>
            <td style="width: 50%; text-align: right">
                Construir la nueva generación
                de profesionales GIS
            </td>
        </tr>

    </table>
</div>
</body>
</html>