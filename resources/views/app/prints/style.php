<style>
    /* media */
    @media print {

        @page {
            size: auto;
            margin: 0;
        }
        .order-invoice {
            width: 100% !important;
            padding: 0 !important;
            margin: 0 !important;
            display: block !important;
        }

        .factor-print {
            width: 100% !important;
            box-sizing: border-box !important;
            padding: 5px !important;
        }

        .order-invoice-print {
            width: 100% !important;
            border-collapse: collapse !important;
        }

        .order-invoice-print th,
        .order-invoice-print td {
            border-bottom: 1px dashed #000 !important;
            padding: 4px !important;
            text-align: center !important;
        }

        .factor-logo {
            max-width: 60px !important;
            height: auto !important;
        }

        thead th {
            font-size: 11px !important;
        }

        tbody td {
            font-size: 12px !important;
        }
    }
</style>
