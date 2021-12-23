$(document).ready(function () {
    // if(window.location.pathname = '/santri'){
    //     // dataSiswaAll_init()
    // }else{
        dataSiswa_init()
    // }
    let url = window.location.pathname
    let sekolah = url.split('-')

    if(sekolah[1] == "mts"){
        $("#addSiswa").append(`<a href="santri/create" class="btn btn-primary mb-2">Tambah Siswa</a>`)
    }else{
        $("#addSiswa").append(`<a href="siswa/create" class="btn btn-primary mb-2">Tambah Siswa</a>`)
    }
})


function dataSiswa_init() {
	table = $('#siswa').DataTable({
   
	ajax : {
	url : '/api/get-data-siswa',
	method : 'post',
	type : 'json',
	data : {
		_token : $('meta[name="csrf-token"]').attr('content'),
    data : () => {return location.pathname.replace('/','') },
	},
	},
	columns: [
		{
		title : 'No.',
		width : '5%',
		data : null,
		className : 'text-center align-middle',
		render : (data, full, row, meta) => {
			return meta.row + 1;
		}
		},
        {
            title : 'Nim',
            data : 'nim',
            width : '15%',
            className : 'align-middle',
            render : (data, type, row) => {
                return data;
            }
            },
		{
		title : 'Nama Lengkap',
		data : 'fullname',
		width : '15%',
		className : 'align-middle',
		render : (data, type, row) => {
			return data;
		}
		},
		{
		title : 'Email',
		data : 'email',
		width : '10%',
		className : 'text-right align-middle',
		render : (data, type, row) => {
			return data;
		},
		},
		{
		title : 'Tempat Lahir',
		data : 'tempat_lahir',
		width : '15%',
		className : 'text-right align-middle',
		render : (data, type, row) => {
            return data
        }
		},
		{
		title : 'Tanggal Lahir',
		data : 'tanggal_lahir',
		width : '15%',
		className : 'text-right align-middle',
		render : (data, type, row) => {
			return data;
		}
		},
		{
		title : 'Alamat',
		data : 'alamat',
		width : '15%',
		className : 'text-right align-middle',
		render : (data, type, row) => {
			return data;
		}
		},
        {
            data: 'nim',
            "mRender": function (data, type, row) {
                let url = window.location.pathname
                let sekolah = url.split('-')

                if(sekolah[1] == "mts"){
                    return '<button  class="btn btn-sm btn-primary" title="Edit"><a style="color:white !important" href="santri/'+data+'/edit">Edit</a></button>'
                    +'&nbsp; <button  class="btn btn-sm btn-danger"  title="Delete"><a style="color:white !important" href="santri/'+data+'" onclick="notificationBeforeDelete(event, this)">Delete</a></button>';
                }else{
                    return '<button  class="btn btn-sm btn-primary" title="Edit"><a style="color:white !important" href="siswa/'+data+'/edit">Edit</a></button>'
                    +'&nbsp; <button  class="btn btn-sm btn-danger"  title="Delete"><a style="color:white !important" href="siswa/'+data+'" onclick="notificationBeforeDelete(event, this)">Delete</a></button>';
                }
               
            }
        }
        
		
	],
	"lengthMenu" : [[5,10, 25, 50, 100], [5, 10, 25, 50, 100]],
    // dom: 'Bfrtip',
    buttons: [ {
        text: 'Export Excel',
        extend: 'excelHtml5',
        className:'d-none',
        // filename: 'List Siswa MTs Kelas I',
        customize: function( xlsx ) {
            var sheet = xlsx.xl.worksheets['sheet1.xml'];

            $('row c[r^="C"]', sheet).attr( 's', '2' );
        }
    } ]
	});

    $('#siswa_length').append("<button class='btn btn-link' style='margin: 0 20px 0 20px' id='downloadAll'><a><i class='fas fa-file-download'></i> Download File</a></button>");
    $('#downloadAll').on('click', function(){
        table.button( '.buttons-excel' ).trigger();
    });
}





// var xhr_stk;
// function dataSiswa_inits() {
// 	if (xhr_stk!=undefined && xhr_stk!=null) {
// 		xhr_stk.abort();
// 	}
// 	xhr_stk = $.ajax({
// 		url : window.location.origin + '/api/get-data-siswa',
// 		method : 'GET',
// 		dataType : 'json',
// 		data : {
// 			_token : $('meta[name="csrf_token"]').attr('content'),
// 			// product : () => {return $('select[name="filterProduct-3"]').val() },
// 		},
// 		async : true,
// 		success : function (res) {
//             console.log(res, 'res')

//             // let data = JSON.parse(res)

//             // console.log(data,'da')
// 			// table_summary_transaksi_kendaraan.clear().draw();
// 			// table_summary_transaksi_kendaraan.rows.add(res);
// 			// table_summary_transaksi_kendaraan.columns.adjust().draw();
// 		}
// 	});
// }


function notificationBeforeDelete(event, el) {
    event.preventDefault();
    if (confirm('Apakah anda yakin akan menghapus data ? ')) {
        $("#delete-form").attr('action', $(el).attr('href'));
        $("#delete-form").submit();
    }
  
}