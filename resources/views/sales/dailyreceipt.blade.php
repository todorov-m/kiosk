<style>
    @media screen {
        #printSection {
            display: none;
        }
    }
    @media print {
        body * {
            visibility:hidden;
            color:black;
        }
        #printSection, #printSection * {
            visibility:visible;
        }
        #printSection {
            position:absolute;
            left:0;
            top:0;
        }


    }

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
        width: 50mm;
        max-width: 50mm;
        text-align: left;
        font-size: 16px;
    }

    td.quantity,
    th.quantity {
        width: 10mm;
        max-width: 10mm;
        word-break: break-all;
        font-size: 16px;
    }

    td.price,
    th.price {
        word-break: break-all;
        text-align: right;
        font-size: 16px;
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
        width: 40px;
        max-width: 40px;
        word-break: break-all;
        font-size:20px;
        text-align: right;
    }
    td.bar,
    th.bar {
        width: 40px;
        max-width: 40px;
        word-break: break-all;
        text-align: right;
    }
    td.tax-name,
    th.tax-name {
        width: 60mm;
        max-width: 60mm;
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
    }

    img {
        max-width: inherit;
        width: inherit;
    }
    @media print {
        .hidden-print,
        .hidden-print * {
            display: none !important;
        }
    }

</style>
<div class="d-flex justify-content-center">
    <button id="Print" class="hidden-print btn btn-primary btn-lg pl-5 pr-5" data-dismiss="modal">Print</button>
