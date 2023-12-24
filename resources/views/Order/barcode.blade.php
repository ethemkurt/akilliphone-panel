<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <style>
        @media print {
            @page {
                size: 297mm 210mm landscape;
                margin: 0mm 0mm 0mm 0mm;
            }
        }

        .print_block {
            width: 320px;
            border: 1px solid #ccc;
            /*height: 210px;*/
            margin: 10px;
            display: block;
            float: left;
            overflow: hidden;
            padding: 10px;
            margin-bottom: 18px;

        }

        .print_block p {
            width: 100%;
            float: left;
            margin: 2px;
            font-size: 13px;
            font-family: 'Arial';
        }
    </style>
</head>
<body>
<div class="sayfa">
    <div class="print_block">
        <p style="margin-bottom:5px;">SAYIN, {{ $order['orderCustomer']['firstName'] }} {{ $order['orderCustomer']['lastName'] }}</p>
        <p><b>Sipariş No : </b>{{ $order['orderId'] }}</p>
        <p><b>Adres : </b>{{ $order['shippingAddress']['addressLine1'] }}</p>
        <p style="margin-bottom:5px;"><b>Şehir/İlçe :</b> {{ $order['shippingAddress']['city'] }}/{{ $order['shippingAddress']['district'] }}</p>
        <p><b>Tel :</b>{{ _formatPhoneNumber($order['orderCustomer']['telefon']) }}</p>
        <p><b>C.Tel :</b>{{ _formatPhoneNumber($order['shippingAddress']['phone']) }}</p>
        <p><svg id="barcode"></svg></p>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/jsbarcode@3.11.6/dist/JsBarcode.all.min.js"></script>
    <script language="javascript">
        JsBarcode("#barcode", "{{  $order['orderId'] }}", {
            height: 40
        } );
        window.print();
    </script>

</div>
</body>
</html>
