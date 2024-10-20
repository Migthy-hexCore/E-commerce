<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ticket de compra</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .ticket {
            max-width: 400px;
            margin: 20px auto;
            padding: 20px;
            /* border: 1px solid #000; */
        }

        h1,
        h2,
        h3,
        h4 {
            text-align: center;
            margin-bottom: 10px;
        }

        .info {
            margin-bottom: 20px
        }

        .info div {
            margin-bottom: 5px;
        }

        .footer {
            text-align: center;
            font-size: 12px;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="ticket">
        <h4>
            Numero de order: {{ $order->id }}
        </h4>

        <div class="info">
            <h3>Informacion de la compañia</h3>
            <div>
                Nombre: Barberia Ray
            </div>
            <div>
                RUC: 0987654321
            </div>
            <div>
                Telefono: 0987654321
            </div>
            <div>
                Correo: barberia@ray.com
            </div>
        </div>

        <div class="info">
            <h3>Datos de cliente</h3>
            <div>
                Nombre:
                {{ $order->address['receiver_info']['name'] . ' ' . $order->address['receiver_info']['last_name'] }}
            </div>
            <div>
                Documento: {{ $order->address['receiver_info']['document_number'] }}
            </div>
            <div>
                Dirección: {{ $order->address['description'] }} - {{ $order->address['region'] }}
                ({{ $order->address['reference'] }})
            </div>
            <div>
                Telefono: {{ $order->address['receiver_info']['phone'] }}
            </div>
        </div>

        <div class="footer">
            ¡Gracias por tu compra!
        </div>
    </div>
</body>

</html>
