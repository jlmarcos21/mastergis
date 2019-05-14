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
            color: #000000;
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
            color: #000000;
        }
        .information .logo {
            margin-bottom: 0; 
        }
        .information table {            
            margin: 15px;
        }
    </style>

</head>
<body>

<div class="information">
    <table width="100%">
        <tr>
            <td style="width: 50%; text-align: center">                
<pre>
<img src="https://i.imgur.com/abOGZUb.png" alt="Logo" width="250px" class="logo"/>
<small><strong>PASIÓN POR LOS GIS</strong></small>
<small>Especialistas en Sistemas de Información</small>
<small>Geográfica</small>
<br><br>
</pre>
            </td>
            <td style="width: 10%; text-align: center">
            </td>
            <td style="width: 40%; text-align: center; border: 1px solid black" >
                <h3><strong>R.U.C. 20601066972</strong></h3>
                <hr>
                <h3>{{ $sale->voucher->name }}</h3>
                <hr> 
                <h3>{{ $sale->voucher->serie }}- <span style="color: #ab0111">N° {{ $sale->serie }}</span> </h3>
            </td>
        </tr>

        <tr>
            <td style="text-align: left">
                <strong>Cliente: <small>{{ $sale->student->name }} {{ $sale->student->lastname }}</small></strong>
                <br>
                <strong>Fecha: <small>{{ $sale->date }}</small> - <small>{{ $sale->time }}</small></strong>             
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
            <td style="text-align: left" class="gray">{{ $sale->currency->icon }}{{ $sale->total_interbank }}</td>
        </tr>
        <tr>
            <td colspan="2"></td>
            <td style="text-align: left">Total</td>
            <td style="text-align: left" class="gray">{{ $sale->currency->icon }}{{ $sale->total_interbank }}</td>
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