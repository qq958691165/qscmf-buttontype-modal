
function renderQsButtonModalBodyContent(modalDom, apiUrl) {
    let infoDom = modalDom.find('.modal-body .button-modal-body-info');
    modalDom.find('.preloader').removeClass('hidden');
    infoDom.html('');

    // $.get(apiUrl, function (res) {
    //     if (res.status === 1) {
    //         $('.preloader').addClass('hidden');
    //         infoDom.html(res.info || '');
    //         injectSubmitTargetFormClass(modalDom);
    //     }
    //     if (res.status === 0){
    //         alert(res.info || '错误');
    //         $('#{$gid}QsButtonModal').modal('hide');
    //     }
    // });

    ajaxPromise(apiUrl).then(res =>{
        modalDom.find('.preloader').addClass('hidden');
        infoDom.html(res.info || '');
        injectSubmitTargetFormClass(modalDom);
    }).catch(res =>{
        alert(res.info || '错误');
        modalDom.modal('hide');
    });
}

function ajaxPromise(apiUrl){
    return new Promise((resolve, reject) =>{
        $.get(apiUrl, function (res) {
            if (res.status === 1) {
                resolve(res);
            }
            if (res.status === 0){
                reject(res);
            }
        });
    });
}

function injectSubmitTargetFormClass(modalDom){
    let submitDom = modalDom.find('.modal-footer .submitModal');
    let modalFormDom = modalDom.find('.modal-body form');
    if (submitDom && modalFormDom){
        if(modalFormDom.hasClass('builder-form')){
            modalFormDom.removeClass('builder-form');
        }
        modalFormDom.addClass(submitDom.attr('target-form'));
    }
}

function resetModalCss(name, value, dom) {
    dom.css(name, value);
}

function moveToBodyBottom(domId){
    document.body.appendChild(copyDom(domId));
    removeDom(domId)
}

function copyDom(domId){
    let oldDom = document.getElementById(domId);
    return oldDom.cloneNode(true);
}

function removeDom(domId){
    let self = document.getElementById(domId);
    let parent = self.parentElement;
    let removed = parent.removeChild(self);
    return removed === self;
}

$(document).on('show.bs.modal', '.modal', function(event) {
    let modalZIndex = calModalZIndex();
    $('body').find(".modal-backdrop:last").css("z-index", modalZIndex);
    $(this).css("z-index", modalZIndex + 1);
}).on('hidden.bs.modal', '.modal', function(event) {
    let modalZIndex = calModalZIndex();
    $('body').find(".modal-backdrop:last").css("z-index", modalZIndex-1);
});

function calModalZIndex(){
    let modalDefZIndex = 1040;
    let showModalCount =  $('.modal:visible').length;
    if (showModalCount > 0){
        modalDefZIndex = modalDefZIndex + showModalCount;
    }
    return  modalDefZIndex;
}