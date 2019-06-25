var site_url = document.getElementById('site_url').getAttribute('content');
var base_url = document.getElementById('base_url').getAttribute('content');
var lockScreenTimer = document.getElementById('lockScreenTimer').getAttribute('content')

function confirmDelete(loc) {
    swal({
        title: lang['confirm_delete_title'],
        text: lang['confirm_delete_warning'],
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#DD6B55',
        confirmButtonText: lang['confirm_delete_btn'],
        closeOnConfirm: false,
        backdrop: false,
        allowOutsideClick: false
    }, function () {
        swal('processing...');
        if (loc === undefined || loc === 'undefined') {
            swal({type: 'warning', title: 'Error'})
        } else {
            window.location.href = loc;
        }
    });
}

function decodeHtml(str) {
    var map =
        {
            '&amp;': '&',
            '&lt;': '<',
            '&gt;': '>',
            '&quot;': '"',
            '&#039;': "'"
        };
    return str.replace(/&amp;|&lt;|&gt;|&quot;|&#039;/g, function (m) {
        return map[m];
    });
}

function editUser(id) {    
    $('.modals-loader').load(site_url + 'users/view/'+ id, function () {
        $('#editUserModal').modal('show')
    })
}

function startLockscreen() {
    $('body').load(site_url + '/lockscreen');
    $('html').addClass('lockscreen');
}
