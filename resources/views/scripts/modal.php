<script>
    const openBtnCont = document.getElementById('openModal-cont');
    const closeBtnCont = document.getElementById('closeModal-cont');
    const overlayCont = document.getElementById('modalOverlay-cont');

    function closeModalCont() {
        overlayCont.style.display = 'none';
        document.body.style.overflow = '';
    }

    openBtnCont.addEventListener('click', () => {
        overlayCont.style.display = 'block';
        document.body.style.overflow = 'hidden';
    });

    closeBtnCont.addEventListener('click', closeModalCont);

    overlayCont.addEventListener('click', (e) => {
        if (e.target === overlayCont) {
            closeModalCont();
        }
    });

    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && overlayCont.style.display === 'block') {
            closeModalCont();
        }
    });
</script>
<style>
    /* Overlay */
    .modal-overlay-cont {
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, 0.45);
        display: none;
        z-index: 9999;
    }

    /* Modal */
    .modal-cont {
        position: fixed;
        top: 30px;
        right: 30px;
        bottom: 30px;
        left: 30px;
        background: var(--main);
        border-radius: 12px;
        overflow: hidden;
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

    /* Close Button */
    .close-btn-cont {
        background: none;
        border: none;
        font-size: 22px;
        cursor: pointer;
        color: red;
        font-weight: bold;
        margin: 10px 15px 0 0;
    }

    .desc-prescription {
        height: 34px !important;
        min-height: 34px !important;

        line-height: 18px;
        font-size: 14px;
        padding: 6px 8px;

        box-sizing: border-box;
        resize: vertical;
    }

    .count-pre {
        width: 100% !important;
    }

    .count-pre>select {
        width: 70px !important;
        border: 1px solid var(--border) !important;
    }

    .insert-pre {
        width: 100%;
        height: 100%;
        text-align: center;
        border-radius: 5px;
    }

    .insert-pre>div {
        text-align: right;
        margin-right: 5.5%;
        margin-bottom: 4px;
    }

    .insert-pre input {
        background-color: var(--main);
        border: none;
        width: 90%;
        height: 35px;
        padding: 8px;
        border-radius: 3px;
        color: var(--text);
        font-size: 16px;
        transition: 0.5s;
        outline: none;
        border: 1px solid var(--border);
        margin-bottom: 25px;
    }

    .insert-pre select {
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

    .insert-pre select option {
        font-size: 16px;
    }

    .insert-pre input:focus {
        outline: none !important;
        border: 1px solid var(--hover);
        box-shadow: 0 0 8px var(--hover);
        transition: 0.5s;
    }
</style>