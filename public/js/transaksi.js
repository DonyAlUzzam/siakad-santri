$(document).ready(function () {
    // if(window.location.pathname = '/santri'){
    //     // dataSiswaAll_init()
    // }else{
        dataPembayaran_init()
        // loadTotal()
    // }
    $("#addTransaksi").append(`<a href="transaksi/create" class="btn btn-primary mb-2">Tambah Pembayaran</a>`)
                    
})

var table;
function dataPembayaran_init() {
	table = $('#pembayaran').DataTable({
   
	ajax : {
	url : '/api/get-data-pembayaran',
	method : 'post',
	type : 'json',
	data : {
		_token : $('meta[name="csrf-token"]').attr('content'),
    periode : () => {return $("#periode").val() },
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
            title : 'Nim Pembayar',
            data : 'nim_bayar',
            width : '15%',
            className : 'align-middle',
            render : (data, type, row) => {
                return data;
            }
            },
		{
		title : 'Periode',
		data : 'periode',
		width : '15%',
		className : 'align-middle',
		render : (data, type, row) => {
			return data;
		}
		},
		{
		title : 'Pembayaran 1',
		data : 'pembayaran_1',
		width : '10%',
		className : 'text-right align-middle',
		render : (data, type, row) => {
			return numeral(data).format('0,0');
		},
		},
		{
		title : 'Pembayaran 2',
		data : 'pembayaran_2',
		width : '15%',
		className : 'text-right align-middle',
		render : (data, type, row) => {
            return numeral(data).format('0,0');
        }
		},
		{
        title : 'Pembayaran 3',
        data : 'pembayaran_3',
        width : '15%',
        className : 'text-right align-middle',
        render : (data, type, row) => {
            return numeral(data).format('0,0');
		}
		},
        {
            data: 'id',
            width : '5%',
            className : 'text-center align-middle',
            "mRender": function (data, type, row) {
                
                return '<button  class="btn btn-sm btn-primary" title="Edit"><a style="color:white !important" href="transaksi/'+data+'/edit">Edit</a></button>'
               
            }
        }
        
		
	],
	"lengthMenu" : [[5,10, 25, 50, 100], [5, 10, 25, 50, 100]],
    // dom: 'Bfrtip',
    buttons: [ {
        text: 'Export Excel',
        extend: 'excelHtml5',
        extension: '.xlsx',
        footer: true,
        className:'d-none',
        // filename: 'List Siswa MTs Kelas I',
       
    } ],
    footerCallback: function ( row, data, start, end, display ) {
        var data_total = loadTotal();
        // console.log(data_total);
        var api = this.api(), data;
        // Remove the formatting to get integer data for summation
        var intVal = function ( i ) {
            
            return typeof i === 'string' ?
                Number(i.replace(/[,]/g,"")) :
                typeof i === 'number' ?
                    i : 0;
        };
        total_pembayaran_1 = api
        .column( 3 )
        .data()
        .reduce( function (a, b) {
            return intVal(a) + intVal(b);
        }, 0 );
        
        total_pembayaran_2 = api
        .column( 4 )
        .data()
        .reduce( function (a, b) {
            return intVal(a) + intVal(b);
        }, 0 );
        
        total_pembayaran_3 = api
        .column( 5 )
        .data()
        .reduce( function (a, b) {
            return intVal(a) + intVal(b);
        }, 0 );
        // Total over all pages
        total = api
        .column( 6 )
        .data()
        .reduce( function (a, b) {
            return intVal(a) + intVal(b);
        }, 0 );

        var mergeCells = function ( row, colspan ) {
            var mergeCells = $('mergeCells', rels);

            mergeCells[0].appendChild( _createNode( rels, 'mergeCell', {
                attr: {
                    ref: 'A'+row+':'+createCellPos(colspan)+row
                }
            } ) );
            mergeCells.attr( 'count', mergeCells.attr( 'count' )+1 );
            $('row:eq('+(row-1)+') c', rels).attr( 's', '51' ); // centre
        };

        // Update footer
        $( api.column( 3 ).footer() ).html(numeral(data_total.data[0].pembayaran_1).format('0,0'));
        $( api.column( 4 ).footer() ).html(numeral(data_total.data[0].pembayaran_2).format('0,0'));
        $( api.column( 5 ).footer() ).html(numeral(data_total.data[0].pembayaran_3).format('0,0'));
    },

	});

    $('#pembayaran_length').append("<button class='btn btn-link' style='margin: 0 20px 0 20px' id='downloadAll'><a><i class='fas fa-file-download'></i> Download File</a></button>");
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

function updatePeriode(){
    table.ajax.reload()
    loadTotal()
}


function loadTotal() {
    var periode = $("#periode").val()

    var data;
    $.ajax({
        url : '/api/rekap-total-pembayaran/'+periode,
        method : 'GET',
        async : false,
        success: function (res) {
            data = res;
        }
    });
    return data;
}
