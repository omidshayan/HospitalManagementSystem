<script>
const openBtnCont = document.getElementById('openModal-cont');
const closeBtnCont = document.getElementById('closeModal-cont');
const overlayCont = document.getElementById('modalOverlay-cont');

function closeModalCont() {
    overlayCont.classList.remove('show');
    document.body.style.overflow = '';
}

openBtnCont.addEventListener('click', () => {
    overlayCont.classList.add('show');
    document.body.style.overflow = 'hidden';
});

closeBtnCont.addEventListener('click', closeModalCont);

overlayCont.addEventListener('click', (e) => {
    if (e.target === overlayCont) {
        closeModalCont();
    }
});

document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape' && overlayCont.classList.contains('show')) {
        closeModalCont();
    }
});

</script>
<style>
    /* Overlay */
.modal-overlay-cont {
    position: fixed;
    inset: 0;
    background: rgba(0, 0, 0, 0.5);
    display: block;
    opacity: 0;
    pointer-events: none;
    z-index: 9999;
    direction: ltr !important;

    transition: opacity 0.4s cubic-bezier(0.4, 0, 0.2, 1);
}

.modal-overlay-cont.show {
    opacity: 1;
    pointer-events: auto;
}

.modal-cont {
    width: calc(100% - 80px) !important;
    margin: 30px auto 0 auto;
    height: calc(100svh - 70px);
    background: var(--main);
    border-radius: 12px;
    overflow: hidden;
    padding: 0 10px 0 10px;

    opacity: 0;
    transform: translateY(-30px) scale(0.95);
    filter: blur(2px);
    transition:
        opacity 0.4s cubic-bezier(0.4, 0, 0.2, 1),
        transform 0.4s cubic-bezier(0.4, 0, 0.2, 1),
        filter 0.4s cubic-bezier(0.4, 0, 0.2, 1);
}

.modal-overlay-cont.show .modal-cont {
    opacity: 1;
    transform: translateY(0) scale(1);
    filter: blur(0);
}

    /* Header */
    .modal-header-cont {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 16px 20px;
        border-bottom: 1px solid #e5e5e5;
    }

    /* Body */
    .modal-body-cont {
        flex: 1;
        padding: 20px;
        overflow-y: auto;
    }

    .colse-btn-modal {
        text-align: right;
    }

    /* Close Button */
    .close-btn-cont {
        background: none;
        border: none;
        font-size: 24px;
        cursor: pointer;
        color: red;
        font-weight: bold;
        margin: 7px 7px 0 0;
        direction: rtl !important;
    }

    /* body */
    .pre-main {
        width: 100%;
        margin: 0 auto;
        justify-content: space-between;
    }

    .pre-body-right {
        width: 84%;
    }

    .pre-body-left {
        width: 280px !important;
        margin-left: 2px;
        text-align: left !important;
    }

    .patient-container {
        width: 265px !important;
    }

    .inputs-pre {
        width: 99%;
        margin: 5px auto !important;
        position: relative;
        display: flex;
        justify-content: space-between;
        gap: 5px;
    }

    .input-pre>select,
    .input-pre>input {
        height: 35px;
        border-radius: 3px;
        padding: 4px;
        transition: 0.7s;
        background-color: var(--main) !important;
    }

    .search-box-pre {
        width: 25%;
    }

    .search-input-pre {
        font-size: 19px !important;
        width: 100% !important;
    }

    .count-pre {
        width: 7%;
    }

    .count-pre-select {
        width: 100%;
    }

    .other-select-p {
        width: 10%;
    }

    .other-select-p-item {
        width: 100%;
    }

    .desc-pre {
        width: 20% !important;
    }

    .desc-prescription {
        min-height: 37px !important;
        line-height: 18px;
        font-size: 14px;
        padding: 6px 8px;
        box-sizing: border-box;
        resize: vertical;
        width: 100% !important;
    }

    /* ////// pre items */
    .content-create-pre {
        width: 100%;
        background-color: var(--simillar);
        border-radius: 10px;
        padding: 20px;
        border: 1px solid var(--border);
        margin: 0 auto;
        overflow-x: auto;
        position: relative;
    }

    .input-pre input {
        background-color: var(--main);
        border: none;
        width: 90%;
        height: 35px;
        padding: 8px;
        border-radius: 3px;
        color: var(--text);
        font-size: 16px;
        transition: 0.7s;
        outline: none;
        border: 1px solid var(--border);
        margin-bottom: 25px;
    }

    .input-pre select {
        background-color: var(--main);
        border: none;
        width: 90%;
        height: 35px;
        padding: 4px;
        border-radius: 3px;
        color: var(--text);
        font-size: 16px;
        outline: none;
        border: 1px solid var(--bg);
    }

    .input-pre select option {
        font-size: 16px;
    }

    .input-pre input:focus {
        outline: none !important;
        border: 1px solid var(--hover);
        box-shadow: 0 0 8px var(--hover);
        transition: 0.7s;
    }

    .input-pre>textarea {
        background-color: var(--main);
        border: 1px solid var(--border);
        transition: 0.7s;
        color: var(--color);
        font-size: 18px !important;
        padding: 8px !important;
        border-radius: 5px;
    }

    .input-pre textarea:focus {
        outline: none !important;
        border: 1px solid var(--hover);
        box-shadow: 0 0 4px var(--hover);
    }

    .input-pre select:focus {
        outline: none !important;
        border: 1px solid var(--hover);
        box-shadow: 0 0 4px var(--hover);
    }

    /* btns */
    .add-drug-pre {
        background-color: var(--bg) !important;
        color: black !important;
        transition: all .7s ease-in;
        border: 1px solid var(--bg) !important;
        border-radius: 5px;
        height: 52px;
        padding: 10px;
        margin-top: 49px;
        font-weight: bold !important;
        font-size: 16px;
    }

    .add-drug-pre:hover {
        background-color: var(--main) !important;
        color: var(--text) !important;
        border: 1px solid var(--bg);
    }

    select option:disabled {
        color: #0ebbffff;
    }

    .search-back {
        width: 24% !important;
    }

    .nav-item:focus {
        outline: 2px solid blue;
        background-color: #64646413;
    }


    /* status */
    .close-btn {
        font-size: 28px;
        margin-right: 7px;
        color: red;
        font-weight: bold;
        opacity: 0;
        transition: 0.7s;
    }

    .label-form:hover .close-btn {
        opacity: 1;
        cursor: pointer;
    }

    .search-item-left {
        text-align: left !important;
    }

    .t84 {
        top: 84px;
    }

    .search-item-left {
        text-align: right;
    }

    .search-item-left {
        padding: 7px 10px;
        cursor: pointer;
    }

    .search-item-left:hover {
        background-color: var(--border);
    }

    #closePrescriptionBtn {
        position: relative;
    }

    .heart-beat {
        display: inline-block;
        color: #d10000;
        font-size: 18px;
        animation: heartbeat 1.4s infinite;
        transform-origin: center;
    }

    @keyframes heartbeat {
        0% {
            transform: scale(1);
        }

        14% {
            transform: scale(1.3);
        }

        28% {
            transform: scale(1);
        }

        42% {
            transform: scale(1.3);
        }

        70% {
            transform: scale(1);
        }

        100% {
            transform: scale(1);
        }
    }
</style>