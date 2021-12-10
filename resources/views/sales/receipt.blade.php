       <style>

       .centered {
            text-align: center;
            align-content: center;
        }

       td,
        th,
        tr,
        table {
            border-collapse: collapse;
        }

           .ticket {
               width: 100mm;
               max-width: 100mm;
               page-break-inside: avoid;
               color:black;
           }
           td.description,
           th.description {
               width: 55mm;
               max-width: 55mm;
               text-align: left;
               font-size: 14px;
               }

           td.quantity,
           th.quantity {
               width: 27mm;
               max-width: 27mm;
               word-break: break-all;
               font-size: 14px;
           }

           td.price,
           th.price {
               width: 18mm;
               max-width: 18mm;
               word-break: break-all;
               text-align: right;
               font-size: 14px;
           }

           td.reg,
           th.reg {
               width: 40mm;
               max-width: 40mm;
               word-break: break-all;
               text-align: left;
           }
           td.reg-data,
           th.reg-data {
               width: 60mm;
               max-width: 60mm;
               word-break: break-all;
               text-align: right;
           }
        td.total,
        th.total {
            width: 30mm;
            max-width: 30mm;
            word-break: break-all;
            font-size:20px;
            text-align: right;
            font-weight: bold;
        }
        td.bar,
        th.bar {
            width: 30mm;
            max-width: 30mm;
            word-break: break-all;
            text-align: right;
            font-size:20px;
            font-weight: bold;
        }
        td.tax-name,
        th.tax-name {
            width: 50mm;
            max-width: 50mm;
            word-break: break-all;
            text-align: left;
        }

        td.tax-price,
        th.tax-price {
            width: 20mm;
            max-width: 20mm;
            word-break: break-all;
            text-align: right;
        }
           td.time-title,
           th.time-title {
               width: 25mm;
               max-width: 25mm;
               word-break: break-all;
               text-align: left;
               font-size: 20px;
               font-weight: bold;
           }

           td.time-data,
           th.time-data {
               width: 75mm;
               max-width: 75mm;
               word-break: break-all;
               text-align: right;
               font-size: 20px;
               font-weight: bold;
           }


        .centered {
            text-align: center;
            align-content: center;
            font-size: 20px;
            font-weight: bold;
        }
        .table-centered {
            align-content: center;
            font-size: 18px;
            width: 80mm;
        }

       img {
            max-width: inherit;
            width: inherit;
        }


    </style>

<div class="ticket ml-2 mt-5 mb-5">
     <p class="centered">K C
        <br>Lebensmittel und mehr..
        <br>Hauptstraße 99
         <br>41236 Mönchengladbach
     </p>
    <table>
        <tbody>
        <tr>
        <td class="reg">REG</td>
        <td class="reg-data">{{$startsale}}</td>
        </tr>
        <tr>
            <td class="reg">BED</td>
            <td class="reg-data">00{{auth()->user()->id}} </td>
        </tr>
        </tbody>
    </table>
    <br>
    <table>
        <tbody>
        @foreach($sales as $sale)
            <tr>
                <td class="description">{{$sale->name}}</td>
                <td class="quantity">{{$sale->quantity}}x&euro;{{$sale->single_price}}</td>
                <td class="price">&euro; {{$sale->linetotal}}</td>
            </tr>
           @endforeach
        </tbody>
    </table>
    <table class="table-centered ml-auto mr-auto">
        <tbody>
        <tr>
            <td class="tax-name"></td>
            <td class="tax-price">2 ST</td>
        </tr>
        <tr>
            <td class="tax-name">NETTO  19%</td>
            <td class="tax-price">&euro; {{number_format($sumtax19-(($sumtax19*19)/(100+19)), 2)}}</td>
        </tr>
        <tr>
            <td class="tax-name">MWST  19% </td>
            <td class="tax-price">&euro; {{number_format(($sumtax19*19)/(100+19), 2)}}</td>
        </tr>
        <tr>
            <td class="tax-name">NETTO  7%</td>
            <td class="tax-price">&euro; {{number_format($sumtax7-(($sumtax7*7)/(100+7)), 2)}}</td>
        </tr>
        <tr>
            <td class="tax-name">MWST  7% </td>
            <td class="tax-price">&euro; {{number_format(($sumtax7*7)/(100+7), 2)}}</td>
        </tr>
        <tr>
            <td class="tax-name">TOTAL </td>
            <td class="total">&euro;{{$sumtax7+$sumtax19}} </td>

        </tr>
        <tr>
            <td class="tax-name">BAR </td>
            <td class="bar">&euro;{{$sumtax7+$sumtax19}} </td>

        </tr>
        </tbody>
    </table>
    <br>
    <table>
        <tbody>
        <tr>
            <td class="time-title">Trans Nr:</td>
            <td class="time-data">{{ $salesId }}</td>
        </tr>
        <tr>
            <td class="time-title">Startzeit:</td>
            <td class="time-data">{{$startsale}}.000Z</td>
        </tr>
        <tr>
            <td class="time-title">Endzeit:</td>
            <td class="time-data">{{$endsale}}.000Z</td>
        </tr>
              </tbody>
    </table>
    <br>
    <p class="centered">Vielen Dank
        <br>für Ihren Besuch!!!
        </p>
    <br>
    <br>
</div>

       <script language="javascript">
           document.getElementById("btnPrint").onclick = function () {
               printElement(document.getElementById("printThis"));
           }

           function printElement(elem) {
               var domClone = elem.cloneNode(true);

               var $printSection = document.getElementById("printSection");

               if (!$printSection) {
                   var $printSection = document.createElement("div");
                   $printSection.id = "printSection";
                   document.body.appendChild($printSection);
               }

               $printSection.innerHTML = "";
               $printSection.appendChild(domClone);
               window.print();
           }
       </script>

