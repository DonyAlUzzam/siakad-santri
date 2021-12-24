$(document).ready(function () {
    dataPembayaranall_init()

})

var table;
function dataPembayaranall_init() {
    table = $('#example2').DataTable({

    ajax : {
        url : '/api/get-data-pembayaran-all',
        method : 'post',
        type : 'json',
        data : {
            _token : $('meta[name="csrf-token"]').attr('content'),
            periode : () => {return $("#periode").val() },
            tipe : () => {return $("#jenis-trx").val() },
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
            title : 'Pembayaran 1',
            data : 'pembayaran_1',
            width : '10%',
            className : 'text-center align-middle',
            render : (data, type, row) => {
                return numeral(data).format('0,0');
            }
            },
            {
                title : 'Pembayaran 2',
                data : 'pembayaran_2',
                width : '5%',
                className : 'text-center align-middle',
                render : (data, type, row) => {
                    return numeral(data).format('0,0');
                },
            },
            {
            title : 'Pembayaran 3',
            data : 'pembayaran_3',
            width : '15%',
            className : 'text-center align-middle',
            render : (data, type, row) => {
                return numeral(data).format('0,0');
            }
            },
            {
            title : 'Periode',
            data : 'periode',
            width : '10%',
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
            footer: true,
            filename: 'List Total Pembayaran',
            customize: function( xlsx ) {
                var sheet = xlsx.xl.worksheets['sheet1.xml'];

                $('row c[r^="C"]', sheet).attr( 's', '2' );
            }
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

        $('#example2_length').append("<button class='btn btn-link' style='margin: 0 20px 0 20px' id='downloadAll'><a><i class='fas fa-file-download'></i> Download File</a></button>");
        $('#downloadAll').on('click', function(){
            table.button( '.buttons-excel' ).trigger();
    });
}

function updateJenisPembayaran(){
    table.ajax.reload()
    loadTotal()
    let tipe = $("#jenis-trx").val()
    if(tipe=="p1"){
        table.column(3).visible(true);
        table.column(4).visible(false);
        table.column(5).visible(false);
    }else if(tipe=="p2"){
        table.column(4).visible(true);
        table.column(3).visible(false);
        table.column(5).visible(false);
    }else if(tipe=="p3"){
        table.column(5).visible(true);
        table.column(3).visible(false);
        table.column(4).visible(false);
    }else{
        table.column(3).visible(true);
        table.column(4).visible(true);
        table.column(5).visible(true);
    }
}

function updatePeriode(){
    table.ajax.reload()
    loadTotal()
}

function loadTotal() {
    var data;
    $.ajax({
        url : '/api/get-data-rekap-pembayaran-all',
        method : 'post',
        type : 'json',
        async : false,
        data : {
            _token : $('meta[name="csrf-token"]').attr('content'),
            periode : () => {return $("#periode").val() },
            tipe : () => {return $("#jenis-trx").val() },
        },
        success: function (res) {
            data = res;
        }
    });
    return data;
}


