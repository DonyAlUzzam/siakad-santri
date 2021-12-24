$(document).ready(function () {
        dataSiswaAll_init()
   
})


function dataSiswaAll_init() {
	table = $('#example2').DataTable({
   
	ajax : {
	url : '/api/get-data-siswa-all',
	method : 'get',
	type : 'json',
	// data : {
	// 	_token : $('meta[name="csrf_token"]').attr('content'),
    // product : () => {return $('select[name="filterProduct-5"]').val() },
	// customer_type : () => {return $('select[name="customer-type"]').val() },
    // pengisian: () => {return pengisian}
	// },
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
            title : 'Foto',
            data : 'image',
            width : '15%',
            className : 'text-center align-middle',
            render : (data, type, row) => {
				return "<img src='storage/Image/"+data+"' width='100' heigh='100'/>";

            }
            },
        {
            title : 'Nim',
            data : 'nim',
            width : '15%',
            className : 'text-center align-middle',
            render : (data, type, row) => {
                return data;
            }
            },
		{
		title : 'Nama Lengkap',
		data : 'fullname',
		width : '15%',
		className : 'text-center align-middle',
		render : (data, type, row) => {
			return data;
		}
		},
		{
		title : 'Email',
		data : 'email',
		width : '10%',
		className : 'text-center align-middle',
		render : (data, type, row) => {
			return data;
		}
        },
        {
            title : 'Kelas',
            data : 'kelas',
            width : '5%',
            className : 'text-center align-middle',
            render : (data, type, row) => {
                return data;
            },
		},
		{
		title : 'Tempat Lahir',
		data : 'tempat_lahir',
		width : '15%',
		className : 'text-center align-middle',
		render : (data, type, row) => {
            return data
        }
		},
		{
		title : 'Tanggal Lahir',
		data : 'tanggal_lahir',
		width : '10%',
		className : 'text-center align-middle',
		render : (data, type, row) => {
			return data;
		}
		},
		{
		title : 'Alamat',
		data : 'alamat',
		width : '25%',
		className : 'text-center align-middle',
		render : (data, type, row) => {
			return data;
		}
		},
        
		
	],
	"lengthMenu" : [[5,10, 25, 50, 100], [5, 10, 25, 50, 100]],
    // dom: 'Bfrtip',
    buttons: [ {
        text: 'Export Excel',
        extend: 'excelHtml5',
        className:'d-none',
        filename: 'List Semua Siswa',
        customize: function( xlsx ) {
            var sheet = xlsx.xl.worksheets['sheet1.xml'];

            $('row c[r^="C"]', sheet).attr( 's', '2' );
        }
    } ]
	});

    $('#example2_length').append("<button class='btn btn-link' style='margin: 0 20px 0 20px' id='downloadAll'><a><i class='fas fa-file-download'></i> Download File</a></button>");
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