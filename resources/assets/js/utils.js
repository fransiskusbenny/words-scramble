import swal from 'sweetalert2'

const destroy = (endpoint, text = 'Are you sure you want delete this data') => {
    return new Promise((resolve, reject) => {
        swal({
            text,
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ok',
            showLoaderOnConfirm: true,
            allowEscapeKey: false,
            preConfirm: () => {
                return axios.delete(endpoint).then(() => {
                    return true
                }).catch(() => {
                    return false
                })
            },
            allowOutsideClick: () => !swal.isLoading()
        }).then((result) => {
            if (result.value) {
                resolve(result)
            }
        })
    })
}

export {
    destroy
}