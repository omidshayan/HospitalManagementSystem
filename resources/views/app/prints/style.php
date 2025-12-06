<style>
.form-container {
    width: 210mm; 
    height: 297mm;
    margin: 0 auto;
    padding: 10px 10px 0 10px;
    box-sizing: border-box;
    font-size: 12pt;
    background-color: #fff;
}

</style>

<style>
    .order5 {
        writing-mode: vertical-rl;
        transform: rotate(180deg);
        border-right: 1px solid white;
    }

    .last-orders-items {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .last-hover a {
        color: var(--color);
    }

    .last-hover {
        border-radius: 4px;
        padding: 2px 5px;
        transition: 0.3s;
    }

    .last-hover:hover {
        background-color: var(--simillar);
    }

    .last-orders {
        background-color: var(--main);
        border: 1px solid var(--border);
        padding: 10px 2px;
        left: -170px;
        top: 300px;
        border-radius: 5px;
        width: 200px;
        transition: 0.4s;
    }

    .last-orders:hover {
        left: 0;
    }

    .last-orders-title {
        margin-right: 10px;
    }

    .order-categories {
        width: 13%;
        border-left: 1px solid #ccc;
        background-color: var(--simillar);
        padding: 0 10px;
        border: none;
    }

    .order-categories button {
        display: block;
        width: 100%;
        margin: 5px 0;
        padding: 10px;
        cursor: pointer;
        border: none;
        background: var(--main);
        text-align: right;
        font-size: 17px;
        font-weight: bold;
    }

    .order-categories button.active {
        background: #2195f386;
        color: white;
    }

    .order-items {
        margin: 0 5px;
        width: 70%;
        background: var(--simillar);
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(140px, 1fr));
        gap: 6px;
        border: none;
    }

    .order-item {
        border: 1px solid var(--hover);
        text-align: center;
        cursor: pointer;
        background: var(--main);
        user-select: none;
        font-size: 15px;
        color: black;
        transition: 0.2s;
        overflow: hidden;
        height: 70px;
        line-height: 65px;
        width: 100%;
    }

    .order-item:hover {
        background: var(--border);
    }

    .order-invoice {
        padding: 10px;
        width: 25% !important;
        min-width: 400px !important;
        background: var(--simillar);
    }

    .order-invoice table {
        width: 100%;
        border-collapse: collapse;
    }

    .order-invoice table td,
    .order-invoice table th {
        padding: 4px;
        text-align: center;
        font-size: 15px;
    }

    .order-total {
        font-weight: bold;
        margin-top: 10px;
        text-align: left;
    }

    .order-qty-btn {
        padding: 2px 4px;
        cursor: pointer;
        border: none;
        background: #94ff07d8;
        margin: 0 2px;
        color: #141313ff;
        font-size: 15px;
        font-weight: bold;
    }

    .order-btn {
        padding: 6px 5px;
        cursor: pointer;
        border: none;
        background: #94ff07d8;
        margin: 0 2px;
        color: #141313ff;
        font-size: 13px;
    }

    .flex-justify-align {
        display: flex !important;
        justify-content: center !important;
        align-items: center !important;
    }

    .select-paik-btn {
        display: none;
    }

    @media screen and (max-width: 1100px) {
        .order {
            flex-wrap: wrap;
        }

        .order-categories {
            width: 10%;
        }

        .order-items {
            width: 79%;
        }

        .order-invoice {
            flex: 0 0 100%;
            margin-top: 13px;
        }

        .content-title {
            display: none;
        }

        .right-order-menu {
            width: 200px !important;
            line-height: 60px;
            margin-right: 10px;
        }

        .order-delivery {
            width: 200px !important;
            line-height: 40px;
            position: absolute;
            right: 240px;
        }

        .select-paik {
            display: none;
        }
    }

    @media screen and (max-width: 1018px) {
        .order-items {
            width: 76%;
        }
    }

    @media screen and (max-width: 1400px) {
        .order-categories {
            width: 14%;
        }
    }

    @media screen and (max-width: 1380px) {
        .order-categories {
            width: 16%;
        }
    }

    @media screen and (max-width: 1280px) {
        .order-categories {
            width: 18%;
        }
    }

    @media screen and (max-width: 1202px) {
        .order-categories {
            width: 20%;
        }
    }

    @media screen and (max-width: 1000px) {
        .order-categories {
            margin-bottom: 20px;
        }

        .order-items {
            margin-bottom: 20px;
            padding: 0;
        }

        .select-user {
            position: static;
            display: block;
            text-align: right;
            width: 37% !important;
            margin: 20px 10px;

        }

        .select-user input {
            width: 100% !important;
        }

        .order-invoice table td,
        .order-invoice table th {
            font-size: 13px;
        }

        .search-back {
            top: 54px;
            right: 10px;
            width: 80% !important;
        }

        .select-paik-btn {
            display: block;
            width: 12%;
        }
    }

    @media screen and (max-width: 700px) {
        .order-items {
            width: 100%;
        }

        .order-categories {
            width: 100%;
        }

        .order-menu-top {
            display: block;
            text-align: center !important;
            width: 95% !important;
            margin: 0 auto !important;
            right: 0 !important;
            left: 0 !important;
        }

        .order-invoice {
            width: 100% !important;
            min-width: 370px !important;
        }

        .order-type {
            width: 100%;
        }

        .order-categories {
            margin-top: 60px;
        }

        .select-user {
            width: 95% !important;
            display: block;
            margin: 0 auto;
        }

        .select-radio {
            width: 160px !important;
            transform: scale(0.8) !important;
            position: relative;
            right: -27px !important;
        }

        .right-order-menu {
            margin: 0 10px 0 0 !important;
        }

        .order-delivery {
            right: 150px !important;
            font-size: 16px;
        }
    }

    /* media */
    @media print {

        @page {
            size: auto;
            margin: 0;
        }

        .no-print {
            display: none !important;
        }

        .order-invoice {
            width: 100%;
            padding: 0;
            margin: 0;
            display: block;
        }

        .factor-print {
            width: 100%;
            box-sizing: border-box;
            padding: 5px;
        }

        .order-invoice-print {
            width: 100%;
            border-collapse: collapse;
        }

        .order-invoice-print th,
        .order-invoice-print td {
            border-bottom: 1px dashed #000;
            padding: 4px;
            text-align: center;
        }

        .factor-logo {
            max-width: 60px;
            height: auto;
        }

        thead th {
            font-size: 11px !important;
        }

        tbody td {
            font-size: 12px !important;
        }
    }
</style>