</div>
<div class="ticket ml-2 mt-5 mb-5" id="printThis">
    <p class="centered">K C
        <br>Lebensmittel und mehr..
        <br>Lewerentzstrabe 17
        <br>47798 Krefeld
    </p>
    <table>
        <tbody>
        <tr>
            <td class="description">Z</td>
            <td class="price">{{$close_create_date}}</td>
        </tr>
        <tr>
            <td class="description">BED. 1</td>
            <td class="price">00{{auth()->user()->id}} </td>
        </tr>
         <tr>
           <td colspan="2" class="reg-data">-------------------------------------------------------------</td>
        </tr>
        <tr>
            <td class="reg">Z</td>
            <td class="reg-data" style="text-align: left;">TÄGLICH Z</td>
        </tr>
        <tr>
            <td colspan="2" class="reg-data" >-------------------------------------------------------------</td>
        </tr>
        <tr>
            <td class="reg">Z</td>
            <td class="reg-data" style="text-align: left;">FINANZEN &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;0056</td>
        </tr>
        <tr>
            <td class="reg"></td>
            <td class="reg-data" style="text-align: left;"></td>
        </tr>
        <tr>
            <td class="description">BRUTTO</td>
            <td class="price">{{$daily_item_count_7 + $daily_item_count_19}}</td>
        </tr>
        <tr>
            <td class="description"></td>
            <td class="price">&euro; {{$daily_close_total}}</td>
        </tr>
        <tr>
            <td class="description">NETTO</td>
            <td class="price">No &nbsp;&nbsp;{{$daily_sales_count}}</td>
        </tr>
        <tr>
            <td class="description"></td>
            <td class="price">&euro; {{$daily_close_total}}</td>
        </tr>
        <tr>
            <td class="description">BAR/LADE</td>
            <td class="price">&euro; {{$daily_close_total}}</td>
        </tr>
        <tr>
            <td class="description">KREDIT/LADE</td>
            <td class="price">&euro; 0.00</td>
        </tr>
        <tr>
            <td class="description">SCHECK/LADE</td>
            <td class="price">&euro; 0.00</td>
        </tr>
        <tr>
            <td class="description">KRE/LADE(1)</td>
            <td class="price">&euro; 0.00</td>
        </tr>
        <tr>
            <td class="description">KRE/LADE(2)</td>
            <td class="price">&euro; 0.00</td>
        </tr>
        <tr>
            <td class="description">KRE/LADE(3)</td>
            <td class="price">&euro; 0.00</td>
        </tr>
        <tr>
            <td class="description">KRE/LADE(4)</td>
            <td class="price">&euro; 0.00</td>
        </tr>
        <tr>
            <td colspan="2" class="reg-data" >-------------------------------------------------------------</td>
        </tr>
        <tr>
            <td class="description">RETOURE - SCHL</td>
            <td class="price" >No &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;0</td>
        </tr>
        <tr>
            <td class="description"></td>
            <td class="price">&euro; 0.00</td>
        </tr>
        <tr>
            <td class="description">KUNDEN</td>
            <td class="price" >KU &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$daily_sales_count}}</td>
        </tr>
        <tr>
            <td class="description">BONSTORNO</td>
            <td class="price" >No &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;0</td>
        </tr>
        <tr>
            <td class="description"></td>
            <td class="price">&euro; 0.00</td>
        </tr>
        <tr>
            <td colspan="2" class="reg-data" >-------------------------------------------------------------</td>
        </tr>
        <tr>
            <td class="tax-name">NETTO  19%</td>
            <td class="tax-price">&euro; {{number_format($daily_close_total_19-(($daily_close_total_19*19)/(100+19)), 2)}}</td>
        </tr>
        <tr>
            <td class="tax-name">MWST  19% </td>
            <td class="tax-price">&euro; {{number_format(($daily_close_total_19*19)/(100+19), 2)}}</td>
        </tr>
        <tr>
            <td class="tax-name">BRUTTO  19% </td>
            <td class="tax-price">&euro; {{$daily_close_total_19}}</td>
        </tr>
        <tr>
            <td class="tax-name">NETTO  7%</td>
            <td class="tax-price">&euro; {{number_format($daily_close_total_7-(($daily_close_total_7*7)/(100+7)), 2)}}</td>
        </tr>
        <tr>
            <td class="tax-name">MWST  7% </td>
            <td class="tax-price">&euro; {{number_format(($daily_close_total_7*7)/(100+7), 2)}}</td>
        </tr>
        <tr>
            <td class="tax-name">BRUTTO  7% </td>
            <td class="tax-price">&euro; {{$daily_close_total_7}}</td>
        </tr>
        <tr>
            <td colspan="2" class="reg-data" >-------------------------------------------------------------</td>
        </tr>
        <tr>
            <td class="reg">Z</td>
            <td class="reg-data" style="text-align: left;">FUNKTIONEN &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;0056</td>
        </tr>
        <tr>
            <td class="reg">BAR</td>
            <td class="reg-data" style="text-align: left;">No &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$daily_sales_count}}</td>
        </tr>
        <tr>
            <td class="reg"></td>
            <td class="reg-data" >&euro; {{$daily_close_total}}</td>
        </tr>
        <tr>
            <td class="reg">RETOURE</td>
            <td class="reg-data" style="text-align: left;">No &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;0</td>
        </tr>
        <tr>
            <td class="reg"></td>
            <td class="reg-data">&euro; 0.00</td>
        </tr>
        <tr>
            <td class="reg">STORNO</td>
            <td class="reg-data" style="text-align: left;">No &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;0</td>
        </tr>
        <tr>
            <td class="reg"></td>
            <td class="reg-data">&euro; 0.00</td>
        </tr>
        <tr>
            <td class="reg">KEIN VERKAUF</td>
            <td class="reg-data" style="text-align: left;">No &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;0</td>
        </tr>
        <tr>
            <td colspan="2" class="reg-data" >-------------------------------------------------------------</td>
        </tr>
        <tr>
            <td class="reg">Z</td>
            <td class="reg-data" style="text-align: left;">WARENGRUPPEN &nbsp;&nbsp;&nbsp;&nbsp;0056</td>
        </tr>
        <tr>
            <td class="reg">Artikel 7%</td>
            <td class="reg-data" style="text-align: left;">{{$daily_item_count_7}}</td>
        </tr>
        <tr>
            <td class="reg"></td>
            <td class="reg-data">&euro; {{$daily_close_total_7}}</td>
        </tr>
        <tr>
            <td class="reg">Artikel 19%</td>
            <td class="reg-data" style="text-align: left;">{{$daily_item_count_19}}</td>
        </tr>
        <tr>
            <td class="reg"></td>
            <td class="reg-data">&euro; {{$daily_close_total_19}}</td>
        </tr>
        <tr>
            <td class="reg">Artikel 19%</td>
            <td class="reg-data" style="text-align: left;">{{$daily_item_count_19}}</td>
        </tr>
        <tr>
            <td class="reg">Artikel 0%</td>
            <td class="reg-data">&euro; 0.00</td>
        </tr>
        <tr>
            <td colspan="2" class="reg-data" >-------------------------------------------------------------</td>
        </tr>
        <tr>
            <td class="reg">TOTAL</td>
            <td class="reg-data" style="text-align: left;">{{$daily_item_count_7 + $daily_item_count_19}}</td>
        </tr>
        <tr>
            <td class="reg"></td>
            <td class="reg-data">&euro; {{$daily_close_total}}</td>
        </tr>
        <tr>
            <td colspan="2" class="reg-data" >-------------------------------------------------------------</td>
        </tr>
        <tr>
            <td class="reg">KEIN VERKAUF</td>
            <td class="reg-data" style="text-align: left;">BEDIENER &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;0056</td>
        </tr>
        <tr>
            <td class="description">BED. 1</td>
            <td class="price">...............{{auth()->user()->id}} </td>
        </tr>
        <tr>
            <td class="description">NETTO</td>
            <td class="price">No &nbsp;&nbsp;{{$daily_sales_count}}</td>
        </tr>
        <tr>
            <td class="reg"></td>
            <td class="reg-data">&euro; {{$daily_close_total}}</td>
        </tr>
        <tr>
            <td colspan="2" class="reg-data" >-------------------------------------------------------------</td>
        </tr>
        </tbody>
    </table>


    <br>
    <p class="centered">Vieten Dank
        <br>für Theren Besuch!
    </p>
    <br>
    <br>
</div>
<script language="javascript" type="text/javascript">
    document.getElementById("Print").onclick = function () {
        printElement(document.getElementById("printThis"));
    };

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
