
<!----------------Toast ALert display on ajax call action------------->
<div class="toast-container position-fixed top-0 end-0 p-3 toast-index toast-rtl">
    <div class="toast hide" id="liveToastSuccessAlert" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-body bg-success text-white d-flex justify-content-between align-items-center">
            <span class="toast-alert-success-msg">Successfully</span>
           <a href="#" class="text-white border border-white rounded px-2 py-1 ms-3 text-decoration-none undo-btn d-none">Undo</a>
        </div>
    </div>
</div>

<div class="toast-container position-fixed top-3 end-0 p-3 toast-index toast-rtl">
    <div class="toast hide" id="liveToastWarningAlert" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-body bg-warning text-white toast-alert-warning-msg">
            Warning
        </div>
    </div>
</div>

<div class="toast-container position-fixed top-3 end-0 p-3 toast-index toast-rtl">
    <div class="toast hide" id="liveToastErrorAlert" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-body bg-danger text-white toast-alert-error-msg">
            Error
        </div>
    </div>
</div>
